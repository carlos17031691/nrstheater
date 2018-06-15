<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Butacas;

class Reserva extends Model
{
    public function usuario()
    {
    	$usuario=User::find($this->id_usuario);
    	return $usuario;
    }

    public function butacas()
    {
    	$butacas=Butacas::where('id_reserva','=',$this->id)->get();
    	$temporal='';
    	foreach ($butacas as $butaca) {
    		$temporal.=$butaca->numero_butaca.', ';

    	}
    	return $temporal;
    }

    
}
