<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use App\Models\Feedback;
use App\Models\Inventory;
use App\Models\Menu;
use FPDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new FPDF();
    }

    protected function header($title)
    {
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Cell(0, 10, 'DineFlow Restaurant', 0, 1, 'C');
        $this->pdf->SetFont('Arial', 'B', 14);
        $this->pdf->Cell(0, 10, $title, 0, 1, 'C');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 10, 'Generated on: ' . Carbon::now()->format('F d, Y h:i A'), 0, 1, 'C');
        $this->pdf->Ln(10);
    }

    public function index()
    {
        return view('reports.index');
    }

    public function salesReport($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->startOfMonth();
        $endDate = $endDate ?? Carbon::now();

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->with(['menu', 'user'])
            ->get();

        $this->header('Sales Report');

        // Column headers
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(40, 10, 'Order Number', 1);
        $this->pdf->Cell(60, 10, 'Menu Item', 1);
        $this->pdf->Cell(30, 10, 'Price', 1);
        $this->pdf->Cell(30, 10, 'Date', 1);
        $this->pdf->Cell(30, 10, 'Status', 1);
        $this->pdf->Ln();

        // Data
        $this->pdf->SetFont('Arial', '', 10);
        $total = 0;

        foreach ($orders as $order) {
            $this->pdf->Cell(40, 10, $order->order_number, 1);
            $this->pdf->Cell(60, 10, $order->menu->name, 1);
            $this->pdf->Cell(30, 10, '₱' . number_format($order->total_price, 2), 1);
            $this->pdf->Cell(30, 10, $order->created_at->format('Y-m-d'), 1);
            $this->pdf->Cell(30, 10, ucfirst($order->status), 1);
            $this->pdf->Ln();
            $total += $order->total_price;
        }

        // Total
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(130, 10, 'Total Sales:', 1);
        $this->pdf->Cell(60, 10, '₱' . number_format($total, 2), 1);

        return $this->pdf->Output('D', 'sales_report.pdf');
    }

    public function inventoryReport()
    {
        $inventory = Inventory::all();

        $this->header('Inventory Status Report');

        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(60, 10, 'Item Name', 1);
        $this->pdf->Cell(30, 10, 'Quantity', 1);
        $this->pdf->Cell(40, 10, 'Unit Cost', 1);
        $this->pdf->Cell(60, 10, 'Supplier', 1);
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial', '', 10);
        foreach ($inventory as $item) {
            $this->pdf->Cell(60, 10, $item->item_name, 1);
            $this->pdf->Cell(30, 10, $item->quantity, 1);
            $this->pdf->Cell(40, 10, '₱' . number_format($item->unit_cost, 2), 1);
            $this->pdf->Cell(60, 10, $item->supplier, 1);
            $this->pdf->Ln();
        }

        return $this->pdf->Output('D', 'inventory_report.pdf');
    }

    public function feedbackReport()
    {
        $feedbacks = Feedback::with('user')->latest()->get();

        $this->header('Customer Feedback Report');

        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(40, 10, 'Customer', 1);
        $this->pdf->Cell(30, 10, 'Rating', 1);
        $this->pdf->Cell(80, 10, 'Message', 1);
        $this->pdf->Cell(40, 10, 'Date', 1);
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial', '', 10);
        foreach ($feedbacks as $feedback) {
            $this->pdf->Cell(40, 10, $feedback->user->name, 1);
            $this->pdf->Cell(30, 10, $feedback->rating . '/5', 1);
            $this->pdf->Cell(80, 10, substr($feedback->message, 0, 50), 1);
            $this->pdf->Cell(40, 10, $feedback->created_at->format('Y-m-d'), 1);
            $this->pdf->Ln();
        }

        return $this->pdf->Output('D', 'feedback_report.pdf');
    }
}
