<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DeviceController extends Controller
{
    public function detectDevice(Request $request)
    {
        $agent = new Agent();

        // Mendapatkan informasi perangkat
        $device = $agent->device(); // Mendapatkan nama perangkat
        $platform = $agent->platform(); // Mendapatkan platform (OS)
        $browser = $agent->browser(); // Mendapatkan browser

        // Mengambil informasi lebih detail
        $isPhone = $agent->isPhone();
        $isTablet = $agent->isTablet();
        $isDesktop = $agent->isDesktop();
        $isBot = $agent->isRobot();

        // Menampilkan informasi ke view atau log
        return view('deviceinfo', compact('device', 'platform', 'browser', 'isPhone', 'isTablet', 'isDesktop', 'isBot'));
    }
}
