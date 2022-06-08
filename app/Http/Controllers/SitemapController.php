<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    //
    public function index(Request $request,$identifier){
        return DB::table($identifier)->select(['slug'])->get();
    }
}
