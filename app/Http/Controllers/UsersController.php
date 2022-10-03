<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserAddedWelcome;
use App\Mail\UserUpdatedNewPassword;
use App\User;
use App\Role;
use App\Permission;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::mine()->filter($request->all())->get();

        return view('users.index')
            ->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name'    => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
        ]);

        if($request->has('password') && $request->password != '')
        {
            $messages = [
                'password.regex' => "Passwords must contain 3 of the following 5 categories:<ul><li>English uppercase characters (A – Z)</li><li>English lowercase characters (a – z)</li><li>Base 10 digits (0 – 9)</li><li>Non-alphanumeric (For example: !, $, #, or %)</li><li>Unicode characters</li></ul>"
            ];
            $request->validate([
                'password'    => 'min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'
            ], $messages);
            $temp_password = $request->password;
        }
        else
        {
            $temp_password = str_random(15);
        }

        $request->merge([
            'company_id' => \Auth::user()->company_id,
            'password' => Hash::make($temp_password),
        ]);

        if($user = User::create($request->toArray()))
        {
            //send the email
            Mail::to($user->email)
                ->send(new NewUserAddedWelcome(\Auth::user()->company, $user, $temp_password));

            $message = serialize(['title' => 'User Created', 'body' => $user->name . ' has been created and the password has been sent to them.  Tell them to check their email!']);
        }
        else
        {
            $message = serialize(['title' => 'Something Went Wrong', 'body' => 'Something went wrong and the user wasn\'t created.  Please try again later.']);
        }

        \Session::flash('toast', $message);

        //need to attach some permissions

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::mine()->where('id', $id)->with('roles')->firstOrFail();

        return view('users.show')
            ->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::mine()->where('id', $id)->with('roles')->firstOrFail();
        // dd($user);

        return view('users.edit')
            ->withUser($user);
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
            'name'    => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
        ]);

        $user = User::mine()->where('id', $id)->firstOrFail();

        $user->name = $request->name;
        if($request->has('password') && $request->password != '')
        {
            $messages = [
                'password.regex' => "Passwords must contain 3 of the following 5 categories:<ul><li>English uppercase characters (A – Z)</li><li>English lowercase characters (a – z)</li><li>Base 10 digits (0 – 9)</li><li>Non-alphanumeric (For example: !, $, #, or %)</li><li>Unicode characters</li></ul>"
            ];
            $request->validate([
                'password'    => 'min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'
            ], $messages);
            $temp_password = $request->password;
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->phone2 = $request->phone2;

        if($user->save())
        {
            $body = $user->name . ' has been updated.';
            if(@$temp_password != '')
            {
                $body = $body .'  Their password has been sent to their email address.';
                //send the email
                Mail::to($user->email)
                ->send(new UserUpdatedNewPassword(\Auth::user()->company, $user, $temp_password));
            }
            $message = serialize(['title' => 'User Updated', 'body' => $body]);

            $user->syncPermissions($request->permissions);
        }
        else
        {
            $message = serialize(['title' => 'Something Went Wrong', 'body' => 'Something went wrong and the user wasn\'t updated.  Please try again later.']);
        }

        \Session::flash('toast', $message);

        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->canDeleteUsers())
        {
            if(\Auth::user()->id != $id)
            {
                $user = User::mine()->where('id', $id)->firstOrFail();

                $message = serialize(['title' => 'User Deleted', 'body' => $user->name . ' has been deleted.']);

                if($user->delete())
                {
                    \Session::flash('toast', $message);
                }
                else
                {
                    $message = serialize(['title' => 'Something Went Wrong', 'body' => 'Something went wrong and the user wasn\'t deleted.  Please try again later.']);
                    \Session::flash('toast', $message);
                }
            }
            else
            {
                $message = serialize(['title' => 'Oops!', 'body' => 'You can\'t delete your own account!']);
                \Session::flash('toast', $message);
            }
        }
        else
        {
            $message = serialize(['title' => 'Oops!', 'body' => 'Looks like you don\'t have permission to delete this user!']);
            \Session::flash('toast', $message);
        }

        return redirect()->route('users');
    }
}
