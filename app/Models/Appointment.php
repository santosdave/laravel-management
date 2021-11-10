<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'app_id';
    protected $fillable = ['app_sl','app_c_id', 'app_ther_id', 'app_date', 'app_message', 'app_status'];

    public function validation() 
    {
	
    	return [ 
    		'app_c_id'   => 'required',
    		'app_ther_id' => 'required',
    		'app_date'   => 'required',
    		'app_status' => 'required',
    	];
    }

    public function message()
    {
    	return [
    		'app_c_id.required'   => 'Client id is empty',
    		'app_ther_id.required' => 'Therapist name is empty',
    		'app_date.required'   => 'Date is empty',
    		'app_status.required' => 'Appointment status is empty',
    	];
	}
	
	public function client()
    {
        return $this->belongsTo("App\Client", "app_c_id");
    }

	public static function boot()
	{
	    parent::boot();
	    static::saving(function ($model) {
	        $model->app_sl = IdGenerator::generate(['table' => 'appointments', 'field'=>'app_sl', 'length' => 10, 'prefix' => 'APP']);
	    });
	}
}
