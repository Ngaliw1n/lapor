<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;
    protected $table="mesins";
    protected $fillable = [
        'nm_mesin',
        'gbr_mesin',
        'id_outlet',
        'tgl'
    ]; 
}
