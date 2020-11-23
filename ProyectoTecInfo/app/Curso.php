<?php
namespace App; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Curso extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Curso';
	protected $primaryKey = 'idCurso';
    protected $fillable = [
        'idEscuela','idProfesor','NombreCurso'
    ];
}
