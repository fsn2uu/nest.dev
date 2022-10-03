<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Photo;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units = Unit::mine()->filter($request->all())->available($request->all())->get();

        return view('units.index')
            ->withUnits($units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->canCreateUnits()):
            $current = \Auth::user()->company->units->count();

            if(\Auth::user()->complex_unit_limit() == 0 || $current < \Auth::user()->complex_unit_limit()):
                return view('units.create');
            else:
                return view('units.limit')
                    ->withCurrent(\Auth::user()->package());
            endif;
        else:
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to create this unit!']);
            \Session::flash('toast', $message);

            return redirect()->route('units');
        endif;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->canCreateUnits()):
            $current = \Auth::user()->company->units->count();

            if(\Auth::user()->complex_unit_limit() == 0 || $current < \Auth::user()->complex_unit_limit()):
                $request->validate([
                    'name'    => 'required',
                    'address'    => 'required_without:complex_id',
                    'city'    => 'required_without:complex_id',
                    'state'    => 'required_without:complex_id',
                    'zip'    => 'required_without:complex_id',
                    'photos.*'    => 'sometimes|nullable|max:10000|mimes:jpg,jpeg,bmp,png,heic,heif',
                ]);

                $request->merge(['company_id' => \Auth::user()->company_id, 'status' => 'draft']);

                $unit = Unit::create($request->toArray());

                if($request->hasfile('photos')):
                    $unit_photos = [];
                    \Storage::makeDirectory('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/');
                    foreach($request->file('photos') as $photo):
                        if($unit->photos->count() <= \Auth::user()->photo_limit()):
                            $name = $photo->getClientOriginalName();
                            $photo->move('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/', $name);
                            $unit_photos[] = $name;
                        endif;
                    endforeach;
                    $i=1;
                    foreach($unit_photos as $pic):
                        Photo::create(['company_id' => \Auth::user()->company_id, 'unit_id' => $unit->id, 'filename' => $pic, 'order' => $i]);
                        $i++;
                    endforeach;
                endif;

                return redirect()->route('units.show', $unit->id);
            else:
                return view('units.limit')
                    ->withCurrent(\Auth::user()->package());
            endif;
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::mine()->where('id', $id)->firstOrFail();
        $travelers = \Auth::user()->company->travelers;

        return view('units.show')
            ->withUnit($unit)
            ->withTravelers($travelers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->canUpdateUnits()):
            $unit = Unit::mine()->where('id', $id)->firstOrFail();

            return view('units.edit')
                ->withUnit($unit);
        else:
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to update this unit!']);
            \Session::flash('toast', $message);

            return redirect()->route('units');
        endif;
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
        if(\Auth::user()->canUpdateUnits()):
            $request->validate([
                'name'    => 'required',
                'address'    => 'required',
                'city'    => 'required',
                'state'    => 'required',
                'zip'    => 'required',
                'photos.*'    => 'sometimes|nullable|max:10000|mimes:jpg,jpeg,bmp,png,heic,heif',
            ]);

            $request->merge(['company_id' => \Auth::user()->company_id]);

            if(!$request->has('pet_friendly'))
            {
                $request->merge(['pet_friendly' => 0]);
            }

            $unit = Unit::update($request->except(['_token']));

            $unit->amenities()->sync($request->amenities);

            if($request->hasfile('photos')):
                $unit_photos = [];
                \Storage::makeDirectory('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/');
                foreach($request->file('photos') as $photo):
                    if($unit->photos->count() <= \Auth::user()->photo_limit()):
                        $name = $photo->getClientOriginalName();
                        $photo->move('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/', $name);
                        $unit_photos[] = $name;
                    else:
                        $message = serialize(['title' => 'Oops', 'body' => 'You tried to upload too many photos to this unit.  You will need to upgrade your plan before uploading more.']);
                    endif;
                endforeach;
                //get the order of the last photo added or set to 1
                foreach($unit_photos as $pic):
                    Photo::create(['company_id' => \Auth::user()->company_id, 'unit_id' => $unit->id, 'filename' => $pic]);
                endforeach;
            endif;

            $message = serialize(['title' => 'Unit Updated', 'body' => 'The unit has been updated.']);
            \Session::flash('toast', $message);

            return redirect()->route('units.show', $unit->id);
        else:
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to update this unit!']);
            \Session::flash('toast', $message);

            return redirect()->route('units');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->canDeleteUnits())
        {
            $unit = Unit::mine()->where('id', $id)->firstOrFail();

            foreach($unit->photos as $photo):
                \Storage::delete('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/'.$photo->filename);
                Photo::mine()->where('id', $photo->id)->delete();
            endforeach;

            if($unit->delete())
            {
                $message = serialize(['title' => 'Unit Deleted', 'body' => 'The unit has been deleted.']);
                \Session::flash('toast', $message);
            }
            else
            {
                $message = serialize(['title' => 'Something Went Wrong', 'body' => 'Something went wrong and the unit wasn\'t deleted.  Please try again later.']);
                \Session::flash('toast', $message);
            }
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to delete this unit!']);
            \Session::flash('toast', $message);
        }

        return redirect()->route('complexes');
    }
}
