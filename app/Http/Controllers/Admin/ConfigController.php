<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function clearCache()
    {
        $command = Artisan::call('cache:clear');
        if ($command == 0) {
            return redirect()->back()->with('success', 'Cache clear successfully!');
        }
        return redirect()->back()->with('success', 'Cache clear successfully!');
    }
}
