<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['count_tasks', 'count_completed_tasks', 'count_pending_tasks'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getCountTasksAttribute()
    {
        return $this->tasks()->count();
    }

    public function getCountCompletedTasksAttribute()
    {
        return $this->tasks()->where('status', 'completed')->count();
    }

    public function getCountPendingTasksAttribute()
    {
        return $this->tasks('status', 'pending')->count();
    }

}
