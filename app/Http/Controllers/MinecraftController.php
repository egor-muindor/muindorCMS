<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MinecraftController extends Controller
{
    /**
     * Main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        return view('MC.login');
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);

        $pass = ApplicationSettings::find('mc-backup_password');

        if ($pass->value === $request->get('password')) {
            $token = Str::random(32);
            $token_model = ApplicationSettings::findOrNew('mc-backup_token');
            $token_model->update(['name'  => 'mc-backup_token', 'value' => $token]);

            $format = static function ($size, $precision = 2)
            {
                $base = log($size, 1024);
                $suffixes = array('bytes', 'KB', 'MB', 'GB', 'TB');

                return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
            };

            $files = \File::files(storage_path() . '/app/public/minecraft-backup/');

            return view('MC.lk')->with(compact('token', 'files', 'format'));
        }

        return back();
    }

}
