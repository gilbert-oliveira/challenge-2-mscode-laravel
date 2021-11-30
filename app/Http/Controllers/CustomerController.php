<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Tigo\DocumentBr\Cnpj;
use Tigo\DocumentBr\Cpf;

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
        $customer->fill($request->all('name', 'email'));
        $customer->document = preg_replace('/\D/', '', $request->document);

        if (strlen($customer->document) == 11 and !(new Cpf())->check($customer->document))
            return redirect()->back()->withInput()->with('error', 'CPF inválido');
        if (strlen($customer->document) == 14 and !(new Cnpj())->check($customer->document))
            return redirect()->back()->withInput()->with('error', 'CNPJ inválido');

        if (strlen($customer->document) < 14 and strlen($customer->document) > 11)
            return redirect()->back()->withInput()->with('error', 'Documento inválido');

        if (Customer::where('email', request('email'))->first())
            return redirect()->back()->withInput()->with('error', 'Email já cadastrado!');

        if (Customer::where('document', preg_replace('/\D/', '', $request->document))->first())
            return redirect()->back()->withInput()->with('error', 'CPF/CNPJ já cadastrado!');

        $customer->save();
        return redirect(route('dashboard.customers'))->with('success', 'Cliente cadastrado com sucesso');
    }

    public function putCustomers(CustomerRequest $request)
    {
        if (Customer::all()->where('email', request('email'))->where('id', '!=', request('id'))->first())
            return redirect()->back()->withInput()->with('error', 'Email já cadastrado!');

        if (Customer::all()->where('document', preg_replace('/\D/', '', $request->document))->where('id', '!=', request('id'))->first())
            return redirect()->back()->withInput()->with('error', 'CPF/CNPJ já cadastrado!');

        $customer = Customer::find(request('id'));
        $customer->fill($request->all('name', 'email'));
        $customer->document = preg_replace('/\D/', '', $request->document);
        $customer->save();

        return redirect(route('dashboard.customers'))->with('success', 'Cliente atualizado com sucesso');

    }
}
