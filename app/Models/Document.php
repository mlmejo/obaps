<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_filename',
        'path',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
