<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminCheck;
use App\Models\ApplicationSettings;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only('setSetting');
        $this->middleware(AdminCheck::class)
            ->only('setSetting');
    }

    public function setSetting(Request $request)
    {
        $data = $request->all();
        foreach ($data as $item) {
            $setting = ApplicationSettings::updateOrCreate(
                [
                    'name' => $item['name']
                ],
                [
                    'value' => $item['value'],
                    'comment' => $item['comment']
                ]);
        }

        return ['success' => true];
    }

    public function getSetting()
    {
        $setting = ApplicationSettings::all(['name', 'value', 'comment']);

        return $setting;
    }
}
