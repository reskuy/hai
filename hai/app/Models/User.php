<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'user';
    public $timestamps = false;
    public function department()
    {
        return $this->belongsTo(Department::class,'id_department','id_department');
    }
}
