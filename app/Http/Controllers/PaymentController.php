<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Abstrak;
use App\Models\PaymentProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index(){
        $payment = User::withCount(['paymentProof'])->with(['paymentProof'])->where('id',auth()->user()->id)
                            ->first();
        return view('payment.index',[
            'payment'   =>  $payment,
        ]);
    }

    public function post(Request $request){
        $rules = [
            'payment_proof_file' => 'required|mimes:pdf|max:1024', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
        ];

        $validasi = Validator::make($request->all(), $rules);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $abstractAttributes = [
            'user_id'        => auth()->user()->id,
            'status'            =>  'pending',
        ];

        if ($request->hasFile('payment_proof_file')) {
            $file = $request->file('payment_proof_file');
            $fileName = $file->store('payment_proof_files', 'public');
            $abstractAttributes['payment_proof_file'] = $fileName;
        }

        $create = PaymentProof::create($abstractAttributes);

        if ($create) {
            return response()->json([
                'text'  =>  'Success, Your submission has been successfully processed. Thank you',
                'url'   =>  url('/upload_payment_proof/'),
            ]);
        }else {
            return response()->json(['text' =>  'Sorry, there was an issue with your submission. Please check the form and try again']);
        }
    }

    public function download(PaymentProof $paymentProof){
        if ($paymentProof) {
            $filePath = storage_path("app/public/{$paymentProof->payment_proof_file}");
            if (Storage::disk('public')->exists("{$paymentProof->payment_proof_file}")) {
                return response()->download($filePath);
            } else {
                // Handle file not found in storage
                abort(404);
            }
        } else {
            // Handle file record not found in the database
            abort(404);
        }
    }

    public function destroy(PaymentProof $paymentProof){
        $delete = $paymentProof->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Payment Proof Reset Successfully. Please Upload a New One!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else {
            $notification = array(
                'message' => 'Payment Proof Reset Failed!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function submit(PaymentProof $paymentProof){
        $update = $paymentProof->update([
            'status'    =>  'send',
        ]);

        if ($update) {
            $notification = array(
                'message' => 'The payment proof has been successfully submitted and is now locked for further changes.!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else {
            $notification = array(
                'message' => 'The attempt to submit the payment proof has encountered an issue!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
