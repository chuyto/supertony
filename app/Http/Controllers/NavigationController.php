<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class NavigationController extends Controller
{
    public function show()
    {
        $settings = Settings::first();
        $logoPath = $settings->logo_company ?? null;
        return view('navigation-menu.blade.php', ['logoPath' => $logoPath]);
    }
}
