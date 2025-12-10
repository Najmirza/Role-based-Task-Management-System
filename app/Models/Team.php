<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'description', 'created_by'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }

    // Alias for members to support standard naming conventions
    public function users()
    {
        return $this->members();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
