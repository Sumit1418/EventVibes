<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\CompanyDetails;

class AdminController extends Controller
{
    public function dashboard(){

        $cancelled = Booking::where('status','cancelled')->count();
        $completed = Booking::where('status','completed')->count();
        $upcoming = Booking::where('status','upcoming')->count();

        $revenue = Payment::where('status','completed')->sum('amount');
        $commission = $revenue * 0.05;
        $companies = CompanyDetails::where('status', 'approved')
                                ->orderBy('updated_at', 'desc')
                                ->take(2)
                                ->get();

        $data = [
            'cancelled' => $cancelled,
            'completed' => $completed,
            'upcoming' => $upcoming,
            'revenue' => $revenue,
            'commission' => $commission,
            'companies' => $companies
        ];

        return view('admin.dashboard', ['data' => $data]);
    }

    public function allcompanies(){

        $companies = CompanyDetails::all();

        return view('admin.approvecompany', ['companies' => $companies]);

    }

    public function changestatus(Request $request){

        $company = CompanyDetails::where('user_id', $request->input('company_id'))->first();
        $company->status = $request->input('status');
        $company->save();
        return redirect('/admin/approvecompany');
    }
}
