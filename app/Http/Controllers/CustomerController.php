<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Tigo\{DocumentBr\Cnpj, DocumentBr\Cpf};
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Http\RedirectResponse};

/**
 * Classe para manipulação de clientes
 */
class CustomerController extends Controller
{

    /**
     * Método para listar todos os clientes.
     * @return Application|Factory|View
     */
    public function getCustomers()
    {
        // Busca todos os clientes.
        $customers = Customer::all();

        // Retorna a view.
        return view('dashboard.customers', compact('customers'));
    }

    /**
     * Método para criar um novo cliente.
     * @param CustomerRequest $request
     * @return RedirectResponse
     */
    public function postCustomers(CustomerRequest $request)
    {
        // Cria um novo cliente.
        $customer = new Customer();
        $customer->fill($request->all('name', 'email'));
        $customer->document = preg_replace('/\D/', '', $request->document);

        // Verifica se o documento é CPF ou CNPJ.
        if (strlen($customer->document) == 11 and !(new Cpf())->check($customer->document)) // Vefica se o documento é CPF e válido.
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'CPF inválido');

        if (strlen($customer->document) == 14 and !(new Cnpj())->check($customer->document)) // Vefica se o documento é CNPJ e válido.
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'CNPJ inválido');

        if (strlen($customer->document) < 14 and strlen($customer->document) > 11) // Verifica se o documento é CPF ou CNPJ.
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'Documento inválido');

        if (Customer::where('email', request('email'))->first()) // Verifica se o email já existe.
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'Email já cadastrado!');

        if (Customer::where('document', preg_replace('/\D/', '', $request->document))->first()) // Verifica se o documento já existe.
            return redirect()->back()->withInput()->with('error', 'CPF/CNPJ já cadastrado!');

        // Salva o cliente.
        $customer->save();

        // Retorna a mensagem de sucesso.
        return redirect(route('dashboard.customers'))->with('success', 'Cliente cadastrado com sucesso');
    }

    /**
     * Método para editar um cliente.
     * @param CustomerRequest $request
     * @return RedirectResponse
     */
    public function putCustomers(CustomerRequest $request)
    {

        // Verifica se o email já existe.
        if (Customer::all()->where('email', request('email'))->where('id', '!=', request('id'))->first())
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'Email já cadastrado!');

        // Verifica se o documento já existe.
        if (Customer::all()->where('document', preg_replace('/\D/', '', $request->document))->where('id', '!=', request('id'))->first())
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'CPF/CNPJ já cadastrado!');

        // Busca o cliente.
        $customer = Customer::find(request('id'));

        // Atualiza os dados do cliente.
        $customer->fill($request->all('name', 'email'));
        $customer->document = preg_replace('/\D/', '', $request->document);

        // Salva o cliente.
        $customer->save();

        // Retorna a mensagem de sucesso.
        return redirect(route('dashboard.customers'))->with('success', 'Cliente atualizado com sucesso');
    }
}
