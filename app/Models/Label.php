<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'tasks_m2m_labels');
    }
}
