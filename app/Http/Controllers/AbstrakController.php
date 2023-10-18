<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Abstrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AbstrakController extends Controller
{
    public function index(){
        $abstrak = User::withCount('abstrak')->with(['abstrak'])->where('id',auth()->user()->id)->first();
        return view('abstrak.index',[
            'abstrak'   =>  $abstrak,
        ]);
    }

    public function post(Request $request){
        $rules = [
            'title' => 'required',
            'file_name' => 'required|mimes:pdf|max:1024', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
            'abstract' => 'required', // Memastikan kolom "abstract" diisi
        ];

        $validasi = Validator::make($request->all(), $rules);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $abstractAttributes = [
            'user_id'           =>  auth()->user()->id,
            'status'            =>  'pending',
            'submission_year'   =>  Carbon::now()->year,
            'title'             =>  $request->title,
            'abstrak'           =>  $request->abstract,
        ];

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = $file->store('file_names', 'public');
            $abstractAttributes['file_name'] = $fileName;
        }

        $create = Abstrak::create($abstractAttributes);

        if ($create) {
            return response()->json([
                'text'  =>  'Success, Your submission has been successfully processed. Thank you',
                'url'   =>  url('/submission/'),
            ]);
        }else {
            return response()->json(['text' =>  'Sorry, there was an issue with your submission. Please check the form and try again']);
        }
    }

    public function download(Abstrak $abstrak){

        if ($abstrak) {
            $filePath = storage_path("app/public/{$abstrak->file_name}");
            if (Storage::disk('public')->exists("{$abstrak->file_name}")) {
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

    public function destroy(Abstrak $abstrak){
        $delete = $abstrak->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Abstract Reset Successfully. Please Create a New One!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else {
            $notification = array(
                'message' => 'Abstract Reset Failed!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function submit(Abstrak $abstrak){
        $update = $abstrak->update([
            'status'    =>  'send',
        ]);

        if ($update) {
            $notification = array(
                'message' => 'The abstract has been successfully submitted and is now locked for further changes.!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else {
            $notification = array(
                'message' => 'The attempt to submit the abstract has encountered an issue!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
