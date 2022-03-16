<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table="outlets";
    protected $fillable = [
        'nm_outlet',
        'detail',
        'gmbr_outlet'
    ]; 
}
