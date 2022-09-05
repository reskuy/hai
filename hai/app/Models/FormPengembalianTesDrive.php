<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengembalianTesDrive extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pengembalian_tes_drive';
    public $timestamps = false;
    public function tesdrive()
    {
        return $this->belongsTo(FormTesDrive::class,'id_form_tes_drive','id_form_tes_drive');
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class,'id_aset','id_aset');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'id_department','id_department');
    }
    
}