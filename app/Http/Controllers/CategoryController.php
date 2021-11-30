<?php

namespace App\Http\Controllers;

use App\{Http\Requests\CategoryRequest, Models\Category};
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Http\RedirectResponse};

/**
 * Classe para manipulação de categorias
 */
class CategoryController extends Controller
{

    /**
     * Exibe a lista de categorias.
     * @return Application|Factory|View
     */
    public function getCategories()
    {
        // Recupera todas as categorias.
        $categories = Category::all();

        // Retorna a view.
        return view('dashboard.tickets.categories', compact('categories'));
    }

    /**
     * Método responsável por cadastrar uma nova categoria.
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function postCategories(CategoryRequest $request)
    {
        // Cria uma nova categoria.
        $category = new Category();
        $category->name = $request->name;

        // Verifica se existe uma categoria com o mesmo nome.
        $categoryByName = Category::where('name', $request->name)->first();
        if ($categoryByName)
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'Categoria já cadastrada!');

        // Salva a categoria.
        $category->save();

        // Retorna a mensagem de sucesso.
        return redirect()->back()->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Método responsável por editar uma categoria.
     * @return RedirectResponse
     */
    public function editCategory()
    {
        // Recupera o id da categoria.
        $id = request('id');

        // Verifica se existe uma categoria com o nome informado.
        if (Category::all()->where('name', request('name'))->where('id', '!=', request('id'))->first())
            // Retorna a mensagem de erro.
            return redirect()->back()->withInput()->with('error', 'Categoria já cadastrada!');

        // Recupera a categoria.
        $category = Category::find($id);
        // Atualiza os dados da categoria.
        $category->name = request('name');
        // Salva a categoria.
        $category->save();

        // Retorna a mensagem de sucesso.
        return redirect()->back()->with('success', 'Categoria editada com sucesso!');
    }

    /**
     * Método responsável por excluir uma categoria.
     * @return RedirectResponse
     */
    public function deleteCategory()
    {
        // Recupera o id da categoria.
        $id = request('id');

        // Verifica se existe tickets associados a categoria.
        $category = Category::find($id);
        if ($category->tickets()->count())
            // Retorna a mensagem de erro.
            return redirect()->back()->with('error', 'A categoria possui tickets associados!');

        // Exclui a categoria.
        $category::destroy($id);

        // Retorna a mensagem de sucesso.
        return redirect()->back()->with('success', 'Categoria deletada com sucesso!');
    }
}
