<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    protected $table = 'therapists';
    protected $primaryKey = 'ther_id';
    protected $fillable = ['ther_name', 'ther_phone','ther_address', 'ther_email', 'ther_password', 'ther_profile', 'ther_img', 'ther_dept_id'];
}
