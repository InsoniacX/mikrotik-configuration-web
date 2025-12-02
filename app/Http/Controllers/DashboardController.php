<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Only change for your Mikrotik Router IP, Username, and Password
        $ip = '<router-ip>';
        $username = '<your-username>';
        $password = '<your-password>';
        $api = new RouterosAPI();
        $api->debug('false');

        if ($api->connect($ip, $username, $password)) {
            $identity = $api->comm('/system/identity/print');
            $model = $api->comm('/system/resource/print');
            $uptime = $api->comm('/system/resource/print');
            $date = $api->comm('/system/clock/print');
            $time = $api->comm('/system/clock/print');
            $cpu = $api->comm('/system/resource/print');
            $memory = $api->comm('/system/resource/print');
            $disk = $api->comm('/system/resource/print');
            $temperature = $api->comm('/system/health/print');
            $version = $api->comm('/system/resource/print');
            $isrouterboard = $api->comm('/system/routerboard/print');
            $boardmodel = $api->comm('/system/routerboard/print');
        } else {
            return view('dashboard')->with('error', 'Koneksi Gagal!');
        }

        $data = [
            'identity' => $identity[0]['name'],
            'model' => $model[0]['board-name'],
            'uptime' => $uptime[0]['uptime'],
            'date' => $date[0]['date'],
            'time' => $time[0]['time'],
            'cpu' => $cpu[0]['cpu-load'] . '%',
            'memory' => round($memory[0]['free-memory'] / 1024 / 1024, 2) . ' GB Free of ' . round($memory[0]['total-memory'] / 1024 / 1024, 2) . ' GB',
            'disk' => round($disk[0]['free-hdd-space'] / 1024 / 1024 / 1024, 2) . ' GB Free of ' . round($disk[0]['total-hdd-space'] / 1024 / 1024 / 1024, 2) . ' GB',
            'temperature' => $temperature[1]['value'] . ' °C',
            'version' => $version[0]['version'],
            'boardmodel' => $boardmodel[0]['model'],
            'isrouterboard' => $isrouterboard[0]['routerboard'],
        ];

        return view('dashboard', $data);
        // dd($data);
    }
}
