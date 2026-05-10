<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // HAPUS protected $primaryKey = 'user_id'; 
    // HAPUS protected $guarded = []; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_telp', // Tambahkan ini agar aman
        'alamat',  // Tambahkan ini agar aman
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // --- RELASI ---
    
    public function prescriptions() {
        // Karena standar Laravel foreign key-nya adalah 'user_id' dan local key-nya 'id',
        // kita bisa menuliskannya lebih ringkas seperti ini:
        return $this->hasMany(Prescription::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function consultations() {
        return $this->hasMany(Consultation::class);
    }
}