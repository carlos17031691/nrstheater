@extends('layouts.app')

@section('Titulo_Principal')
  Nueva Reserva
@endsection

@section('css')

@endsection

@section('titulo_contenido')
<div class="row">
  <h3>Nueva Reserva</h3>
</div>
@endsection
@section('contenido')

  
    <div class="row">
     <div class="col-12">
       <form action="{{url('/reservas/store')}}" method="post" id="form_reservas">
         @csrf
        
         <div class="col-6 form-group">
            <label for="fecha">Fecha de Reserva</label>
           <input type="date" name="fecha" id="fecha" required class="form-control">
         </div>
         <div class="col-6 form-group">
            <label for="usuario">Usuario</label>
            <select id="usuario" name="id_usuario" class="form-control">
              @foreach($usuarios as $usuario)  
                <option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->lastname}}</option>
              @endforeach
            </select>
          </div>
         <div class="col-3 form-group">
           <input type="hidden" name="reservas" id="reservas_field">
         <button onclick="reservar()" type="button" class="btn btn-primary form-control">Reservar</button>
         </div>
       </form>
     </div>
    </div>
<div id="disponibilidad">
  <br>
  <br>
    <div class="row">
      <div class="col-12">
        <h2 style="text-align: center">Disponibilidad</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-1">
        <div class="card card-hover" onclick="limpiar()">
          <div class="box bg-dark text-center">
            <h1 class="font-light text-white"><i class="mdi mdi-sofa"></i></h1>
            <h6 class="text-white">Limpiar</h6>
          </div>
        </div>
      </div>
        @for ($i = 1; $i < 11; $i++)
      <div class="col-1">
        <div class="card card-hover">
          <div class="box bg-dark text-center">
            <h1 class="font-light text-white"><i class="mdi mdi-arrow-right-bold"></i></h1>
            <h6 class="text-white">Col {{$i}}</h6>
          </div>
        </div>
      </div>
      @endfor
    </div>
    <div class="row">
      <?php $butaca =1; ?>
      @for ($i = 1; $i < 6; $i++)
        <div class="col-1">
          <div class="card card-hover">
            <div class="box bg-dark text-center">
              <h1 class="font-light text-white"><i class="mdi mdi-arrow-down-bold"></i></h1>
              <h6 class="text-white">fila {{$i}}</h6>
            </div>
          </div>
        </div>
        @for ($j = 1; $j < 11; $j++)
          <div class="col-1">
            <a onclick="seleccionar_butaca({{$i}},{{$j}},{{$butaca}})">
          <div  class="card card-hover">
            <div id="butaca-{{$butaca}}" class="box bg-success text-center">
              <h1 class="font-light text-white"><i class="mdi mdi-seat-recline-extra"></i></h1>
              <h6 class="text-white">{{$butaca}}</h6>
            </div>
          </div>
          </a>
        </div>
        <?php $butaca++;?>
        @endfor
        <div class="col-1">
          <div class="card card-hover">
            
          </div>
        </div>
      @endfor
    </div>
      
</div>      



    
@endsection
@section('script')
<script>
var reservas=[];
    $(document).ready(function() {
        $('#reservas').DataTable();
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
  
 function seleccionar_butaca(fila,columna,butaca){
  var temporal={
    'fila' : fila,
    'columna' : columna,
    'butaca' : butaca
  };
  if($( '#butaca-'+butaca ).hasClass( "bg-success" )){
    $( '#butaca-'+butaca ).addClass("bg-warning");
    $( '#butaca-'+butaca ).removeClass("bg-success");
    reservas.push(JSON.stringify(temporal));
  }
  
  $('#reservas_field').val(reservas);

 }

function limpiar() {
  for(x=1;x<51;x++){
    if($( '#butaca-'+x ).hasClass( "bg-warning" )){
      $( '#butaca-'+x ).addClass("bg-success");
      $( '#butaca-'+x ).removeClass("bg-warning");
    }
  } 
  reservas=[];
  $('#reservas_field').val('');

}

function reservar() {
  if(reservas != null && reservas != ''){
    $('#form_reservas').submit();
  }else{
    alert('debe seleccionar almenos 1 butaca ')
  }
} 

$('#fecha').change(function () {
  for(x=1;x<51;x++){
    if($( '#butaca-'+x ).hasClass( "bg-danger" )){
      $( '#butaca-'+x ).addClass("bg-success");
      $( '#butaca-'+x ).removeClass("bg-danger");
    }
  } 
  limpiar();
  $.ajax({
            type: "GET",
            url: '{{url('/disponibilidad/')}}/'+$(this).val(),
                success: function (data) {
                    data.forEach(function (elemento) {
                      $('#butaca-'+elemento).removeClass('bg-success');
                      $('#butaca-'+elemento).addClass('bg-danger');
                    })
                },
                error: function (data) {
                    alert('error');
                }
        });
})
</script>



@endsection