<?php

namespace App\Http\Controllers;


use App\Category;

class CategoryController extends Controller
{
    public function addCategory()
    {
        Category::create([
            'name' => request('name')
        ]);
        return response(['message' => 'New category has been added'],200);
    }

    public function showAllCategories()
    {
        $categories = Category::orderBy('id','asc')->get();
        return response(['data' => $categories],200);
    }

    public function showCategoriesWithPosts()
    {
        $categories = Category::with('posts')->orderBy('id','desc')->get();
        return response(['data' => $categories],200);
    }

    public function showCategory($id)
    {
        $category = Category::find($id);
        return response(['data' => $category],200);
    }

    public function showPostsUnderMedicine()
    {
        $medicine_posts = Category::with('posts')
                ->where('name', '=', 'medicine')
                ->orderBy('id','desc')
                ->get();
        return response(['data' => $medicine_posts],200);
    }

    public function showPostsUnderFitness()
    {
        $fitness_data = Category::with('posts')
            ->where('name', '=', 'fitness')
            ->orderBy('id','desc')
            ->get();
        return response(['data' => $fitness_data],200);
    }

    public function showPostsUnderDiseases()
    {
        $diseases_posts = Category::with('posts')
            ->where('name', '=', 'diseases')
            ->orderBy('id','desc')
            ->get();
        return response(['data' => $diseases_posts],200);
    }

    public function updateCategory($id)
    {
        $category = Category::find($id);
        $category->name = request('name');
        $category->save();
        return response(['message' => 'Category has been updated'],200);
    }

    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response(['message' => 'Category has been deleted!'],200);
    }
}
