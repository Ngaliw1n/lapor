<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;
    protected $table="spareparts";
    protected $fillable = [
        'nm_spareparts',
        'gmbr_spareparts',
        'kategori',
        'spareparts_detail',
        'id_mesins',
        'id_outlets'
    ]; 
}
