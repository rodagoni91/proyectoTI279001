<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoUsuario extends Model
{
    use softDeletes;
    protected $table = 'TipoUsuario';
	protected $primaryKey = 'idTipoUsuario';
    protected $fillable = [
        'nombre',
    ];
}
