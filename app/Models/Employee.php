<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey='emp_id';
    protected $fillable=['emp_role_id','emp_name','emp_phone','emp_address','emp_sex','emp_email','emp_password','emp_img'];
}
