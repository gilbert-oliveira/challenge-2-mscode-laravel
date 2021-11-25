<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function getCustomers()
    {
        $customers = Customer::all();
        return view('dashboard.customers', compact('customers'));
    }

    public function postCustomers()
    {
        $customer = new Customer();
        $customer->fill(request()->all());
        $customer->save();
        return redirect(route('dashboard.customers'))->with('success', 'Cliente cadastrado com sucesso');
    }
}
