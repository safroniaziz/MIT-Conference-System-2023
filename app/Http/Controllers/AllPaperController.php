<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use Illuminate\Http\Request;

class AllPaperController extends Controller
{
    public function index(){
        $papers = Abstrak::with(['abstrakPaper'])
                        ->has('abstrakPaper') // Mengambil hanya abstrak yang memiliki setidaknya satu abstrakPaper
                        ->where('user_id', auth()->user()->id)
                        ->get();
        return view('allPapers.index',[
            'papers'   =>  $papers,
        ]);
    }
}
