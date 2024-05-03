<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsulanUjikom extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'jenis_ujikom_id',
        'ujikom_id',
        'usulan_lainnya',
        'status',
    ];

    public function usulanUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function usulanJenisUjikom()
    {
        return $this->belongsTo(JenisUjikom::class,'jenis_ujikom_id');
    }

    public function usulanUjikom()
    {
        return $this->belongsTo(Ujikom::class,'ujikom_id');
    }
}
