<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Index()
    {
        return view('admin.pendingorders');
    }

    public function Cancel()
    {
        return view('admin.canceledorders');
    }
}
