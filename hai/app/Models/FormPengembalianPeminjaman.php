<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengembalianPeminjaman extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pengembalian_peminjaman';
    public $timestamps = false;
    public function peminjaman()
    {
        return $this->belongsTo(FormPeminjaman::class,'id_form_peminjaman','id_form_peminjaman');
    }
}