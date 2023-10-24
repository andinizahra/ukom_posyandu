<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanImunisasi extends Model
{
    use HasFactory;

    protected $table = 'catatan_imunisasi';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['catatan_imunisasi'];

    public $timestamps = false;
}
