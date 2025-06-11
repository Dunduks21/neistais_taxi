<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FailedJob;

class FailedJobController extends Controller
{
    public function index()
    {
        // Iegūstam failed jobs ar kārtību pēc failed_at un lapošanai
        $failedJobsPaginated = FailedJob::orderByDesc('failed_at')->paginate(10);

        // Pārveidojam paginēto kolekciju, lai iegūtu ride_id un driver_id no payload JSON
        $failedJobs = $failedJobsPaginated->getCollection()->map(function ($job) {
            $payload = json_decode($job->payload, true);

            $rideId = $driverId = null;

            if ($payload && isset($payload['data'])) {
                // Pieņemu, ka ride_id un driver_id atrodas šādās vietās:
                $rideId = $payload['data']['ride_id'] ?? null;
                $driverId = $payload['data']['driver_id'] ?? null;
            }

            // Pievienojam laukus kā dinamiskus atribūtus
            $job->ride_id = $rideId;
            $job->driver_id = $driverId;

            // Varētu arī piesaistīt created_at un cancelled_at, ja tie ir payload vai kā citādi
            // Šobrīd atstājam failed_at kā laiku, kad notika kļūda
            return $job;
        });

        // Aizstāj oriģinālo kolekciju ar pārveidoto
        $failedJobsPaginated->setCollection($failedJobs);

        return view('failed_jobs.index', ['failedJobs' => $failedJobsPaginated]);
    }

    public function retry($id)
    {
        \Artisan::call('queue:retry', [$id]);
        return redirect()->route('failed-jobs.index')->with('success', 'Darbs atkārtots.');
    }

    public function forget($id)
    {
        \Artisan::call('queue:forget', [$id]);
        return redirect()->route('failed-jobs.index')->with('success', 'Darbs izdzēsts.');
    }
}

