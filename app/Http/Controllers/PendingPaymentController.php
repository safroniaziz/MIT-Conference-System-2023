<?php

namespace App\Http\Controllers;

use App\Models\PaymentProof;
use Illuminate\Http\Request;

class PendingPaymentController extends Controller
{
    public function index(){
        $payments = PaymentProof::with(['user.roles:name'])->sent()->get();
        return view('pendingPayments.index',[
            'payments'   =>  $payments,
        ]);
    }

    public function verify(Request $request){
        $update = PaymentProof::where('id',$request->id)->update([
            'status' => $request->verification
        ]);

        if ($update) {
            $notification = array(
                'message' => 'Verification Successful!',
                'alert-type' => 'success'
            );
            return redirect()->route('pendingPayment')->with($notification);
        }else{
            $notification = array(
                'message' => 'Verification Failed!',
                'alert-type' => 'success'
            );
            return redirect()->route('pendingPayment')->with($notification);
        }
    }
}
