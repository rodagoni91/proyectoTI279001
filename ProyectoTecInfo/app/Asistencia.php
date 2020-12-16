<?php
namespace App; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Asistencia extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Asistencia';
	protected $primaryKey = 'idAsistencia';
    protected $fillable = [
        'idAlumno','idDetalleCurso','Fecha'
    ];
}
