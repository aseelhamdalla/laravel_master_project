<?php

namespace App\Http\Controllers;

use App\service;
use App\User;
use App\Category;
use App\booking;
use App\payment;
use App\user_info;

use App\review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all()->take(6);
        $services = service::all()->take(3);




        return view('landing', compact('categories', 'services'));
    }


    public function show1($id)
    {
        $users = User::find($id)->userinformation;
        return view('provider.profile', compact('users'));
    }

    // public function avalableshow($id)
    // {
    //     $ava=User::find($id)->avalable;
    //     // return $ava->from;
    //     // dd($ava);
    //     return view('publicPages/single',compact('ava'));
    // }
    public function read()
    {
        $users = User::count();
        $providers = User::where('role', '2')->get();
        $custmer = User::where('role', '3')->get();
        $providerCount = count($providers);
        $custmerCount = count($custmer);
        $services = service::count();


        // dd($custmerCount);
        $bookings = booking::all();
        $BookingSort = $bookings->sortByDesc('id')->values();

        $payments = payment::all();
        $paymentSort = $payments->sortByDesc('id')->values();


        foreach ($paymentSort as $one) {
            $poviderNumber = $one->provider_id;
            $providerInfo = user_info::where('user_id', '=', $poviderNumber)->first();
          }

        //    dd($BookingSort);
        return view('dashboardPages/index', compact('users', 'services', 'providerCount', 'custmerCount', 'BookingSort','paymentSort','providerInfo'));
    }
}
