<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    use HasFactory;

    public $fillable = ['name'];
    //TODO: Add Icon
}
