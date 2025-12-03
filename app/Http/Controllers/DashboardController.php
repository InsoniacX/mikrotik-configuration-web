<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mikrotikController = new MikrotikController();
        return $mikrotikController->index();
    }
}
