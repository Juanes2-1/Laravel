<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios'; // Asegúrate de que coincida con tu base de datos

    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'correo',
        'saldoIni',
        'ciudadNa',
        'contraseña', // Se mantiene 'contraseña' porque así está en la base de datos
    ];

    protected $hidden = [
        'contraseña', // Oculta la contraseña en respuestas JSON
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
