@extends('layouts.app')

@section('Titulo_Principal')
  Registro de Usuario
@endsection

@section('css')

@endsection

@section('titulo_contenido')
<div class="row">
  <h3>Registro de Usuario</h3>
</div> 
  
@endsection
@section('contenido')

     <form method="post" action="{{url('/usuarios/store')}}">
        @csrf
        <div class="col-md-12 col-xs-12">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" required placeholder="Nombre">
          </div>
        </div>

        <div class="col-md-12 col-xs-12">
          <div class="form-group">
            <label for="lastname">Apellido</label>
            <input type="text" id="lastname" name="lastname" class="form-control" required placeholder="Apellido">
          </div>
        </div>

        <div class="col-md-12 col-xs-12">
          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required placeholder="Correo Electrónico">
          </div>
        </div> 

              
        <button type="submit" class="btn btn-primary">Guardar</button>
      
    </form>   
    
@endsection
@section('script')
<script>

    
</script>

@endsection

