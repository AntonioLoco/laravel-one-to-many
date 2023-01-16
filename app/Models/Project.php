<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "description", "link", "slug", "image_cover", "type_id"
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
