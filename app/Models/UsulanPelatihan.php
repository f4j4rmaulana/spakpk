<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsulanPelatihan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'jenis_pelatihan_id',
        'pelatihan_id',
        'usulan_lainnya',
        'status',
    ];

    public function usulanUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function usulanJenisPelatihan()
    {
        return $this->belongsTo(JenisPelatihan::class,'jenis_pelatihan_id');
    }

    public function usulanPelatihan()
    {
        return $this->belongsTo(Pelatihan::class,'pelatihan_id');
    }
}
