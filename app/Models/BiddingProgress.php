<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiddingProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'period'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
