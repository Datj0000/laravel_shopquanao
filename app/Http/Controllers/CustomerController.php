<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Social;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    //customer
    public function all_user()
    {
        return view('admin.account.manage_user');
    }
    public function fetchdata()
    {
        $all_user = Customer::all();
        return response()->json([
            "data" => $all_user,
        ]);
    }
    public function view_role($customer_id)
    {
        $edit_customer = customer::where('customer_id', $customer_id)->first();
        return response()->json([
            'data' => $edit_customer,
        ]);
    }
    public function update_customer(Request $request, $customer_id)
    {
        $data = $request->all();
        $customer = customer::where('customer_id', $customer_id)->first();
        $customer->customer_role = $data['customer_role'];
        $result = $customer->save();
        if ($result) {
            echo 1;
        }
    }
    public function delete_customer($customer_id)
    {
        $customer = customer::where('customer_id', $customer_id)->first();
        $customer->delete();
        echo 1;
    }
    //User
    public function AuthLogin()
    {
        $customer_id = Session::get('customer_id');
        if ($customer_id) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function show_login()
    {
        return view('user.login');
    }
    public function show_login_user()
    {
        return view('user.login.login');
    }
    public function show_signup_user()
    {
        return view('user.login.signup');
    }
    public function show_forgotpass_user()
    {
        return view('user.login.forgotpass');
    }
    public function login_customer(Request $request)
    {
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
        $result = Customer::where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            echo 1;
        } else {
            echo 0;
        }
    }
    public function signup_customer(Request $request)
    {
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = md5($data['customer_password']);
        $check = $customer::where('customer_email', $data['customer_email'])->first();
        if ($check) {
            echo 0;
        } else {
            $result = $customer->save();
            if ($result) {
                echo 1;
            }
        }
    }
    public function logout_customer()
    {
        Session::put('customer_name', null);
        Session::put('customer_id', null);
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
    public function load_profile($customer_id)
    {
        $customer = Customer::find($customer_id);
        return response()->json([
            'data' => $customer,
        ]);
    }
    public function view_reset_pass()
    {
        return view('user.login.resetpass');
    }
    public function reset_pass(Request $request)
    {
        $data = $request->all();
        $customer_email = Session::get('customer_email');
        $token_random = Str::random();
        $customer = Customer::where('customer_email', '=', $customer_email)->where('customer_token', '=', $data['customer_token'])->get();
        $count = $customer->count();
        if ($count > 0) {
            $reset = Customer::where('customer_email', '=', $customer_email)->first();
            $reset->customer_password = md5($data['customer_password']);
            $reset->customer_token = $token_random;
            $reset->save();
            echo 1;
            Session::forget('customer_email');
        } else {
            echo 0;
        }
    }
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        $users = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUser($users, 'google');
        if ($authUser) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_name', $account_name->customer_name);
        }
        return redirect('/');
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook()
    {
        $users = Socialite::driver('facebook')->user();
        $authUser = $this->findOrCreateUser($users, 'facebook');
        if ($authUser) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_name', $account_name->customer_name);
        }
        return redirect('/');
    }
    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->getId())->first();
        if ($authUser) {
            return $authUser;
        }

        $account = new Social([
            'provider_user_id' => $users->getId(),
            'provider_user_email' => $users->getEmail(),
            'provider' => strtoupper($provider)
        ]);

        $orang = Customer::where('customer_email', $users->email)->first();

        if (!$orang) {
            $orang = Customer::create([
                'customer_name' => $users->getName(),
                'customer_email' => $users->getEmail(),
                'customer_password' => '',
                'customer_phone' => ''
            ]);
        }
        $account->login()->associate($orang);
        $account->save();

        $account_name = Customer::where('customer_id', $authUser->user)->first();
        Session::put('customer_name', $account_name->customer_name);
        Session::put('customer_id', $account_name->customer_id);
    }
}
