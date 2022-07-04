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
    // public function perusahaan()
    // {
    //     return $this->belongsTo(Perusahaan::class,'KodePerusahaan','KodePerusahaan');
    // }
}
