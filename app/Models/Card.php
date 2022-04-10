<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'board_list_id',
    ];

    public function createCard($value)
    {
        return $this->create($value);
    }

    public function deleteCard($id)
    {
        static::find($id)->delete();
    }
}
