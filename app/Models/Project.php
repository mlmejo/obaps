<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function bidders()
    {
        return $this->belongsToMany(
            User::class,
            'bidder_project',
            'project_id',
            'bidder_id',
        )->withPivot('awardee')->withTimestamps();
    }
}
