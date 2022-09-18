<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class HomeController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * index
     * Show the dashboard once a user is logged in
     *
     * @return void
     */
    public function index()
    {
        return view('auth.account');
    }
    
    /**
     * showChangePasswordGet
     * Show the page to change the users Password
     *
     * @return void
     */
    public function showChangePasswordGet() {
        return view('auth.password');
    }    
    
    /**
     * showChangeDetailsGet
     * Show the page to change users details
     *
     * @return void
     */
    public function showChangeDetailsGet() {
        $user = Auth::user();

        return view('auth.details', compact('user'))->with('user',$user);
    }
    
    /**
     * changeDetailsPost
     * Update Details in Database
     *
     * @param  mixed $request
     * @return void
     */
    public function changeDetailsPost(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required'
        ]);

        //Change First Name, Surname and E-Mail Address
        $user = Auth::user();
        $user->firstname = $request->get('firstname');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->save();

        return redirect('/account')->with("success","Details successfully changed!");
    }
    
    /**
     * changePasswordPost
     * Update Password in Database
     *
     * @param  mixed $request
     * @return void
     */
    public function changePasswordPost(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/account')->with("success","Password successfully changed!");
    }
}
