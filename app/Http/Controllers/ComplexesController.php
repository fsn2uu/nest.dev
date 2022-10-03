<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complex;
use App\Photo;

class ComplexesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $complexes = Complex::mine()->filter($request->all())->get();

        return view('complexes.index')
            ->withComplexes($complexes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check perms
        if(\Auth::user()->canCreateComplexes())
        {
            //check the number of complexes to make sure it doesn't exceed the plan limit (display flash if it does)
            $current = \Auth::user()->company->complexes->count();

            if(\Auth::user()->complex_unit_limit() == 0 || $current < \Auth::user()->complex_unit_limit()):
                return view('complexes.create');
            else:
                return view('complexes.limit')
                ->withCurrent(\Auth::user()->package());
            endif;
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to create this complex!']);
            \Session::flash('toast', $message);

            return redirect()->route('complexes');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make sure the user can create complexes
        if(\Auth::user()->canCreateComplexes())
        {
            // check allowed number of complexes before saving (in case they get around the form somehow)
            $current = \Auth::user()->company->complexes->count();

            if(\Auth::user()->complex_unit_limit() == 0 || $current < \Auth::user()->complex_unit_limit()):
                $request->validate([
                    'name' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip' => 'required',
                    'photos.*'    => 'sometimes|nullable|max:10000|mimes:jpg,jpeg,bmp,png,heic,heif',
                ]);

                $request->merge(['company_id' => \Auth::user()->company_id]);

                $complex = Complex::create($request->except(['_token', 'photos']));

                if($request->hasfile('photos')):
                    $complex_photos = [];
                    \Storage::makeDirectory('storage/'.\Auth::user()->company_id.'/complexes/'.$complex->id.'/');
                    foreach($request->file('photos') as $photo):
                        if($complex->photos->count() <= \Auth::user()->photo_limit()):
                            $name = $photo->getClientOriginalName();
                            $photo->move('storage/'.\Auth::user()->company_id.'/complexes/'.$complex->id.'/', $name);
                            $complex_photos[] = $name;
                        endif;
                    endforeach;
                    $i=1;
                    foreach($complex_photos as $pic):
                        Photo::create(['company_id' => \Auth::user()->company_id, 'complex_id' => $complex->id, 'filename' => $pic, 'order' => $i]);
                        $i++;
                    endforeach;
                endif;

                return redirect()->route('complexes.show', $complex->id);
            else:
                return view('complexes.limit')
                    ->withCurrent(\Auth::user()->package());
            endif;
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to create this complex!']);
            \Session::flash('toast', $message);

            return redirect()->route('complexes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complex = Complex::mine()->where('id', $id)->firstOrFail();

        return view('complexes.show')
            ->withComplex($complex);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->canUpdateComplexes())
        {
            $complex = Complex::mine()->where('id', $id)->firstOrFail();

            return view('complexes.edit')
            ->withComplex($complex);
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to update this complex!']);
            \Session::flash('toast', $message);

            return redirect()->route('complexes');
        }
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
        //check for permissions
        if(\Auth::user()->canUpdateComplexes())
        {
            //validate it
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'website'    => 'sometimes|nullable|url',
                'photos.*'    => 'sometimes|nullable|max:10000|mimes:jpg,jpeg,bmp,png,heic,heif',
            ]);

            $complex = Complex::mine()->where('id', $id)->firstOrFail();

            if($complex->update($request->except(['_token', 'photos'])))
            {
                if($request->hasfile('photos')):
                    $complex_photos = [];
                    \Storage::makeDirectory('storage/'.\Auth::user()->company_id.'/complexes/'.$complex->id.'/');
                    foreach($request->file('photos') as $photo):
                        if($complex->photos->count() <= \Auth::user()->photo_limit()):
                            $name = $photo->getClientOriginalName();
                            $photo->move('storage/'.\Auth::user()->company_id.'/complexes/'.$complex->id.'/', $name);
                            $complex_photos[] = $name;
                        endif;
                    endforeach;
                    foreach($complex_photos as $pic):
                        Photo::create(['company_id' => \Auth::user()->company_id, 'complex_id' => $complex->id, 'filename' => $pic]);
                    endforeach;
                endif;

                $message = serialize(['title' => 'Complex Updated', 'body' => 'The complex has been updated.']);
            }
            else
            {
                $message = serialize(['title' => 'Something Went Wrong', 'body' => 'Something went wrong and the complex wasn\'t updated.  Please try again later.']);
            }
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to update this complex!']);
        }

        $complex->amenities()->sync($request->amenities);

        \Session::flash('toast', $message);

        return redirect()->route('complexes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->canDeleteComplexes())
        {
            $complex = Complex::mine()->where('id', $id)->firstOrFail();

            foreach($complex->photos as $photo):
                \Storage::delete('storage/'.\Auth::user()->company_id.'/complexes/'.$id.'/'.$photo->filename);
                Photo::mine()->where('id', $photo->id)->delete();
            endforeach;

            foreach($complex->units as $unit):
                foreach($unit->photos as $photo):
                    \Storage::delete('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/'.$photo->filename);
                    Photo::mine()->where('id', $photo->id)->delete();
                endforeach;
                \Unit::mine()->where('id', $unit->id)->delete();
            endforeach;

            if($complex->delete())
            {
                $message = serialize(['title' => 'Complex Deleted', 'body' => 'The complex has been deleted.']);
                \Session::flash('toast', $message);
            }
            else
            {
                $message = serialize(['title' => 'Something Went Wrong', 'body' => 'Something went wrong and the complex wasn\'t deleted.  Please try again later.']);
                \Session::flash('toast', $message);
            }
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to delete this complex!']);
            \Session::flash('toast', $message);
        }

        return redirect()->route('complexes');
    }
}
