<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fee;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fees = Fee::mine()->filter($request->all())->get();

        return view('fees.index')
            ->withFees($fees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
        ]);

        $request->merge(['company_id' => \Auth::user()->company->id]);

        $fee = Fee::create($request->except(['_token']));

        return redirect()->route('fees.show', $fee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fee = Fee::mine()->where('id', $id)->firstOrFail();

        return view('fees.show')
            ->withFee($fee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee = Fee::mine()->where('id', $id)->firstOrFail();

        return view('fees.edit')
            ->withFee($fee);
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
        $request->validate([
            'title'    => 'required',
            'amount'    => 'required',
        ]);

        $fee = Fee::where('id', $id)->update($request->except(['_token']));

        return redirect()->route('fees.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fee::mine()->where('id', $id)->delete();

        return redirect()->route('fees');
    }
}
