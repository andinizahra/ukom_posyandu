<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanVaksin extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'catatan_vaksin';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];

    public function CatatanImunisasi()
    {
        return $this->belongsTo(CatatanImunisasi::class, 'id_catatan_imunisasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
