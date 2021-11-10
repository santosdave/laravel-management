<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $fillable = ['room_name', 'room_category_id','room_status'];

    public function validation()
    {
        return [
            'room_name' => 'required',
            'room_category_id'    => 'required',
        ];
    }
}
