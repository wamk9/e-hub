<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function showCategories()
    {
        if (!Auth::check())
            return response()->json(['message' => 'Unauthorized', 'status' => false], 401);

        // Need initialize because array_push function
        $categories = [];

        foreach (Category::all() as $category)
        {
            $category['subcategory'] = $category->subcategory;
            array_push($categories, $category);
        }

        return response()->json(['message' => $categories, 'status' => true], 200);
    }
}
