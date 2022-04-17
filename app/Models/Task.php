<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'card_id',
    ];

    public function createTask($value)
    {
        return $this->create($value);
    }

    public function deleteTask($id)
    {
        static::find($id)->delete();
    }
}
