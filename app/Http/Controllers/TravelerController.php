<?php

namespace App\Http\Controllers;

use App\Traveler;
use Illuminate\Http\Request;

class TravelerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $travelers = \Auth::user()->company->travelers;

        return view('travelers.index')
            ->withTravelers($travelers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travelers.create');
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
            'first'    => 'required',
            'last'    => 'required',
            'phone'    => 'required',
            'address'    => 'required',
            'city'    => 'required',
            'state'    => 'required',
            'zip'    => 'required',
            'email'    => 'required|email', //DON'T WANT THIS TO BE UNIQUE IF WE'RE USING A BRIDGE TABLE TO ASSOCIATE
        ]);

        if(Traveler::where('email', $request->email)->count() < 1)
        {
            $traveler = Traveler::create($request->except(['_token']));
        }
        else
        {
            $traveler = Traveler::where('email', $email)->update($request->except(['_token']));
        }

        \Auth::user()->company->travelers()->attach($traveler->id);

        return redirect()->route('travelers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function show($traveler)
    {
        $traveler = Traveler::where('id', $traveler)->firstOrFail();

        return view('travelers.show')
            ->withTraveler($traveler);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function edit($traveler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $traveler)
    {
        //
    }
}
