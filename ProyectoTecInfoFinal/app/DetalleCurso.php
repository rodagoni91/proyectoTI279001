<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DetalleCurso extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'DetalleCurso';
	protected $primaryKey = 'idDetalleCurso';
    protected $fillable = [
        'idEscuela','idProfesor','Hora', 'CodigoCurso'
    ];
}
