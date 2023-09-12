<?php

namespace App\Http\Requests\API\Course;

use App\Http\Requests\API\Request;
use App\Models\Category;

/**
 * @queryParam category_id optional
 */
class IndexCoursesRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function hasCategoryId(): bool
    {
        return $this->has('category_id');
    }

    public function getCategoryId(): ?string
    {
        return Category::hashToId($this->input('category_id'));
    }
}
