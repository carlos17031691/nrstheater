<?php

namespace App\Http\Controllers;
use App\Reserva;
use App\User;
use App\Butacas;
use Toast;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas=Reserva::all();

        return view('reservas',compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios=User::where('activo','!=',3)->get();
        return view('reservas-nuevo',compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $reserva=new Reserva;
        $reserva->id_usuario=$request->id_usuario;
        $reserva->fecha=$request->fecha;
        $reserva->save();
        $id_reserva=$reserva->id;
        $butacas=json_decode('['.$request->reservas.']');
       
        foreach ($butacas as $butaca) {
            $temporal=new Butacas;
            $temporal->id_reserva=$id_reserva;
            $temporal->fecha=$reserva->fecha;
            $temporal->numero_butaca=$butaca->butaca;
            $temporal->fila=$butaca->fila;
            $temporal->columna=$butaca->columna;
            $temporal->estado=1;
            $temporal->save();
        }
        $mensaje='';
        foreach ($butacas as $butaca) {
            $mensaje.=$butaca->butaca.', ';
        }
        $consulta=User::find($request->id_usuario);
        $usuario=$consulta->name.' '.$consulta->lastname;
       $log='Reserva: '.$reserva->id.'- Fecha de creación: '.$reserva->created_at.' - Usuario: '. $usuario.' - Butacas Reservadas: '.$mensaje;
        Storage::append('reservas.log',$log); //Archivo log ruta: storage/app/reservas.log
        Toast::message('Se reservaron las siguientes butacas '.$mensaje.' con exito');
        return redirect('/reservas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
