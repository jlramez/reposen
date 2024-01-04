<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Archivo;

class Sentencia extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'sentencias';

    protected $fillable = ['nombre','archivos_id','users_id'];
	
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
  
    public function archivos()
    {
        return $this->hasOne(Archivo::class, 'id', 'archivos_id');
    }
}
