<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group_class;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $groupClasses = Group_class::all();
        return view('home',compact('groupClasses'));
    }

public function mail()
{
   $name = 'CSMT SCHOOLS';
   Mail::to('godsonoffor@rocketmail.com')->send(new SendMailable($name));
   
   return 'Email was sent';
}

}
