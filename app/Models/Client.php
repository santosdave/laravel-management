<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'c_id';
    protected $fillable = ['c_name', 'c_sex', 'c_age', 'c_phone', 'c_address','c_th_id','c_room_category_id','c_room_id'];

    public function validation()
    {
    	return [
	    	'c_name'    => 'required',
	    	'c_age'     => 'required',
	    	'c_address' => 'required',
	    	'c_phone'   => 'required',
	    	'c_sex'     => 'required',
            'c_th_id'   => 'required',
            'c_room_category_id'=> 'required',
            'c_room_id'  => 'required'
	    ];
    }
    public static function boot()
	{
	    parent::boot();
	    static::saving(function ($model) {
	        $model->c_s = IdGenerator::generate(['table' => 'clients', 'field'=>'c_s', 'length' => 10, 'prefix' => 'OUTPAT']);
	    });
	}
}
