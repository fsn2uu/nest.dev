<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RateTable;
use App\Rate;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = RateTable::mine()->get();

        return view('rates.index')
            ->withRates($rates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $rate_table = new RateTable;
        $rate_table->company_id = \Auth::user()->company->id;
        $rate_table->name = $request->name;
        if($request->complex_id != '')
        {
            $rate_table->complex_id = $request->complex_id;
        }
        if($request->unit_id != '')
        {
            $rate_table->unit_id = $request->unit_id;
        }
        $rate_table->save();

        foreach($request->rates as $rate)
        {
            if($rate['amount'] > 0)
            {
                $rate_obj = new Rate;
                $rate_obj->rate_table_id = $rate_table->id;
                $rate_obj->name = $rate['name'];
                if($rate['start_date'] != '')
                {
                    $rate_obj->start_date = \Carbon\Carbon::parse($rate['start_date'])->format('Y-m-d');
                }
                if($rate['end_date'] != '')
                {
                    $rate_obj->end_date = \Carbon\Carbon::parse($rate['end_date'])->format('Y-m-d');
                }
                $rate_obj->amount = $rate['amount'];
                $rate_obj->save();
            }
        }

        return redirect()->route('rates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
