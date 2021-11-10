<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    protected $table = 'room_categories';
    protected $primaryKey = 'room_category_id';
    protected $fillable = ['room_category_name', 'room_category_details'];

    public function validation()
    {
        return [
            'room_category_name'    => 'required',
            'room_category_details' => 'required',
        ];
    }
}
