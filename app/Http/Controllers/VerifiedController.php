<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use Illuminate\Http\Request;

class VerifiedController extends Controller
{
    public function index(){
        $submissions = Abstrak::accepted()->get();
        return view('verified.index',[
            'submissions'   =>  $submissions,
        ]);
    }

    public function readMore(Abstrak $abstrak){
        return view('verified.detail',compact('abstrak'));
    }
}
