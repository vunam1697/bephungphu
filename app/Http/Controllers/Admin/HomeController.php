<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\Posts;

class HomeController extends Controller
{
    public function index()
    {
        $dataPages = Pages::orderBy('created_at', 'DESC')->get();
        $count_post = Posts::where('type', 'blog')->count();
        return view('backend.home', compact('dataPages', 'count_post'));
    }


    public function getLayOut(Request $request)
    {
    	$index = $request->index;
    	$type = $request->type;
    	if(view()->exists('backend.repeater.row-'.$type)){
		    return view('backend.repeater.row-'.$type, compact('index'))->render();
		}
		return '404';
    }
}
