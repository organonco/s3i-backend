<?php

namespace App\Models\BaseModels;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes, HashableId, CascadeSoftDeletes;
    protected $cascadeDeletes = [];
}
