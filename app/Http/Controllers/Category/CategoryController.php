<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show()
    {
        // Need initialize because we need push info to array
        $categories = [];

        foreach (Category::all() as $category)
        {
            $category['subcategories'] = $category->subcategories;
            $categories[] = $category;
        }

        return response()->json(['message' => $categories], 200);
    }
}
