<?php

namespace App\Http\Controllers;

use App\Models\PaymentProof;
use Illuminate\Http\Request;

class VerifiedPaymentController extends Controller
{
    public function index(){
        $payments = PaymentProof::with(['user.roles:name'])->accepted()->get();
        return view('verifiedPayment.index',[
            'payments'   =>  $payments,
        ]);
    }
}
