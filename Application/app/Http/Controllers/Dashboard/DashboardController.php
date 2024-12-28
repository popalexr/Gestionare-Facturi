<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Services\CurrencyConverter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $thisWeekSales = $this->generateSalesChartArray();
        $lastInvoices = $this->getLastInvoices(limit:5);

        return view('dashboard')->with([
            'thisWeekSales' => $thisWeekSales,
            'lastInvoices'  => $lastInvoices,
        ]);
    }

    /**
     * Generate the sales chart array for the current week
     * 
     * @return array
     */
    public function generateSalesChartArray(): array
    {
        $sales = $this->getThisWeekSales();
        $salesChart = $this->getSalesChart($sales);

        return [
            'salesChart' => $salesChart,
            'totalSales' => round(array_sum($sales), 2),
        ];
    }

    /**
     * Get the sales for the current week
     * 
     * @return array
     */
    private function getThisWeekSales(): array
    {
        $invoices = Invoices::where('created_at', '>=', now()->createMidnightDate()->subDays(7))->get();

        // Generate the array of sales per day
        $sales = [];

        foreach ($invoices as $invoice) {
            $date = $invoice->created_at->format('d M');

            if (!isset($sales[$date])) {
                $sales[$date] = 0;
            }

            $sales[$date] += CurrencyConverter::convert($invoice->value, $invoice->currency, 'ron');
        }

        return $sales;
    }

    /**
     * Generate the sales chart Json
     * 
     * @param array $sales
     * @return array
     */
    public function getSalesChart(array $sales): array
    {
        $labels = [];
        $data = [];

        foreach ($sales as $date => $total) {
            $labels[] = $date;
            $data[] = round($total, 2);
        }

        return [
            'xAxis' => $labels,
            'yAxis' => $data
        ];
    }

    /**
     * Get the last invoices
     * 
     * @param int $limit
     * @return Collection
     */
    private function getLastInvoices(int $limit = 5) : Collection
    {
        return Invoices::latest()->limit($limit)->get();
    }
}
