<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DetalleTarea extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'DetalleTarea';
	protected $primaryKey = 'idDetalleTarea';
    protected $fillable = [
        'idAlumno','idTarea','Calificacion','FechaEntrega','FechaEntregada'
    ];
}
