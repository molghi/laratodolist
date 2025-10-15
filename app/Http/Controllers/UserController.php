<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
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

    // ========================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // ========================================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Etc/GMT-4');

        // get data, validate
        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $data['name'] = strtolower(explode('@', $data['email'])[0]);

        // hash pw
        $data['password'] = bcrypt($data['password']);

        // create user
        $user = User::create($data);

        // store user ID in session for later access
        Auth::login($user); 

        // get only mailbox name for greeting msg
        $mailbox_name = $data['name'];

        return redirect('/user')->with('success', "Welcome $mailbox_name!");
    }

    // ========================================================================

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

    // ========================================================================

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

    // ========================================================================

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

    // ========================================================================

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

    // ========================================================================

    // Show forms to log in or sign up
    public function show_auth_forms () {
        $data = [
            'title' => 'Auth'
        ];
        return view('auth', $data);
    }

    // ========================================================================

    public function show_dashboard () {
        $data = [
            'title' => 'Profile',
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'created_at' => Auth::user()->created_at,
        ];
        return view('dashboard', $data);
    }

    // ========================================================================

    public function logout () {
        // clear this user session variable & redirect

        Auth::logout();  // clears the authenticated user

        request()->session()->invalidate();    // clears session data

        request()->session()->regenerateToken(); // prevents CSRF issues

        return redirect('/auth');     // redirect after logout
    }

    // ========================================================================

    public function login (Request $request) {
        // get form data, validate, query db to see if user exists and pw matches, then store found user in sesh var and redirect
        
        // Validate form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect()->intended('/user'); // redirect logged-in user to the URL they originally tried to access before being intercepted by auth middleware -- If there is no intended URL stored in the session, it defaults to /user.
        }

        // Failed login
        return back()->withErrors([
            'email-login' => 'The provided credentials do not match our records.',
        ]);
    }
}