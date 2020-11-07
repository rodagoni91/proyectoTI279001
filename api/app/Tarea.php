<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tarea extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'Tarea';
	protected $primaryKey = 'idTarea';
    protected $fillable = [
        'idCurso','FechaEntrega','DescripcionTarea'
    ];
}
