<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;
use Auth;
use Mail;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' =>['index','show']]);
    }

    public function index()
    {
        $vehicles = Vehicle::all();
        return view('pages.vehicleowner.vehicle.index')->with('vehicles', $vehicles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vehicleowner.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'type' => 'required',
            'color' => 'required',
            'seating_capacity' => 'required|numeric',
            'engine_number'=> 'required',
            'chassis_number'=> 'required',
            'plate_number'=> 'required',
            'rental_rate' => 'required|numeric',
        ]);

        $vehicle = new Vehicle;
        $vehicle->make = $request->input('make');
        $vehicle->model = $request->input('model');
        $vehicle->year = $request->input('year');
        $vehicle->type = $request->input('type');
        $vehicle->color = $request->input('color');
        $vehicle->seating_capacity = $request->input('seating_capacity');
        $vehicle->engine_number = $request->input('engine_number');
        $vehicle->chassis_number = $request->input('chassis_number');
        $vehicle->plate_number = $request->input('plate_number');
        $vehicle->rental_rate = $request->input('rental_rate');
        $vehicle->notes = $request->input('notes');
        $vehicle->user_id = auth()->user()->id;

        if ($request->hasFile('featured_image')) {
            $image  = $request->file('featured_image');
            $file_name =  time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/images/users/id/' . $vehicle->user_id . '/uploads/vehicles/';

            // Make the user a folder and set permissions

            if (!file_exists($location)) {
                mkdir($location, 666, true);
            }


            Image::make($image)->save($location.$file_name);

            $vehicle->image = '/images/users/id/' . $vehicle->user_id . '/uploads/vehicles/'. $file_name;
        }

        $vehicle->save();

        return redirect()->route('home')->with('success', 'Vehicle listing published!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        /*$address = DB::table('users')->select('address')->where('id','=',(DB::table('vehicles')->select('user_id')->where('id','=',$id))->implode('user_id'))->get()->implode('address');*/
        return view('pages.vehicleowner.vehicle.show')->with('vehicle',$vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        return view('pages.vehicleowner.vehicle.edit')->with('vehicle',$vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'type' => 'required',
            'color' => 'required',
            'seating_capacity' => 'required|numeric',
            'engine_number'=> 'required',
            'chassis_number'=> 'required',
            'plate_number'=> 'required',
            'rental_rate' => 'required|numeric',
        ]);

        $vehicle = Vehicle::find($id);
        $vehicle->make = $request->input('make');
        $vehicle->model = $request->input('model');
        $vehicle->year = $request->input('year');
        $vehicle->type = $request->input('type');
        $vehicle->color = $request->input('color');
        $vehicle->seating_capacity = $request->input('seating_capacity');
        $vehicle->engine_number = $request->input('engine_number');
        $vehicle->chassis_number = $request->input('chassis_number');
        $vehicle->plate_number = $request->input('plate_number');
        $vehicle->rental_rate = $request->input('rental_rate');
        $vehicle->notes = $request->input('notes');

        if ($request->featured_image) {
            // add new featured image
            $image  = $request->file('featured_image');
            $file_name =  time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/images/users/id/' . $vehicle->user_id . '/uploads/vehicles/';

            // Make the user a folder if nonexistent and set permissions
            if (!file_exists($location)) {
                mkdir($location, 666, true);
            }

            Image::make($image)->save($location.$file_name);

            if ( !empty($vehicle->image)) {
                // delete the old image from directory
                $oldFileName =  public_path() . $vehicle->image;
                File::delete($oldFileName);
            }


            // update the database
            $vehicle->image = '/images/users/id/' . $vehicle->user_id . '/uploads/vehicles/'. $file_name;


        }

        $vehicle->save();

        return redirect()->route('home')->with('success', 'Vehicle listing Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Vehicle::find($id);

        if(auth()->user()->id !==$post->user_id){
            return redirect()->route('home')->with('error', 'Unauthorized Page');
        }
        $post->delete();
        return redirect()->route('home')->with('success', 'Vehicle Removed');
    }

    public function galleryIndex(Post $post) {
        return view('posts.gallery')->with('post', $post);
    }

    public function galleryUpload(Request $request) {

        $post_id = $request->input('post_id');
        $post = Vehicle::find($post_id);

        // get file from the post request
        $image = $request->file('file');

        // set file name
        $file_name = uniqid() . '.' . $image->getClientOriginalExtension();



        $location = public_path() . '/images/users/id/' . $post->user_id . '/uploads/vehicles/gallery/';

        // Make the user a folder if nonexistent and set permissions
        if (!file_exists($location)) {
            mkdir($location, 666, true);
        }

        Image::make($image)->save($location.$file_name);

        // save tinto he database
        $file_path = '/images/users/id/' . $post->user_id . '/uploads/vehicles/gallery/'. $file_name;

        $image = $post->images()->create([
            'post_id'   => $post_id,
            'image'     => $file_path,
        ]);

        return $image;

    }


    public function galleryDelete($id)
    {
        $image = GalleryImage::find($id);

        // Delete Image from directory
        unlink(public_path($image->image));

        // Delete image from database
        $image->delete();

        return back();
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $make =  $request->input('make');
        $model =  $request->input('model');
        $type =  $request->input('type');
        $city =  $request->input('city');
        $min =  $request->input('min');
        $max =  $request->input('max');

        if (is_null($min)){
            $min = 0;
        }
        if (is_null($max)) {
           $max = 999999999999999;
        }

        $search_vehicles = Vehicle::orderBy('created_at', 'desc')->orwhere('make', 'LIKE', '%'.$search.'%')->orwhere('model', 'LIKE', '%'.$search.'%')->paginate(6);


        if (is_null($city)) {
            $posts = Vehicle::orderBy('created_at', 'desc')
                ->where('make', 'LIKE', '%'.$make.'%')
                ->where('model', 'LIKE', '%'.$model.'%')
                ->where('type', 'LIKE', '%'.$type.'%')
                ->whereBetween('rental_rate', [$min, $max])


                ->paginate(6);
        }else{
            $posts = Vehicle::orderBy('created_at', 'desc')
                ->where('make', 'LIKE', '%'.$make.'%')
                ->where('model', 'LIKE', '%'.$model.'%')
                ->where('type', 'LIKE', '%'.$type.'%')
                ->whereBetween('rental_rate', [$min, $max])
                ->where('user_id', '=', DB::table('users')->select('id')->where('city',$city)->implode('id'))


                ->paginate(6);
        }

        //return var_dump($city);
        //return var_dump(DB::table('users')->select('id')->where('city',$city)->implode('id'));
        return view('index')->with('posts', $posts,'search_vehicles',$search_vehicles);
    }

    public function search_initial(Request $request) {
        $search = $request->input('search');

        $posts = Vehicle::orderBy('created_at', 'desc')->orwhere('make', 'LIKE', '%'.$search.'%')->orwhere('model', 'LIKE', '%'.$search.'%')->paginate(6);



        //return $make;
        return view('index')->with('posts', $posts);
    }

}

