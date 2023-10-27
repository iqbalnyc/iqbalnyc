<?php

namespace App\Http\Controllers;

use App\Models\Authority;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\OrderMaster;
use App\Models\Product;
use App\Models\User;
use App\Models\userAuthority;
use Exception;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{
    private $orders_count;
    private $products_count;
    private $categories;

    public function __construct()
    {
        $this->orders_count = OrderMaster::count();
        $this->products_count = Product::count();
        $this->categories = Category::all();
    }

    protected function getUserAuthorities()
    {
        return userAuthority::where('email', session('adminUserEmail'))->orderBy('position', 'asc')->get();
    }

    public function index()
    {
        return view('dashboard.user-page', [
            'products_count' => $this->products_count,
            'orders_count' => $this->orders_count,
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function login()
    {
        return view('dashboard.adminlogin');
    }

    public function adminlogin(Request $request)
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->input('email');

        if (!auth()->attempt($attributes)) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Credentials are invalid.']);
        }

        $user = User::where('email', $email)
                        ->where('user_status', 'Active')->first();
        if(!$user)
        {
            return redirect('/admin/login')->with('success', 'User not found');
        }
        session(['adminUserEmail' => $email]);   // Password is correct
        session(['adminUserName' => $user->name]);
        session()->regenerate();  // session fixation
        return redirect('/dashboard');
    }

    public function adminLogout()
    {
        session()->forget('cart');
        session()->flush();
        return redirect('/admin/login')->with('success', 'Successfully Logout!');
    }

    public function userregister()
    {
        $user = User::where('email', '=', session('adminUserEmail'))->first();
        return view('dashboard.userregister', [
            'user' => $user,
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function users()
    {
        $users = User::latest();
        return view('dashboard.users', [
            'users' => $users->simplePaginate(8)->withQueryString(),
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function userUpdate($id)
    {
        $user_status = request()->input('user_status');

        $user = User::where('email', $id)->first();
        if ($user) {
            $user->user_status = $user_status; // Replace 'new_status' with the new value
            $user->save();
            return back()->with('success', 'User has been updated');
        } else {
            return back()->with('success', 'Some errors have been occurs');
        }
    }

    public function registeration()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'user_type' => 'required'
        ]);
        
        try {
            $newPassword = bcrypt($attributes['password']);     // password change into hash
            $attributes['password'] = $newPassword;
            User::create($attributes);
            return back()->with('success', 'New user has been created!');
        } catch (Exception $e) {
            return back()->with('success', 'Error: some error has been occurs');
        }
        
    }


    public function authorities()
    {
        $userAuthorities = userAuthority::where('email', request('search'))
            ->orderBy('authority_name', 'asc')
            ->get();
        $email = request('search');
        if (session('userAuthority')) {
            $userAuthorities = userAuthority::where('email', session('userAuthority'))
            ->orderBy('authority_name', 'asc')
            ->get();
        }
      
        $allAuthorities = Authority::all();
        return view('dashboard.authorities', [
            'authorities' => $this->getUserAuthorities(),
            'allAuthorities' => $allAuthorities,
            'userAuthorities' => $userAuthorities
        ])->with('userAuthority', $email);
    }

    public function authoritiesUpdate(Request $request)
    {
        $attributes = request()->validate([
            'email' => 'required|exists:users,email'
        ]);

        $attributes = $request->all();
        $email = $attributes['email'];

        unset($attributes['_token']);
        unset($attributes['email']);

        if (is_array($attributes)) {
            foreach ($attributes as $key => $item) 
            {
                $position = Authority::select('position')
                        ->where('authority_name', $key)
                        ->first();
                if ($position) {
                    $positionValue = $position->position;
                }
                userAuthority::create([
                    'email' => $email,
                    'authority_name' => $key,
                    'authority_route' => $item,
                    'position' => $positionValue,
                    'user' => session('adminUserEmail')
                ]);
            }
        }
        return redirect('/admin/authorities')->with('success', 'Authorities has been inserted')->with('userAuthority', $email);
    }
    
    public function authorityDelete(Request $request)
    {
        $authority = userAuthority::where('email', $request->email)
            ->where('id', $request->id);

        $authority->delete();
        return back()->with('success', 'Authority has been Deleted');
    }
    
    public function products()
    {
        $products = Product::latest();
        return view('dashboard.products', [
            'products_count' => $this->products_count,
            'orders_count' => $this->orders_count,
            'products' => $products->simplePaginate(4)->withQueryString(),
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function productsEdit($id)
    {
        $product = Product::find($id);
        return view('dashboard.productDetail', [
            'products_count' => $this->products_count,
            'orders_count' => $this->orders_count,
            'product' => $product,
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function productsUpdate(Request $request, $id)
    {
        $attributes = request()->validate([
            'productImage' => 'image',
            'productName' => 'required',
            'productManu' =>  'required',
            'productPartNo' =>  'required',
            'productStatus' =>  'required',
            'productPrice' =>  'required'
        ]);

        if (isset($attributes['productImage'])) {
            request()->file('productImage')->store('public/thumbnails');
            $attributes['productImage'] = request()->file('productImage')->store('');
        }
        $product = Product::find($id);
        $product->update($attributes);

        if ($product->update($attributes)) {
            return back()->with('successProduct', 'Product updated!');
        } else {
            $errors = $product->getErrors();
            return back()->with('successError', $errors);
        }
    }
    
    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product has been Deleted');
    }

    // Orders
    public function orderDetail($id)
    {
        $order_detail = OrderDetail::where('orderId', '=', $id)->get();
        return view('dashboard.orderDetail', [
            'products_count' => $this->products_count,
            'orders_count' => $this->orders_count,
            'order_detail' => $order_detail,
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function orderUpdate(Request $request, $id)
    {
        $order = OrderDetail::findOrFail($id);
        $orderStatus = $request->input('orderStatus');
        $order->update(['orderStatus' => $orderStatus]);

        return back()->with('orderUpdated', 'Order updated!');
    }

    public function orders()
    {
        $orders = OrderMaster::all();

        return view('dashboard.orders', [
            'products_count' => $this->products_count,
            'orders_count' => $this->orders_count,
            'orders' => $orders,
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function profile()
    {
        $user = User::where('email', '=', session('adminUserEmail'))->first();
        return view('dashboard.profile', [
            'user' => $user,
            'authorities' => $this->getUserAuthorities()
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $attributes = request()->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        $newPassword = bcrypt($attributes['password']);     // password change into hash
        $confirm = $user->update([
            'password' => $newPassword
        ]);

        if ($confirm) {
            return back()->with('success', 'Password has bee updated!');
        } else {
            $errors = $user->getErrors();
            return back()->with('success', $errors);
        }
    }

}
