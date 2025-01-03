<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Services\CurrencyConverter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $thisWeekSales = $this->generateSalesChartArray();
        $lastInvoices = $this->getLastInvoices(limit:5);
        $userSales = $this->getUserSalesChart();
        $bestUsers = $this->getBestUsers();

        return view('dashboard')->with([
            'thisWeekSales' => $thisWeekSales,
            'lastInvoices'  => $lastInvoices,
            'userSales'     => $userSales,
            'bestUsers'     => $bestUsers
        ]);
    }

    /**
     * Generate the sales chart array for the current week
     * 
     * @return array
     */
    private function generateSalesChartArray(): array
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
    private function getSalesChart(array $sales): array
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

    /**
     * Get the user stats
     * 
     * @return array
     */
    private function getUserSalesChart(): array
    {
       $users = User::select('id', 'name', 'email')->get();
       $users_invoice_value = [];
       foreach ($users as $user) {
            $value = 0;

            foreach ($user->getInvoices() as $invoice) {
                $value += CurrencyConverter::convert($invoice->value, $invoice->currency, 'ron');
            }

            $users_invoice_value += [
                $user->name => $value
            ];
       }
       return $users_invoice_value;
    }

    private function getBestUsers(int $limit = 5): Object
    {   
        return User::getBestSeller();
    }

    


}
