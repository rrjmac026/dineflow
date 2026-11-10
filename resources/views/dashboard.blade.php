<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <style>
        .stat-label { color: var(--df-muted); font-weight: 600; font-size: .875rem; }
        html.dark .stat-label { color: #C9B3A5; }
        .stat-value { font-size: 1.9rem; font-weight: 800; line-height: 1.1; margin-top: .35rem; color: var(--accent); }
        .stat-icon, .stat-pill { color: var(--accent); background: color-mix(in srgb, var(--accent) 15%, transparent); }
        .stat-icon { width: 2.75rem; height: 2.75rem; border-radius: .9rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        .stat-pill { display: inline-block; margin-top: .5rem; padding: .1rem .6rem; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .chart-title { font-weight: 700; color: var(--df-brown); }
        html.dark .chart-title { color: var(--df-cream); }
        .chart-sub { font-size: .8rem; color: var(--df-muted); }
        .chart-box { position: relative; height: 16rem; margin-top: 1rem; }
        .chart-empty { height: 16rem; display: flex; align-items: center; justify-content: center; color: var(--df-muted); }
    </style>

    @php
        $cards = [
            ['Customers',    $data['total_customers'],    'fa-users',         '#D9822B', null],
            ['Orders',       $data['total_orders'],       'fa-shopping-cart', '#3F63B5', $data['pending_orders'] > 0 ? $data['pending_orders'] . ' pending' : null],
            ['Menu items',   $data['total_menu_items'],   'fa-utensils',      '#5E8C5A', null],
            ['Inventory',    $data['total_inventory'],    'fa-boxes',         '#C2543F', $data['low_stock_items'] > 0 ? $data['low_stock_items'] . ' low stock' : null],
            ['Reservations', $data['total_reservations'], 'fa-calendar-alt',  '#8B5A2B', $data['pending_reservations'] > 0 ? $data['pending_reservations'] . ' pending' : null],
        ];
    @endphp

    <!-- Stat cards -->
    <div class="df-stats">
        @foreach($cards as [$label, $value, $icon, $accent, $note])
            <div class="df-card" style="--accent: {{ $accent }}">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="stat-label">{{ $label }}</p>
                        <p class="stat-value">{{ $value }}</p>
                        @if($note)
                            <span class="stat-pill">{{ $note }}</span>
                        @endif
                    </div>
                    <span class="stat-icon"><i class="fas {{ $icon }}"></i></span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Charts: row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-6">
        <div class="df-card lg:col-span-2">
            <h3 class="chart-title">Orders this week</h3>
            <p class="chart-sub">Number of orders placed each day, last 7 days</p>
            <div class="chart-box"><canvas id="ordersPerDay"></canvas></div>
        </div>

        <div class="df-card">
            <h3 class="chart-title">Orders by status</h3>
            <p class="chart-sub">All orders</p>
            @if(array_sum($charts['ordersByStatus']) > 0)
                <div class="chart-box"><canvas id="ordersByStatus"></canvas></div>
            @else
                <div class="chart-empty">No orders yet</div>
            @endif
        </div>
    </div>

    <!-- Charts: row 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div class="df-card">
            <h3 class="chart-title">Reservations by status</h3>
            <p class="chart-sub">All reservations</p>
            @if(array_sum($charts['reservationsByStatus']) > 0)
                <div class="chart-box"><canvas id="reservationsByStatus"></canvas></div>
            @else
                <div class="chart-empty">No reservations yet</div>
            @endif
        </div>

        <div class="df-card">
            <h3 class="chart-title">Stock health</h3>
            <p class="chart-sub">Items at or below their reorder level</p>
            @if(array_sum($charts['stockHealth']) > 0)
                <div class="chart-box"><canvas id="stockHealth"></canvas></div>
            @else
                <div class="chart-empty">No inventory yet</div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            if (typeof Chart === 'undefined') {
                document.querySelectorAll('.chart-box').forEach((b) => {
                    b.innerHTML = '<div class="chart-empty">Charts could not load</div>';
                });
                return;
            }

            const charts = @json($charts);

            // Brand colors, matched by status name (anything unknown falls back to the cycle below)
            const statusColors = {
                pending: '#D9822B', preparing: '#3F63B5', processing: '#3F63B5',
                confirmed: '#5E8C5A', ready: '#5E8C5A', served: '#5E8C5A', completed: '#5E8C5A',
                cancelled: '#C2543F', canceled: '#C2543F', rejected: '#C2543F',
                'in stock': '#5E8C5A', 'low stock': '#C2543F',
            };
            const fallback = ['#8B5A2B', '#E3C9B0', '#4A230D', '#9AA7C7'];

            const colorsFor = (labels) => labels.map((l, i) => statusColors[l.toLowerCase()] ?? fallback[i % fallback.length]);
            const titleCase = (s) => s.charAt(0).toUpperCase() + s.slice(1);

            const dark = () => document.documentElement.classList.contains('dark');
            const applyTheme = () => {
                Chart.defaults.color = dark() ? '#C9B3A5' : '#8A6F5E';
                Chart.defaults.font.family = "'Figtree', ui-sans-serif, system-ui, sans-serif";
                Chart.defaults.borderColor = dark() ? 'rgba(255,255,255,.08)' : '#EFE5DE';
            };
            applyTheme();

            const instances = [];

            // Line chart: orders per day
            instances.push(new Chart(document.getElementById('ordersPerDay'), {
                type: 'line',
                data: {
                    labels: charts.ordersPerDay.labels,
                    datasets: [{
                        label: 'Orders',
                        data: charts.ordersPerDay.values,
                        borderColor: '#D9822B',
                        backgroundColor: 'rgba(217,130,43,.15)',
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointBackgroundColor: '#D9822B',
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } },
                    },
                },
            }));

            // Doughnut charts
            const doughnut = (id, counts) => {
                const el = document.getElementById(id);
                if (!el) return;
                const keys = Object.keys(counts);
                instances.push(new Chart(el, {
                    type: 'doughnut',
                    data: {
                        labels: keys.map(titleCase),
                        datasets: [{
                            data: keys.map((k) => counts[k]),
                            backgroundColor: colorsFor(keys),
                            borderWidth: 0,
                            spacing: 3,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } },
                    },
                }));
            };

            doughnut('ordersByStatus', charts.ordersByStatus);
            doughnut('reservationsByStatus', charts.reservationsByStatus);
            doughnut('stockHealth', charts.stockHealth);

            // Re-theme charts when dark mode is toggled
            new MutationObserver(() => {
                applyTheme();
                instances.forEach((c) => c.update());
            }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        })();
    </script>
</x-app-layout>