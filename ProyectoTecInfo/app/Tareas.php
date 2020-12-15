<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tareas extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Tareas';
	protected $primaryKey = 'idTarea';
    protected $fillable = [
        'idDetalleCurso','Fecha','Hora','TituloTarea','DescripcionTarea'
    ]; 
}
