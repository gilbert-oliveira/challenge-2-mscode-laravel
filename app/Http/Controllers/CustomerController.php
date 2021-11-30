<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function getCustomers()
    {
        $customers = Customer::all();
        return view('dashboard.customers', compact('customers'));
    }

    public function postCustomers(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->fill($request->all('name', 'email', 'document'));

        if (Customer::where('email', request('email'))->first())
            return redirect()->back()->withInput()->with('error', 'Email já cadastrado!');

        if (Customer::where('document', request('document'))->first())
            return redirect()->back()->withInput()->with('error', 'CPF/CNPJ já cadastrado!');

        $customer->save();
        return redirect(route('dashboard.customers'))->with('success', 'Cliente cadastrado com sucesso');
    }

    public function putCustomers(CustomerRequest $request)
    {
        if (Customer::all()->where('email', request('email'))->where('id', '!=', request('id'))->first())
            return redirect()->back()->withInput()->with('error', 'Email já cadastrado!');

        if (Customer::all()->where('document', request('document'))->where('id', '!=', request('id'))->first())
            return redirect()->back()->withInput()->with('error', 'CPF/CNPJ já cadastrado!');

        $customer = Customer::find(request('id'));
        $customer->fill($request->all('name', 'email', 'document'));
        $customer->save();

        return redirect(route('dashboard.customers'))->with('success', 'Cliente atualizado com sucesso');

    }
}
