<?php

namespace App\Http\Controllers;
use App\User;
use Toast;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios=User::where('activo','=',1)->get();
        return view('usuarios',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $temporal=User::where('email','=',$request->email)->first();

        if(empty($temporal)){
            $usuario=new User;
            $usuario->name=$request->name;
            $usuario->lastname=$request->lastname;
            $usuario->email=$request->email;
            
            $usuario->save();

            Toast::message('El Usuario '.$usuario->name.' '.$usuario->lastname.' ha sido guardado con exito');
        }else{
            Toast::warning('El correo electrónico '.$request->email.' ya esta registrado');
        }
        
        
        return redirect('/usuarios');
        
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
       $usuario=User::find($id);
       return view('usuarios-modificar',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usuario=User::find($request->id);
        $usuario->name=$request->name;
        $usuario->lastname=$request->lastname;
        $usuario->email=$request->email;
        $usuario->update();

        Toast::message('El Usuario '.$usuario->name.' '.$usuario->lastname.' ha sido actualizado con exito');
        
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $usuario=User::find($request->id_usuario);
       $usuario->activo=0;
       $usuario->update();

       Toast::message('El Usuario '.$usuario->name.' '.$usuario->lastname.' ha sido eliminado con exito');
        
        return redirect('/usuarios');
    }
}
