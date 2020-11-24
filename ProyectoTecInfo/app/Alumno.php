<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Alumno extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Alumno';
	protected $primaryKey = 'idAlumno';
    protected $fillable = [
        'idUsuario','idEscuela','Direccion','Telefono'
    ]; 
}
