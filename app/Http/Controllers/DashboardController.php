<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Storage;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    protected $database;
    protected $reference;

    public function __construct()
    {

        $factory = (new Factory)
            ->withServiceAccount('../firebase.json')
            ->withDatabaseUri('https://peso-exchanger-default-rtdb.firebaseio.com/');

        $this->database = $factory->createDatabase();
        $this->reference = $this->database->getReference('exchanger');
        $this->storage = $factory->createStorage();
    }

    public function view()
    {
        $stocks = $this->reference->getChild('stocks')->getValue();
        $reports = $this->reference->getChild('reports')->getValue();
        $settings = $this->reference->getChild('settings')->getValue();

        $now = Carbon::now();
        $totals = [
            'day' => 0,
            'week' => 0,
            'month' => 0,
            'year' => 0
        ];

        $monthlyTotals = array_fill(1, 12, 0); // for the chart
        $reportsArray = [];

        if (is_array($reports)) {
            foreach ($reports as $reportId => $report) {
                $report['id'] = $reportId;
                $reportsArray[] = $report;

                if (!empty($report['datetime']) && isset($report['earnings'])) {
                    $date = Carbon::parse($report['datetime']);
                    $earnings = floatval($report['earnings']);

                    // Aggregation for summary cards
                    if ($date->isSameDay($now)) {
                        $totals['day'] += $earnings;
                    }
                    if ($date->isSameWeek($now)) {
                        $totals['week'] += $earnings;
                    }
                    if ($date->isSameMonth($now)) {
                        $totals['month'] += $earnings;
                    }
                    if ($date->isSameYear($now)) {
                        $totals['year'] += $earnings;
                    }

                    // Chart monthly totals
                    $month = (int) $date->format('n');
                    $monthlyTotals[$month] += $earnings;
                }
            }

            usort($reportsArray, fn($a, $b) => strtotime($b['datetime']) - strtotime($a['datetime']));
        }

        return view('dashboard', [
            'stocks' => $stocks,
            'reports' => $reportsArray,
            'monthlyTotals' => array_values($monthlyTotals),
            'totals' => $totals,
            'settings' => $settings
        ]);
    }

    public function resetStocks()
    {
        $database = app(Database::class);
        $stockPath = 'exchanger/stocks';

        $resetValue = 300;

        $data = [
            '1' => $resetValue,
            '5' => $resetValue,
            '10' => $resetValue,
            '20' => $resetValue,
        ];

        $database->getReference($stockPath)->set($data);

        return redirect()->back()->with('success', 'Coin stocks have been reset to 300 pcs.');
    }

    public function updateFee(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric|min:0|max:100',
        ]);

        $database = app(Database::class);
        $database->getReference('exchanger/settings/fee')
            ->set((float) $request->input('fee'));

        return redirect()->back()->with('success', 'Fee multiplier updated successfully.');
    }

}
