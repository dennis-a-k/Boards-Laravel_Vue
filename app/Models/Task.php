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
        'is_done',
    ];

    public function createTask($value)
    {
        return $this->create($value);
    }

    public function updateTask($value, $id)
    {
        static::find($id)
            ->fill($value)
            ->save();

        return static::findOrFail($id);
    }

    public function deleteTask($id)
    {
        static::find($id)->delete();
    }
}
