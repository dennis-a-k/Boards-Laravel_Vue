<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'board_id',
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function getLists()
    {
        return static::query()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getList($id)
    {
        return static::findOrFail($id);
    }

    public function createList($value)
    {
        return $this->create($value);
    }

    public function updateList($value, $id)
    {
        static::find($id)
            ->fill($value)
            ->save();

        return static::findOrFail($id);
    }

    public function deleteList($id)
    {
        static::find($id)->delete();
    }
}
