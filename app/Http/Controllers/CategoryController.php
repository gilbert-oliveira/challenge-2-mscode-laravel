<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return view('dashboard.tickets.categories', compact('categories'));
    }

    public function postCategories(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $categoryByName = Category::where('name', $request->name)->first();
        if ($categoryByName)
            return redirect()->back()->withInput()->with('error', 'Categoria já cadastrada!');

        $category->save();
        return redirect()->back()->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function editCategory()
    {
        $id = request('id');

        if (Category::all()->where('name', request('name'))->where('id', '!=', request('id'))->first())
            return redirect()->back()->withInput()->with('error', 'Categoria já cadastrada!');

        $category = Category::find($id);
        $category->name = request('name');
        $category->save();

        return redirect()->back()->with('success', 'Categoria editada com sucesso!');
    }

    public function deleteCategory()
    {
        $id = request('id');
        $category = Category::find($id);
        if ($category->tickets()->count())
            return redirect()->back()->with('error', 'A categoria possui tickets associados!');

        $category::destroy($id);
        return redirect()->back()->with('success', 'Categoria deletada com sucesso!');
    }
}
