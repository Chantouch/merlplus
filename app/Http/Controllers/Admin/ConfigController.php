<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache()
    {
        $command = Artisan::call('cache:clear');
        if ($command == 0) {
            return redirect()->back()->with('success', 'Cache cleared successfully!');
        }
        return redirect()->back()->with('success', 'Cache cleared successfully!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function configClear()
    {
        $command = Artisan::call('config:clear');
        if ($command == 0) {
            return redirect()->back()->with('success', 'Configuration cache cleared!');
        }
        return redirect()->back()->with('success', 'Configuration cache cleared!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function configCache()
    {
        $command = Artisan::call('config:cache');
        if ($command == 0) {
            return redirect()->back()->with('success', 'Configuration cache successfully!');
        }
        return redirect()->back()->with('success', 'Configuration cache successfully!');
    }
}
