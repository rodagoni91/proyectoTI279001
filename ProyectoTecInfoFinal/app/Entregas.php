<?php
namespace App; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Entregas extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Entregas';
	protected $primaryKey = 'idEntrega';
    protected $fillable = [
        'idTarea','idAlumno','ArchivoTarea','Calificacion','Observaciones'
    ];
}
