<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'email',
        'telepon',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function patients()
        {
            return $this->hasMany(Patient::class);
        }
}
