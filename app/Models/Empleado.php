<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'salario', 'antiguedad', 'puesto_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function obtenerNombre()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function registroSalarios()
    {
        return $this->hasMany(RegistroSalario::class);
    }
    
}
