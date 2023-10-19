<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
        return view('settings.index',compact('setting'));
    }

    public function update(Setting $setting, Request $request){
        $rules = [
            'app_name' => 'required', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
            'app_short_name' => 'required', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
            'app_description' => 'required', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
            'presenter_payment_amount' => 'required|numeric', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
            'participant_payment_amount' => 'required|numeric', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
        ];

        $validasi = Validator::make($request->all(), $rules);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $setting->update([
            'app_name'  =>  $request->app_name,
            'app_short_name'    =>  $request->app_short_name,
            'app_description'   =>  $request->app_description,
            'presenter_payment_amount'  =>  $request->presenter_payment_amount,
            'participant_payment_amount'    =>  $request->participant_payment_amount,
        ]);

        if ($setting) {
            return response()->json([
                'text'  =>  'our settings have been successfully updated.',
                'url'   =>  url('/settings/'),
            ]);
        }else {
            return response()->json(['text' =>  'Sorry, we could not update your settings']);
        }
    }
}
