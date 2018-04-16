<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Vehicle;
use App\Models\User;
use DB;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
    	$posts =  Vehicle::orderBy('created_at', 'desc')->paginate(6);
        //$vehicle = Vehicle::find($id);
        $address = DB::table('users')->select('address')->where('id', '=', (DB::table('vehicles')->select('user_id')->where('id', '=', 1))->implode('user_id'))->get()->implode('address');
        //$collection->push([$post->id,$address]);
        //$phone = User::where('id','1')->with('id')->get();
        $collection = collect([]);
        foreach ($posts as $post) {
            $address = DB::table('users')->select('address')->where('id', '=', (DB::table('vehicles')->select('user_id')->where('id', '=', $post->id))->implode('user_id'))->get()->implode('address');
            $collection->push([$post->id =>$address]);
        }
        //return $collection;
        return view('index')->with('posts', $posts)->with('collection',$collection);
    }
}

