@extends('layouts.app')

@section('Titulo_Principal')
  Usuarios
@endsection

@section('css')

@endsection

@section('titulo_contenido')
<div class="row">
  <h3>Usuarios Registrados</h3>
</div>
<div class="row">
  <a href="{{url('/usuarios/create')}}" class="btn btn-success">Agregar Usuario</a>
</div>    
  
@endsection
@section('contenido')

  
    <div class="row">
     <table id="usuarios" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)           
            <tr>
              
              <td>{{$usuario->id}}</td>
              <td>{{$usuario->name}}</td>
              <td>{{$usuario->lastname}}</td>
              <td>{{$usuario->email}}</td>
              <td><a href="javascript:void(0)" onclick="activar_modal({{$usuario->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
              <a href="{{url('/usuarios/edit').'/'.$usuario->id}}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
              
            </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Modal para eliminacion de Usuarios-->
    <form id="delete-form" method="post">
      @csrf
    <div class="modal modal-danger fade" id="modal-delete" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Eliminar Usuario</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_usuario" id="id_usuario">
            <p>
              ¿Esta seguro que desea eliminar?
              <br>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-outline" onclick="eliminar_usuario()">Eliminar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
        </form>

        <!--Fin  Modal para eliminacion de Usuarios-->

    
@endsection
@section('script')
<script>

    $(document).ready(function() {
        $('#usuarios').DataTable();
    } );

function activar_modal(id) {
  var action = "{{url('/usuarios/delete')}}";
  $("#delete-form").attr("action", action);
  $('#id_usuario').val(id);
  $('#modal-delete').modal('show');
}

function eliminar_usuario(){
  $('#modal-delete').modal('hide');
  $('#delete-form').submit();
}
  
</script>

@endsection