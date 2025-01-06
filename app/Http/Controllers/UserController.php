<?php

namespace App\Http\Controllers;
use App\Models\CompanyDetails;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;


class UserController extends Controller
{

    public function showUserDetails()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $userDetails = $user->detail;

            if ($user) {
                return view('users.userdetails', ['user' => $user, 'userDetails' => $userDetails]);
            } else {
                // Handle case when user details are not found
                return redirect('/login')->with('error', 'User details not found.');
            }
        } else {
            return redirect('/login')->with('error', 'User is not authenticated.');
        }
    }

    public function updateUserDetails(Request $request)
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $userDetails = $user->detail;


            if ($userDetails) {
                
                if ($request->hasFile('profile_picture')) {

                    $userID = $user->id;
    
                    $profilePicture = $request->file('profile_picture');
                
                    $fileName = 'profile_picture_' . $userID . '.' . $profilePicture->getClientOriginalExtension();
                
                    $profilePath = $profilePicture->storeAs('profile_pictures', $fileName, 'public');
                
                    $userDetails->profile_path = $profilePath;
                }else{
                    $userDetails->profile_path = null;  
                }

                $userDetails->phone = $request->input('phone');
                $userDetails->address = $request->input('address');
                $userDetails->city = $request->input('city');
                $userDetails->state  = $request->input('state');
                $userDetails->pincode = $request->input('pincode');
                $userDetails->save();
                return redirect('/user/userdetails')->with('success', 'User details updated successfully.');
            } else {
                return redirect('/login')->with('error', 'User details not found.');
            }
        } else {
            return redirect('/login')->with('error', 'User is not authenticated.');
        }
    }

    public function viewdetails (Request $request){
        $userID = $request->input('company_id');
        $user = User::find($userID);
        $companyDetails = $user->companydetail;
        $companyBookings = Booking::where('company_id','=',$userID)->get()->sortByDesc("created_at");
        return view('users.viewdetails', ['user' => $user, 'companyDetails' => $companyDetails, 'companyBookings' => $companyBookings]);
    }

    public function showbookings(){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']->id;
            $userBookings = Booking::where('client_id','=',$userId)->get()->sortByDesc("created_at");

            foreach ($userBookings as &$booking) {
                $companyId = $booking->company_id;
                $booking->companyname = CompanyDetails::where('user_id','=',$companyId)->value('company_name');
                $booking->type = CompanyDetails::where('user_id','=',$companyId)->value('type');
            }

            // dd($userBookings);
            return view('users.bookings', ['userBookings' => $userBookings]);
        } else {
            return redirect('/login')->with('error', 'You are not logged in! Please login to access your account.');
        }
    }

    public function showtransactions(){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']->id;
            $userPayments = Payment::where('client_id','=',$userId)->get()->sortByDesc("created_at");

            foreach ($userPayments as &$payment) {
                $companyId = $payment->company_id;
                $payment->companyname = CompanyDetails::where('user_id','=',$companyId)->value('company_name');
            }

            // dd($userPayments);
            return view('users.payments', ['userPayments' => $userPayments]);
        } else {
            return redirect('/login')->with('error', 'You are not logged in! Please login to access your account.');
        }
    }
}
