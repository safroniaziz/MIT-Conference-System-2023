<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use Illuminate\Http\Request;

class AllPaperController extends Controller
{
    public function index(){
        $papers = Abstrak::where('user_id', auth()->user()->id)
                        ->get();
                        return $papers;
        return view('allPapers.index',[
            'papers'   =>  $papers,
        ]);
    }
}
