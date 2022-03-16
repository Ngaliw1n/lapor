<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;
    protected $table="kerusakan";
    protected $fillable = [
        'nm_kerusakan',
        'tgl',
        'gmbr_kerusakan',
        'detail',
        'id_mesins',
        'id_outlet',
        'id_pelapor'
    ]; 
}
