<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;


class CompanyController extends Controller
{
    public function dashboard(){
        if(isset($_SESSION['user'])){

            $userId = $_SESSION['user']->id;
            $totalAmount = Payment::where('company_id','=',$userId)->sum('amount');

            $userBookings = Booking::where('company_id','=',$userId)->get();
            $upcomingBookings = $userBookings->where('status','=','upcoming')->count();
            $completedBookings = $userBookings->where('status','=','completed')->count();
            $cancelledBookings = $userBookings->where('status','=','cancelled')->count();
            $data = array(
                'totalAmount' => $totalAmount,
                'upcomingBookings' => $upcomingBookings,
                'completedBookings' => $completedBookings,
                'cancelledBookings' => $cancelledBookings
            );

            // dd($data);
            return view('company.dashboard', ['data' => $data]);

        } else {
            return redirect('/login')->with('error', 'You are not logged in! Please login to access your account.');
        }
    }
    public function showCompanyDetails(){

        if (isset($_SESSION['user'])) {
            $company = $_SESSION['user'];
            $companyDetails = $company->companydetail;

            if($company){
                return view('company.companydetails', ['company' => $company, 'companyDetails' => $companyDetails]);
            }else{
                return redirect('/login')->with('error', 'User details not found.');
            }
        }else{
            return redirect('/login')->with('error', 'User is not authenticated.');
        }
    }

    public function updateCompanyDetails(Request $request){
        if (isset($_SESSION['user'])) {
            $company = $_SESSION['user'];
            $companyDetails = $company->companydetail;

            if($companyDetails){
                if ($request->hasFile('logo_picture')) {

                    $companyID = $company->id;

                    $logoPicture = $request->file('logo_picture');

                    $fileName = 'logo_picture_' . $companyID . '.' . $logoPicture->getClientOriginalExtension();

                    $logoPath = $logoPicture->storeAs('logo_pictures', $fileName, 'public');

                    $companyDetails->logo_path = $logoPath;
                }
                else{
                    $companyDetails->logo_path = "default_picture/default_picture.jpg";
                }
                $companyDetails->owner_name = $request->input('owner_name');
                $companyDetails->phone = $request->input('phone');
                $companyDetails->company_name = $request->input('company_name');
                $companyDetails->address = $request->input('address');
                $companyDetails->state = $request->input('state');
                $companyDetails->type = $request->input('type');
                $companyDetails->budget = $request->input('budget');
                $companyDetails->serviceable_states = $request->input('serviceable_state');
                $companyDetails->serviceable_pincodes = $request->input('serviceable_pincode');

                $companyDetails->save();

                return redirect('/company/companydetails')->with('success', 'Company details updated successfully.');
            }else{
                return redirect('/login')->with('error', 'User details not found.');
            }
        }else{
            return redirect('/login')->with('error', 'User is not authenticated.');
        }
    }
    public function showbookings(){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']->id;
            $userBookings = Booking::where('company_id','=',$userId)->get()->sortByDesc("created_at");
            // dd($userBookings);
            foreach ($userBookings as &$booking) {
                $clientId = $booking->client_id;
                $booking->clientname = User::where('id','=',$clientId)->value('name');

                $booking->phone = UserDetails::where('user_id','=',$clientId)->value('phone');
                $booking->address = UserDetails::where('user_id','=',$clientId)->value('address');
            }


            return view('company.bookings', ['userBookings' => $userBookings]);
        } else {
            return redirect('/login')->with('error', 'You are not logged in! Please login to access your account.');
        }
    }

    public function showtransactions(){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']->id;
            $userPayments = Payment::where('company_id','=',$userId)->get()->sortByDesc("created_at");

            foreach ($userPayments as &$payment) {
                $companyId = $payment->client_id;
                $payment->name = User::where('id','=',$companyId)->value('name');
            }

            return view('company.payments', ['userPayments' => $userPayments]);
        } else {
            return redirect('/login')->with('error', 'You are not logged in! Please login to access your account.');
        }
    }

}
