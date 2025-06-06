@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert("{{ session('success') }}");
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert("{{ session('error') }}");
    });
</script>
@endif
