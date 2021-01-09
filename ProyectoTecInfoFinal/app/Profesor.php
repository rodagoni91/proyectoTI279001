<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profesor extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'Profesor';
	protected $primaryKey = 'idProfesor';
    protected $fillable = [
        'idUsuario','Direccion','Telefono'
    ]; 
}
