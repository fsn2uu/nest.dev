<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstSignUpGreeting;
use App\Mail\NeedHelpImporting;
use App\Company;
use App\User;

Route::get('/payout-test', function(){
    $company = Company::where('id', \Auth::user()->company->id)->first();
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $payout = \Stripe\Transfer::create([
      "amount" => 400,
      "currency" => "usd",
      "destination" => $company->stripe_account_id,
      "transfer_group" => "ORDER_95"
    ]);
    dd($payout);
});

Route::get('/property', function(){
    $unit = \App\Unit::find(1);
    return view('property')
        ->withUnit($unit);
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', ['as' => 'home', function () {
    return view('home');
}])->middleware('guest');

Route::get('/about', ['as' => 'about', function () {
    return view('about');
}])->middleware('guest');

Route::get('/pricing', ['as' => 'pricing', function () {
    return view('pricing');
}])->middleware('guest');

Route::get('/questions-and-answers', ['as' => 'faq', function () {
    return view('faq');
}])->middleware('guest');

Route::get('/signup', [
    'as'    => 'signup',
    function ()
    {
        return view('signup');
    }
])->middleware('guest');

Route::post('/signup', function (Request $request) {
    $request->validate([
        'company_name'    => 'required|unique:companies,name',
        'company_phone'    => 'required|numeric',
        'company_address'    => 'required',
        'company_city'    => 'required',
        'company_state'    => 'required',
        'company_zip'    => 'required',
        'company_zip'    => 'required',
        'your_name'    => 'required',
        'your_email'    => 'required',
        'your_phone'    => 'required',
        'stripeToken'    => 'required',
    ]);

    //create the company
    $company = new Company;
    $company->name = $request->company_name;
    $company->phone = $request->company_phone;
    $company->address = $request->company_address;
    $company->address2 = $request->company_address2;
    $company->city = $request->company_city;
    $company->state = $request->company_state;
    $company->zip = $request->company_zip;
    $company->website = $request->company_url;
    $company->status = 'pending payment';
    $company->api_token = time() . str_random(54);
    $company->save();

    //send to Stripe
    $company->newSubscription('Nest VRM', $request->plan)->create($request->stripeToken, [
        'name'    => $request->company_name,
        'email'    => $request->your_email,
        'phone'    => $request->your_phone,
    ]);

    if($company->subscribed('Nest VRM'))
    {
        $company->update(['status' => 'active']);
    }

    //create the user
    $temp_password = str_random(15); //need to email this to the client & require a change

    $user = new User;
    $user->name = $request->your_name;
    $user->email = $request->your_email;
    $user->phone = $request->your_phone;
    $user->password = Hash::make($temp_password);
    $user->save();

    //make the superadmin
    $user->attachRole(1);

    //attach to the company
    $company->users()->attach($user->id);

    if($request->need_help)
    {
        Mail::to(env('SUPPORT_ADDRESS'))
            ->send(new NeedHelpImporting($company, $user));
    }

    //log in
    Auth::loginUsingId($user->id);

    //send the email
    Mail::to($user->email)
        ->send(new FirstSignUpGreeting($company, $user, $temp_password));

    //redirect to Dashboard
    return redirect()->route('dashboard');
})->middleware('guest');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
// DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE
Route::group(['middleware' => 'auth'], function(){
    Route::get('/permissions',[
        'as'    => 'permissions',
        function()
        {
            $permissions = \App\Permission::all();

            return view('xpermissionsindex')
                ->withPermissions($permissions);
        }
    ]);

    Route::get('/permissions/create', [
        'as'    => 'permissions.create',
        function()
        {
            return view('xpermissionscreate');
        }
    ]);

    Route::post('/permissions/create', [
        function(Request $request)
        {
            dd($request);
            if($request->permission_type == 'basic'):
                $permission = new \App\Permission;
                $permission->name = $request->name;
                $permission->display_name = $request->display_name;
                $permission->description = $request->description;
                $permission->save();
            else:
                $crud = explode(',',$request->crud_selected);
                foreach($crud as $c)
                {
                    $permission = new \App\Permission;
                    $permission->name = $c.'-'.$request->resource;
                    $permission->display_name = ucwords($c).' '.ucwords($request->resource);
                    $permission->description = 'Allows a user to '.$c.' a '.ucwords($request->resource);
                    $permission->save();
                }
            endif;
        }
    ]);
// DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE

    Route::get('/dashboard', [
        'as' => 'dashboard',
        function(){
            return view('dashboard');
        }
    ]);

    /*
    |--------------------------------------------------------------------------
    | Amenity Routes
    |--------------------------------------------------------------------------
    */
    // Route::get('/amenities', ['as' => 'amenities', 'uses' => 'AmenitiesController@index']);
    // Route::get('/amenities/create', ['as' => 'amenities.create', 'uses' => 'AmenitiesController@create']);
    // Route::post('/amenities/create', ['uses' => 'AmenitiesController@store']);
    // Route::get('/amenities/delete/{id}', ['as' => 'amenities.delete', 'uses' => 'AmenitiesController@destroy']);
    // Route::get('/amenities/{id}/edit', ['as' => 'amenities.edit', 'uses' => 'AmenitiesController@edit']);
    // Route::post('/amenities/{id}/edit', ['uses' => 'AmenitiesController@update']);
    // Route::get('/amenities/{id}', ['as' => 'amenities.show', 'uses' => 'AmenitiesController@show']);

    /*
    |--------------------------------------------------------------------------
    | Company Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/company', ['as' => 'companies.show', 'uses' => 'CompaniesController@show']);
    #Route::get('/company/edit/', ['as' => 'companies.edit', 'uses' => 'CompaniesController@edit']);
    Route::post('/company/edit/', ['as' => 'companies.edit', 'uses' => 'CompaniesController@update']);
    Route::post('/company/add-bank-account/', ['as' => 'addbank', 'uses' => 'CompaniesController@add_bank_account_post']);

    /*
    |--------------------------------------------------------------------------
    | Complex Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/complexes', ['as' => 'complexes', 'uses' => 'ComplexesController@index']);
    Route::get('/complexes/create', ['as' => 'complexes.create', 'uses' => 'ComplexesController@create']);
    Route::post('/complexes/create', ['uses' => 'ComplexesController@store']);
    Route::get('/complexes/delete/{id}', ['as' => 'complexes.delete', 'uses' => 'ComplexesController@destroy']);
    Route::get('/complexes/{id}/edit', ['as' => 'complexes.edit', 'uses' => 'ComplexesController@edit']);
    Route::post('/complexes/{id}/edit', ['uses' => 'ComplexesController@update']);
    Route::get('/complexes/{id}', ['as' => 'complexes.show', 'uses' => 'ComplexesController@show']);

    /*
    |--------------------------------------------------------------------------
    | Reservation Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/reservations', ['as' => 'reservations', 'uses' => 'ReservationsController@index']);
    Route::get('/reservations/create', ['as' => 'reservations.create', 'uses' => 'ReservationsController@create']);
    Route::post('/reservations/create', ['uses' => 'ReservationsController@store']);
    Route::get('/reservations/delete/{id}', ['as' => 'reservations.delete', 'uses' => 'ReservationsController@destroy']);
    Route::get('/reservations/{id}/edit', ['as' => 'reservations.edit', 'uses' => 'ReservationsController@edit']);
    Route::post('/reservations/{id}/edit', ['uses' => 'ReservationsController@update']);
    Route::get('/reservations/{id}', ['as' => 'reservations.show', 'uses' => 'ReservationsController@show']);

    /*
    |--------------------------------------------------------------------------
    | Unit Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/units', ['as' => 'units', 'uses' => 'UnitsController@index']);
    Route::get('/units/create', ['as' => 'units.create', 'uses' => 'UnitsController@create']);
    Route::post('/units/create', ['uses' => 'UnitsController@store']);
    Route::get('/units/delete/{id}', ['as' => 'units.delete', 'uses' => 'UnitsController@destroy']);
    Route::get('/units/{id}/edit', ['as' => 'units.edit', 'uses' => 'UnitsController@edit']);
    Route::post('/units/{id}/edit', ['uses' => 'UnitsController@update']);
    Route::get('/units/{id}', ['as' => 'units.show', 'uses' => 'UnitsController@show']);

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/users', ['as' => 'users', 'uses' => 'UsersController@index']);
    Route::get('/users/create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
    Route::post('/users/create', ['uses' => 'UsersController@store']);
    Route::get('/users/delete/{id}', ['as' => 'users.delete', 'uses' => 'UsersController@destroy']);
    Route::get('/users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::post('/users/{id}/edit', ['uses' => 'UsersController@update']);
    Route::get('/users/{id}', ['as' => 'users.show', 'uses' => 'UsersController@show']);

    /*
    |--------------------------------------------------------------------------
    | Fee Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/fees', ['as' => 'fees', 'uses' => 'FeesController@index']);
    Route::get('/fees/create', ['as' => 'fees.create', 'uses' => 'FeesController@create']);
    Route::post('/fees/create', ['uses' => 'FeesController@store']);
    Route::get('/fees/delete/{id}', ['as' => 'fees.delete', 'uses' => 'FeesController@destroy']);
    Route::get('/fees/{id}/edit', ['as' => 'fees.edit', 'uses' => 'FeesController@edit']);
    Route::post('/fees/{id}/edit', ['uses' => 'FeesController@update']);
    Route::get('/fees/{id}', ['as' => 'fees.show', 'uses' => 'FeesController@show']);

    /*
    |--------------------------------------------------------------------------
    | Rate Table Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/rates', ['as' => 'rates', 'uses' => 'RatesController@index']);
    Route::get('/rates/create', ['as' => 'rates.create', 'uses' => 'RatesController@create']);
    Route::post('/rates/create', ['uses' => 'RatesController@store']);
    Route::get('/rates/delete/{id}', ['as' => 'rates.delete', 'uses' => 'RatesController@destroy']);
    Route::get('/rates/{id}/edit', ['as' => 'rates.edit', 'uses' => 'RatesController@edit']);
    Route::post('/rates/{id}/edit', ['uses' => 'RatesController@update']);
    Route::get('/rates/{id}', ['as' => 'rates.show', 'uses' => 'RatesController@show']);

    /*
    |--------------------------------------------------------------------------
    | Traveler Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/travelers', ['as' => 'travelers', 'uses' => 'TravelerController@index']);
    Route::get('/travelers/create', ['as' => 'travelers.create', 'uses' => 'TravelerController@create']);
    Route::post('/travelers/create', ['uses' => 'TravelerController@store']);
    Route::get('/travelers/{id}/edit', ['as' => 'travelers.edit', 'uses' => 'TravelerController@edit']);
    Route::post('/travelers/{id}/edit', ['uses' => 'TravelerController@update']);
    Route::get('/travelers/{id}', ['as' => 'travelers.show', 'uses' => 'TravelerController@show']);

    /*
    |--------------------------------------------------------------------------
    | Utility Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/plan-upgrade', [
        'as' => 'plan.upgrade',
        function(Request $request)
        {
            //make sure the user can actually do this.
            \Auth::user()->company->subscription('Nest VRM')->swap($request->plan);
        }
    ]);

    Route::post('/photo-update', ['as' => 'photos.update', 'uses' => 'PhotosController@update']);
    Route::post('/photo-delete', ['as' => 'photos.delete', 'uses' => 'PhotosController@delete']);
});
