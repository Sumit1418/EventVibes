<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\CompanyDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'userType' => 'required',
            'fullName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // If validation passes, proceed to register the user
        $user = new User();
        $user->user_type = $request->input('userType');
        $user->name = $request->input('fullName');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if($request->input('userType')== 'user'){
            $userDetails = new UserDetails();
            $userDetails->user_id = $user->id;
            $userDetails->profile_path = 'default_picture/default_picture.jpg';
            $userDetails->save();
        }
        else{
            $companyDetails = new CompanyDetails();
            $companyDetails->user_id = $user->id;
            $companyDetails->logo_path = 'default_picture/default_picture.jpg';
            $companyDetails->save();
        }
    
        // Flash success message
        Session::flash('success', 'Successfully registered. Please login to continue.');
    
        // Redirect to the login page
        return redirect('/login');
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (User::where('email', $email)->exists()) {
            $user = User::where('email', $email)->first();
            if (Hash::check($password, $user->password)) {
                // if Successfully logged in
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['isauthenticated'] = true;
                $_SESSION['user_type'] = $user->user_type;
                $_SESSION['user'] = $user;

                $userDetails = $user->detail;
                $companyDetails = $user->companydetail;


                if($user->user_type == 'admin'){
                    //redirect with user details
                    return redirect('/admin/dashboard') ;
                }else if($user->user_type == 'company'){
                    $_SESSION['companyDetails'] = $companyDetails;
                    return redirect('/company/dashboard');
                }else {
                    $_SESSION['userDetails'] = $userDetails;
                    $companyDetails = CompanyDetails::where('status', 'approved')->get()->toArray();
                    $_SESSION["allcompany"] = $companyDetails;
                    // dd($_SESSION["allcompany"]);                    

                    return redirect('/user/home');
                }
            } else {
                return redirect('/login')->with('error', 'Invalid password');
            }
        } else {
            return redirect('/login')->with('error', 'User not registered');
        }
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        return redirect('/login');
    }



}
