<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Storage;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Report;

class ReportsController extends Controller
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
        try {
            $reportsSnapshot = $this->reference->getChild('reports');
            $snapshot = $reportsSnapshot->getSnapshot();
            $reports = $snapshot->getValue();

            $reportsArray = [];

            if (is_array($reports)) {
                foreach ($reports as $reportId => $reportData) {
                    $reportData['id'] = $reportId;
                    $reportsArray[] = $reportData;
                }

                usort($reportsArray, function ($a, $b) {
                    return strtotime($b['datetime']) - strtotime($a['datetime']);
                });
            }

            return view('reports', ['reports' => $reportsArray]);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to fetch reports: ' . $e->getMessage()]);
        }
    }


}