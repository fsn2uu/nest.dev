<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;

class PhotosController extends Controller
{
    public function update(Request $request)
    {
        $photo = Photo::mine()->where('id', $request->id)->firstOrFail();

        $photo->update($request->toArray());
    }

    public function delete(Request $request)
    {
        $photo = Photo::mine()->where('id', $request->id)->firstOrFail();

        \Storage::delete('storage/'.\Auth::user()->company_id.'/units/'.$request->complex_id.'/'.$photo->filename);

        $photo->delete();
    }
}
