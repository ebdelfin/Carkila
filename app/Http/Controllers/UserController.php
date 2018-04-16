<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Business;

class UserController extends Controller
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

        $user = Auth::user();

        $posts =  Vehicle::orderBy('created_at', 'desc')->paginate(6);
        if ($user->isAdmin()) {
            return view('pages.admin.dashboard');
        } if ($user->hasRole('vehicle.owner')) {

            $business = User::find($user->id)->vehicle;
            $posts = Vehicle::where('user_id', $user->id)->paginate(5);

            return view('pages.businessowner.dashboard') ->with('posts',$posts,'business',$business);
        

        } else {
            //return view('pages.investor.dashboard');
            return view('index')->with('posts', $posts);
        }
        

    }

    public function myFavorites() { 

        $data = [
            'myFavorites' => Auth::user()->favorites,
        ];

        if (Auth::user()->hasRole('investor')) {
            return view('pages.investor.my_favorites')->with($data);
        } else {
            return back()->with('error', 'Unauthorized Access');
        }
        
    }


}
