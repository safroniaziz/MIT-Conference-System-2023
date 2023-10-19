<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    public function index(){
        $participants = User::participant()->get();
        return view('participant.index',[
            'participants'  =>  $participants
        ]);
    }

    public function updatePassword (Request $request){
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'min:8',            // Panjang minimal 8 karakter
                'max:20',           // Panjang maksimal 20 karakter
                'confirmed',        // Password harus dikonfirmasi
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
                // Aturan untuk kombinasi karakter (minimal 1 huruf besar, 1 huruf kecil, 1 angka, 1 karakter khusus)
            ],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => 0, 'text' => $validator->errors()->first()], 422);
        }

        $updatePassword = User::where('id',$request->id)->update([
            'password'  =>  Hash::make($request->password),
        ]);

        if ($updatePassword) {
            return response()->json([
                'text'  =>  'Congratulations, the participant password has been successfully updated.',
                'url'   =>  url('/participants/'),
            ]);
        }else {
            return response()->json(['text' =>  'Apologies, the update of the participant password was not successful.']);
        }
    }
}
