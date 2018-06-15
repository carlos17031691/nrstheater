@extends('layouts.app')

@section('Titulo_Principal')
  Actualización de Usuario
@endsection

@section('css')

@endsection

@section('titulo_contenido')
<div class="row">
  <h3>Actualización de Usuario</h3>
</div> 
  
@endsection
@section('contenido')

     <form method="post" action="{{url('/usuarios/update')}}">
        @csrf
        <input type="hidden" name="id" value="{{$usuario->id}}">
        <div class="col-md-12 col-xs-12">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{$usuario->name}}">
          </div>
        </div>

        <div class="col-md-12 col-xs-12">
          <div class="form-group">
            <label for="lastname">Apellido</label>
            <input type="text" id="lastname" name="lastname" class="form-control" required value="{{$usuario->lastname}}">
          </div>
        </div>

        <div class="col-md-12 col-xs-12">
          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required value="{{$usuario->email}}">
          </div>
        </div> 

           
        
        <button type="submit" class="btn btn-primary">Guardar</button>
      
    </form>   
    
@endsection
@section('script')
<script>

    
</script>

@endsection

