<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminCheck;
use App\Models\ApplicationSettings;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')
            ->only('setSetting');
        $this->middleware(AdminCheck::class)
            ->only('setSetting');
    }

    public function setSetting(Request $request){
        $setting = ApplicationSettings::updateOrCreate(['name' => $request->input('name')], $request->all(['value', 'comment']));
        return $setting;
    }
}
