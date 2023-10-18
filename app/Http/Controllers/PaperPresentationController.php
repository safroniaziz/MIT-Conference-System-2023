<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\AbstrakPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaperPresentationController extends Controller
{
    public function index(){
        $paper = Abstrak::withCount(['abstrakPaper'])->with(['abstrakPaper'])->where('user_id',auth()->user()->id)
                            ->first();
        return view('paper.index',[
            'paper'   =>  $paper,
        ]);
    }

    public function post(Request $request){
        $rules = [
            'paper_file' => 'required|mimes:pdf|max:1024', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
            'presentation_file' => 'required|mimes:pdf|max:1024', // Memeriksa tipe file (PDF) dan ukuran (maksimum 1 MB)
        ];

        $validasi = Validator::make($request->all(), $rules);
        if ($validasi->fails()) {
            return response()->json(['error'  =>  0, 'text'   =>  $validasi->errors()->first()],422);
        }

        $abstrak = Abstrak::where('user_id',auth()->user()->id)->first();
        $abstractAttributes = [
            'abstrak_id'        =>  $abstrak->id,
            'status'            =>  'pending',
        ];

        if ($request->hasFile('paper_file')) {
            $file = $request->file('paper_file');
            $fileName = $file->store('paper_files', 'public');
            $abstractAttributes['paper_file'] = $fileName;
        }

        if ($request->hasFile('presentation_file')) {
            $file = $request->file('presentation_file');
            $fileName = $file->store('presentation_files', 'public');
            $abstractAttributes['presentation_file'] = $fileName;
        }

        $create = AbstrakPaper::create($abstractAttributes);

        if ($create) {
            return response()->json([
                'text'  =>  'Success, Your paper and presentation file has been successfully processed. Thank you',
                'url'   =>  route('paper'),
            ]);
        }else {
            return response()->json(['text' =>  'Sorry, there was an issue with your paper and presentation file. Please check the form and try again']);
        }
    }

    public function downloadPaper(AbstrakPaper $paper){
        if ($paper) {
            $filePath = storage_path("app/public/{$paper->paper_file}");
            if (Storage::disk('public')->exists("{$paper->paper_file}")) {
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

    public function downloadPresentation(AbstrakPaper $paper){
        if ($paper) {
            $filePath = storage_path("app/public/{$paper->presentation_file}");
            if (Storage::disk('public')->exists("{$paper->presentation_file}")) {
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

    public function destroy(AbstrakPaper $paper){
        $delete = $paper->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Paper and presentation file Reset Successfully. Please Upload a New One!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else {
            $notification = array(
                'message' => 'Paper and presentation file Reset Failed!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function submit(AbstrakPaper $paper){
        $update = $paper->update([
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
