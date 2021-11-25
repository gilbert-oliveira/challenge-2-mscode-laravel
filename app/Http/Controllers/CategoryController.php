<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return view('dashboard.tickets.categories', compact('categories'));
    }

    public function postCategories()
    {
        $category = new Category();
        $category->fill(request()->all());

        $this->validate(request(), $category->rule);
        $category->save();
        return redirect(route('dashboard.tickets.categories'))->with('success', "Categoria {$category->name} cadastrada com sucesso");
    }
}
