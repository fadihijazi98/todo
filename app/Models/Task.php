<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['board_name', 'created_date', 'updated_date'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function getBoardNameAttribute()
    {
        return $this->board->name;
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

}
