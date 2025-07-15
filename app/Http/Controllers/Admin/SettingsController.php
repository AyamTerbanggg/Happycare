<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'app_name' => config('app.name'),
            'app_url' => config('app.url'),
            'app_locale' => config('app.locale'),
            'app_timezone' => config('app.timezone'),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:100',
            'app_url' => 'required|url',
            'app_locale' => 'required|string',
            'app_timezone' => 'required|string',
        ]);

        // Update config/app.php secara dinamis (hanya contoh, idealnya pakai DB/settings table)
        $configPath = config_path('app.php');
        $config = File::get($configPath);
        $config = preg_replace(
            "/'name'\s*=>\s*'[^']*'/",
            "'name' => '" . addslashes($request->app_name) . "'",
            $config
        );
        $config = preg_replace(
            "/'url'\s*=>\s*'[^']*'/",
            "'url' => '" . addslashes($request->app_url) . "'",
            $config
        );
        $config = preg_replace(
            "/'locale'\s*=>\s*'[^']*'/",
            "'locale' => '" . addslashes($request->app_locale) . "'",
            $config
        );
        $config = preg_replace(
            "/'timezone'\s*=>\s*'[^']*'/",
            "'timezone' => '" . addslashes($request->app_timezone) . "'",
            $config
        );
        File::put($configPath, $config);
        Artisan::call('config:clear');

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
} 