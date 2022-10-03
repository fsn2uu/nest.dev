<?php

use Illuminate\Http\Request;
use App\RateTable;
use App\Rate;
use App\Unit;
use App\Complex;
use App\Company;

Route::middleware('auth:api')->prefix('v1')->group(function(){
    Route::get('/company', function(Request $request){
        return $request->user();
    });

    Route::get('/complexes', function(Request $request){
        if($request->has('complex_id'))
        {
            return Complex::where('id', $request->complex_id)->where('status', '!=', 'draft')->firstOrFail();
        }
        else
        {
            if($request->has('ignore_status'))
            {
                return $request->user()->complexes;
            }
            else
            {
                return $request->user()->complexes->filter(function($complex){
                    return $complex->status != 'draft';
                });
            }
        }
    });

    Route::get('/units', function(Request $request){
        if($request->has('unit_id'))
        {
            return Unit::where('id', $request->unit_id)->where('status', '!=', 'draft')->firstOrFail();
        }
        else
        {
            if($request->has('ignore_status'))
            {
                return $request->user()->units;
            }
            else
            {
                return $request->user()->units->filter(function($unit){
                    return $unit->status != 'draft';
                });
            }
        }
    });

    Route::get('/rates', function(Request $request){
        if($request->has('unit_id'))
        {
            $unit = Unit::where('id', $request->unit_id)->firstOrFail();

            if($unit->rate_table)
            {
                $table = $unit->rate_table->toArray();
                $rates = ['rates' => $unit->rate_table->rates->toArray()];
                return json_encode(array_merge($table, $rates));
            }
            elseif($unit->complex->rate_table)
            {
                $table = $unit->complex->rate_table->toArray();
                $rates = ['rates' => $unit->complex->rate_table->rates->toArray()];
                return json_encode(array_merge($table, $rates));
            }
            else
            {
                $table = $request->user()->rate_table->toArray();
                $rates = ['rates' => $request->user()->rate_table->rates->toArray()];
                return json_encode(array_merge($table, $rates));
            }
        }
    });
});
