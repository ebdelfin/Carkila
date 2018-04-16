<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('pages.renter.bookings.create');
    }

    public function create_request($owner_id,$vehicle_id){


        return view('pages.renter.bookings.create')->with('vehicle_id',$vehicle_id)->with('owner_id',$owner_id);
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

            'destination' => 'required',
            'pickup_location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'price' => 'required|numeric',
            'pax'=> 'required',
        ]);

        $booking = new Booking();
        $booking->destination = $request->input('destination');
        $booking->pickup_location = $request->input('pickup_location');
        $start_date = $request->input('start_date');
        $start_hours = $request->input('start_hours');
        $start_minutes = $request->input('start_minutes');
        $start_seconds= $request->input('start_seconds');
        $start_date_time = $start_date . " " . sprintf("%02d", $start_hours) .":". sprintf("%02d", $start_minutes) .":". $start_seconds;

        $booking->start_date_time =  $start_date_time;

        $end_date = $request->input('end_date');
        $end_hours = $request->input('end_hours');
        $end_minutes = $request->input('end_minutes');
        $end_seconds= $request->input('end_seconds');
        $end_date_time = $end_date . " " . sprintf("%02d", $end_hours) .":". sprintf("%02d", $end_minutes) .":". $end_seconds;

        $booking->end_date_time = $end_date_time;
        $booking->pax = $request->input('pax');
        $booking->status = "Pending";
        $booking->vehicle_id = $request->input('vehicle_id');
        $booking->owner_id = $request->input('owner_id');
        $booking->user_id = auth()->user()->id;



        $booking->save();
        //return  var_dump($end_date_time);
        return redirect()->route('home')->with('success', 'Request Submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requests = Booking::where('vehicle_id','=',$id)->first();
        //return var_dump($requests);
        return view ('pages.renter.bookings.show')->with('requests',$requests);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
