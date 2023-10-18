<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use Illuminate\Http\Request;

class AwaitingController extends Controller
{
    public function index(){
        $submissions = Abstrak::sent()->get();
        return view('awaiting.index',[
            'submissions'   =>  $submissions,
        ]);
    }

    public function verify(Request $request){
        $update = Abstrak::where('id',$request->id)->update([
            'status' => $request->verification
        ]);

        if ($update) {
            $notification = array(
                'message' => 'Verification Successful!',
                'alert-type' => 'success'
            );
            return redirect()->route('awaiting')->with($notification);
        }else{
            $notification = array(
                'message' => 'Verification Failed!',
                'alert-type' => 'success'
            );
            return redirect()->route('awaiting')->with($notification);
        }
    }

    public function readMore(Abstrak $abstrak){
        return view('awaiting.detail',compact('abstrak'));
    }
}
