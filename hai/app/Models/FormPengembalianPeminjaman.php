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
        return $this->belongsTo(Department::class,'id_form_peminjaman','id_form_peminjaman');
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class,'id_aset','id_aset');
    }
}