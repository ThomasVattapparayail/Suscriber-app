<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|unique:subscriptions',
        ]);

         Subscription::create($request->only('email'));

         return response()->json(['success' => true]);
    }


}
