<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Inscripcion extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Inscripcion';
	protected $primaryKey = 'idInscripcion';
    protected $fillable = [
        'idAlumno','idDetalleCurso'
    ];
}
