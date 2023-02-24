<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends BaseModel
{
    public $fillable = ['name'];
}
