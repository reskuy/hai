<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPeminjaman extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'form_peminjaman';
    public $timestamps = false;
    public function department()
    {
        return $this->belongsTo(Department::class,'id_department','id_department');
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class,'id_aset','id_aset');
    }
    public function pengembalian()
    {
        return $this->belongsTo(FormPengembalianPeminjaman::class,'id_form_peminjaman','id_form_peminjaman');
    }
}