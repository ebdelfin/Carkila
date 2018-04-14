<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
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
        //
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
        $vehicle->color = $request->input('color');
        $vehicle->seating_capacity = $request->input('seating_capacity');
        $vehicle->engine_number = $request->input('engine_number');
        $vehicle->chassis_number = $request->input('chassis_number');
        $vehicle->plate_number = $request->input('plate_number');
        $vehicle->rental_rate = $request->input('rental_rate');

        $vehicle->user_id = auth()->user()->id;

        if ($request->hasFile('featured_image')) {
            $image  = $request->file('featured_image');
            $file_name =  time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/images/users/id/' . $vehicle->user_id . '/uploads/posts/';

            // Make the user a folder and set permissions

            if (!file_exists($location)) {
                mkdir($location, 666, true);
            }


            Image::make($image)->save($location.$file_name);

            $vehicle->image = '/images/users/id/' . $vehicle->user_id . '/uploads/posts/'. $file_name;
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
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
