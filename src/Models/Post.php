<?php

namespace zendzo\Press\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function extra($field)
    {
        return optional(json_decode($this->extra))->$field;
    }
}
