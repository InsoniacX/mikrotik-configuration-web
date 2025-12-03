<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class MikrotikController extends Controller
{
    private $ip = '172.16.0.237';
    private $username = 'InscX';
    private $password = 'DiniNurAziza@12345#';

    /**
     * Get RouterOS API Instance.
     */
    private function getApi()
    {
        $api = new RouterosAPI();
        $api->debug(false);
        return $api;
    }

    private function formatSize($bytes, $total = null)
    {
        $gb = round($bytes / 1024 / 1024 / 1024, 2);
        return $total
            ? "{$gb} GB Free of " . round($total / 1024 / 1024 / 1024, 2) . " GB"
            : "{$gb} GB";
    }

    private function fetchLogs($api)
    {
        $logs = $api->comm('/log/print');
        return isset($logs['! trap']) ?  [] : array_slice(array_reverse($logs), 0, 10);
    }

    public function index()
    {
        $api = $this->getApi();

        if (!$api->connect($this->ip, $this->username, $this->password)) {
            return view('dashboard')->with('error', 'Koneksi Gagal! ');
        }

        $resource = $api->comm('/system/resource/print')[0] ?? [];
        $clock = $api->comm('/system/clock/print')[0] ?? [];
        $identity = $api->comm('/system/identity/print')[0] ?? [];
        $routerboard = $api->comm('/system/routerboard/print')[0] ?? [];
        $health = $api->comm('/system/health/print');

        return view('dashboard', [
            'identity' => $identity['name'] ?? 'N/A',
            'model' => $resource['board-name'] ?? 'N/A',
            'uptime' => $resource['uptime'] ?? 'N/A',
            'date' => $clock['date'] ??  date('Y-m-d'),
            'time' => $clock['time'] ?? date('H:i:s'),
            'cpu' => ($resource['cpu-load'] ?? 0) .  '%',
            'memory' => $this->formatSize($resource['free-memory'] ?? 0, $resource['total-memory'] ??  0),
            'disk' => $this->formatSize($resource['free-hdd-space'] ?? 0, $resource['total-hdd-space'] ?? 0),
            'temperature' => ($health[1]['value'] ?? 'N/A') . ' °C',
            'version' => $resource['version'] ?? 'N/A',
            'boardmodel' => $routerboard['model'] ?? 'N/A',
            'isrouterboard' => $routerboard['routerboard'] ?? 'false',
            'logs' => $this->fetchLogs($api),
        ]);
    }

    /**
     * Get real-time Router Specific Data.
     */
    public function getRealtimeData()
    {
        $api = $this->getApi();

        if (!$api->connect($this->ip, $this->username, $this->password)) {
            return response()->json(['error' => 'Connection failed'], 500);
        }

        $resource = $api->comm('/system/resource/print')[0] ?? [];
        $clock = $api->comm('/system/clock/print')[0] ?? [];
        $identity = $api->comm('/system/identity/print')[0] ?? [];
        $routerboard = $api->comm('/system/routerboard/print')[0] ?? [];

        return response()->json([
            'date' => $clock['date'] ??  date('Y-m-d'),
            'time' => $clock['time'] ?? date('H:i:s'),
            'uptime' => $resource['uptime'] ?? '0s',
            'boardName' => $identity['name'] ?? 'N/A',
            'model' => $routerboard['model'] ?? 'N/A',
            'osVersion' => $resource['version'] ?? 'N/A',
            'cpu' => ($resource['cpu-load'] ?? 0) . '%',
            'memory' => $this->formatSize($resource['free-memory'] ?? 0, $resource['total-memory'] ?? 0),
            'disk' => $this->formatSize($resource['free-hdd-space'] ?? 0, $resource['total-hdd-space'] ?? 0),
        ]);
    }

    /**
     * Get real-time Traffic Data.
     */
    public function getTrafficData()
    {
        $api = $this->getApi();

        if (!$api->connect($this->ip, $this->username, $this->password)) {
            return response()->json(['error' => 'Connection failed'], 500);
        }

        $interfaces = $api->comm('/interface/print');
        $trafficData = [];

        foreach ($interfaces as $interface) {
            $name = $interface['name'];
            $stats = $api->comm('/interface/monitor-traffic', [
                'interface' => $name,
                'once' => '',
            ])[0] ?? [];

            $trafficData[] = [
                'interface' => $name,
                'rx-byte' => isset($stats['rx-byte']) ? round($stats['rx-byte'] / 1024 / 1024, 2) : 0,
                'tx-byte' => isset($stats['tx-byte']) ? round($stats['tx-byte'] / 1024 / 1024, 2) : 0,
            ];
        }

        return response()->json($trafficData);
    }
}
