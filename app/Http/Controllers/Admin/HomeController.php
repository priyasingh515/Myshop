<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index(){
        // $admin =Auth::guard('admin')->user();
        // echo'welcome ' .$admin->name.' <a href=~"'.route('admin.logout').'">Logout</a>';
        return view('Admin.dashboard');
     }

     public function logout(){
        $admin =Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }
}
