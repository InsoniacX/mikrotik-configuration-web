<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class MikrotikController extends Controller
{
    public function index()
    {
        $ip = '172.16.0.237';
        $username = 'InscX';
        $password = 'DiniNurAziza@12345#';
        $api = new RouterosAPI();
        $api->debug('false');

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

        $data = [
            'ip' => $ip,
            'username' => $username,
            'password' => $password,
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
        dd($data);
    }
}
