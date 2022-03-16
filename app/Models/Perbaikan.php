<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table="perbaikan";
    protected $fillable = [
        'nm_perbaikan',
        'tgl',
        'gmbr_perbaikan',
        'detail',
        'id_mesins',
        'id_outlets',
        'id_pelapor'
        
    ]; 
}
