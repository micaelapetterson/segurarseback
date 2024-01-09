<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSalario extends Model
{
    use HasFactory;

    protected $fillable = ['salarioHistorico', 'fechaSalario', 'tipo', 'empleado_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

}
