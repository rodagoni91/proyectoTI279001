<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escuela extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'Escuela';
	protected $primaryKey = 'idEscuela';
    protected $fillable = [
        'idUsuario','Direccion','Telefono','Director'
    ];
}
