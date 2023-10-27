<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function login(Request $request)
    {
        request()->validate([
            'userEmail' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->input('userEmail');
        $password = $request->input('password');

        $user = Customer::where('userEmail', '=', $email)->first();
        if ($user) {
                // Verify the password
            if (password_verify($password, $user->password)) {
                // Password is correct
                session(['userEmail' => $email]);
                session(['userName' => $user->firstName]);
                return redirect('/customer/dashboard');
            } else {
                // Password is incorrect
                return back()->with('success', 'Invalide Credentials password');
            }
        } else {
            // Email is not found
            return back()->with('success', 'Invalide Credentials email');
        }
    }

    public function dashboard()
    {
        $classBInstance = new ProductController();
        $cartCount = $classBInstance->cartCount();

        $orders = OrderDetail::where('userEmail', '=', session('userEmail'))
                                ->orderBy('created_at', 'desc')
                                ->get();
        return view('customer.customerDashboard', [
            'orders' => $orders,
            'countCart' => $cartCount
        ]);
    }

    public function customerLogout()
    {
        session()->forget('cart');
        session()->flush();
        return redirect('/')->with('successLogout', 'Successfully Logout!');
    }

    public function profile()
    {
        $classBInstance = new ProductController();
        $cartCount = $classBInstance->cartCount();

        $user = Customer::where('userEmail', '=', session('userEmail'))->first();
        $orders = OrderDetail::where('userEmail', '=', session('userEmail'))->first();
        return view('customer.profile', [
            'user' => $user,
            'orders' => $orders,
            'countCart' => $cartCount
        ]);
    }

    public function profileUpdate()
    {
        $attributes = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'userEmail' => 'required',
            'password' => 'required',
            'phoneNo' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required'
        ]);

        $user = Customer::where('userEmail', '=', session('userEmail'))->first();
        
        $newPassword = bcrypt($attributes['password']);     // password change into hash
        $attributes['password'] = $newPassword;
        $user->update($attributes);

        if ($user->update($attributes)) {
            return back()->with('success', 'Profile has bee updated!');
        } else {
            $errors = $user->getErrors();
            return back()->with('success', $errors);
        }
    }
}
