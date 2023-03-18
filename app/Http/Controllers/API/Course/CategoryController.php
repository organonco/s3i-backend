<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Resources\Model\Category\CategoryResource;
use App\Models\Category;

/**
 * @group Category
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
