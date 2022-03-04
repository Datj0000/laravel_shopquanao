<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class MailController extends Controller
{
    public function check_admin(Request $request)
    {
        $data = $request->all();
        $admin = Admin::where('admin_email', $data['admin_email'])->first();
        if ($admin) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function send_token_admin(Request $request)
    {
        $data = $request->all();
        $title_mail = "Lấy lại mật khẩu Shop bán hàng";
        $admin = Admin::where('admin_email', $data['admin_email'])->first();
        $token_random = Str::random();
        $admin->admin_token = $token_random;
        $admin->save();

        $data = array("name" => $title_mail, "body" => $token_random, 'email' => $data['admin_email']); //body of mail.blade.php

        Mail::send('mail.emailforgotpass', ['data' => $data], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail); //send this mail with subject
            $message->from($data['email'], $title_mail); //send from this mail
        });
    }
    public function check_user(Request $request)
    {
        $data = $request->all();
        $customer = Customer::where('customer_email', $data['customer_email'])->first();
        if ($customer) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function send_token_user(Request $request)
    {
        $data = $request->all();
        $title_mail = "Lấy lại mật khẩu Shop bán hàng";
        $customer = Customer::where('customer_email', $data['customer_email'])->first();
        $token_random = Str::random();
        $customer->customer_token = $token_random;
        $customer->save();
        Session::put('customer_email', $data['customer_email']);
        Session::save();
        $data = array("name" => $title_mail, "body" => $token_random, 'email' => $data['customer_email']);

        Mail::send('mail.emailforgotpass', ['data' => $data], function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
    }
}
