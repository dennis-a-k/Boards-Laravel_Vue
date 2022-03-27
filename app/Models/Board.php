<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
    ];

    public function lists()
    {
        return $this->hasMany(BoardList::class);
    }

    public function getBoards()
    {
        return static::query()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getBoard($id)
    {
        return static::findOrFail($id);
    }

    public function createBoard($value)
    {
        return $this->create($value);
    }

    public function updateBoard($value, $id)
    {
        static::find($id)
            ->fill($value)
            ->save();

        return static::findOrFail($id);
    }

    public function deleteBoard($id)
    {
        static::find($id)->delete();
    }
}
