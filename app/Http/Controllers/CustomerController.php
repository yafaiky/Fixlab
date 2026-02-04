<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Generate unique 8 digit memberID
    private function generateUniqueMemberID()
    {
        do {
            $memberID = strval(mt_rand(10000000, 99999999));
        } while (Customer::where('memberID', $memberID)->exists());

        return $memberID;
    }

    // Create Customer
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email|unique:customers,email',
                'address' => 'required|string',
            ]);

            $memberID = $this->generateUniqueMemberID();

            $customer = Customer::create([
                'memberID' => $memberID,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            return response()->json($customer, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => '❌ ERROR createCustomer: '.$e->getMessage()], 500);
        }
    }

    // Get Customers (order by created_at desc)
    public function index()
    {
        try {
            $customers = Customer::orderBy('created_at', 'desc')->get();
            return response()->json($customers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}