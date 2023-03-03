<?php

namespace App\Http\Controllers;

use App\Http\Resources\Model\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @group Category
 * @authenticated
 */
class CategoryController extends Controller
{
    /**
     * Index
     * @responseFile app/Http/Responses/Samples/Category/index.json
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }
}
