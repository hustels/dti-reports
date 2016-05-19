@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Reportes Oracle</div>
        <div class="panel-body" id="oracleReports">
                Reportes oralce  
        <div class="responsive">
          <table class="ui celled table"  id="bootstrap-table">
                <thead> 
                  <tr > 
                        <th >Fecha</th> 
                        <th>BD</th>  
                        <th>Máquina</th>
                        <th>Tipo</th>
                        <th>Ultimo fallido</th>
                        <th>Número de fallidos</th>
                        <th>Relanzado</th>
                        <th>Finaliza ok?</th>
                        <th>Observaciones</th>
                        <th>                    
                        <button type="button" class="btn btn-primary btn-sm" 
                        data-toggle="modal" data-target="#create-form" >
                          Añadir nuevo registro
              </button></th>
                       
                    </tr> 
                </thead>
          @foreach($backups as $bk)
            <tr>
              <td class="ui ribbon label" id="date">{{$bk->date}}</td>
              <td>{{$bk->db}}</td>
              <td>{{$bk->host}}</td>
              <td>{{$bk->type}}</td>
              <td>{{$bk->last_bk}}</td>
              <td>{{$bk->num_failed_bk}}</td>
              <td>{{$bk->retried}}</td>
              <td>{{$bk->status}}</td>
              <td id="observation" data-toggle="modal" data-target="#desc_modal" data-id="12" onclick="passDataToModalBox()">{{$bk->observation}}</td>
              <td>
              <button type="button" class="btn btn-primary btn-sm" 
              data-toggle="modal" data-target="#myModal" @click="edit({{$bk->id}})">
              editar
              </button>

                <button type="button" class="btn btn-danger btn-sm" 
               @click="borrar({{$bk->id}})">
              Borrar
              </button>
            </td>


            </tr>
          @endforeach
            </table>  
        </div>
				
          </div>
        </div>
    </div>
</div>

<!-- //////////////forms /////////////////////// -->
<!-- Update form -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear reportes</h4>
      </div>
      <div class="modal-body">
          <form action="/oracle/update" method="post" id="generalForm"  >
            <!-- Fecha de fallo -->
            <div class="form-group">
              <input type="hidden" name="id" v-model="report_id">
              <label for="date">Fecha y hora</label>
              <input type="text" class="form-control" id="date" placeholder="Fecha" name="date" v-model="date" required>
            </div>
            <!-- Base de dato -->
            <div class="form-group">
              <label for="db">BD</label>
              <input type="text" class="form-control" id="db" placeholder="Base de dato" name="db" v-model="db" required>
            </div>
            <!-- Maquina -->
            <div class="form-group">
              <label for="host">Maquina</label>
              <input type="text" class="form-control" id="host" placeholder="Maquina" name="host" v-model="host" required>
            </div>
            <!-- Tipo diario o semanal , mensual -->
            <!--
            <div class="form-group">
              <label for="type">Tipo</label>
              <input type="text" class="form-control" id="type" placeholder="Tipo" name="type" v-model="type" required>
            </div> -->
            <select class="form-control" name="type" id="type">
                <option value="Diario">Diario</option>
                <option value="Semanal">Semanal</option>
                <option value="Mensual">Mensual</option>
            </select>
            <!-- Ultimo bk fallido -->
            <div class="form-group">
              <label for="last_bk">Ultimo BK</label>
              <input type="text" class="form-control" id="last_bk" placeholder="Ultimo bk" name="last_bk" v-model="last_bk" required>
            </div>
            <!-- Numero de bk fallidos -->
            <div class="form-group">
              <label for="num_failed_bk">Numero de BK fallidos</label>
              <input type="text" class="form-control" id="num_failed_bk" placeholder="Numero de fallidos" name="num_failed_bk" v-model="num_failed_bk" required>
            </div>
            <!-- Relanzado -->
           <!-- <div class="form-group">
              <label for="retried">Relanzado?</label>
              <input type="text" class="form-control" id="retried" placeholder="Relanzado" name="retried" v-model="retried" >
            </div>-->
            <select class="form-control" name="retried" id="retried">
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <!-- Estado fin ok o no? -->
            <!--<div class="form-group">
              <label for="status">Finaliza ok??</label>
              <input type="text" class="form-control" id="status" placeholder="Fin ok?" name="status" v-model="status" >
            </div>-->
            <select class="form-control" name="status" id="status">
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <textarea class="form-control" rows="3" name="observation" v-model="observation"></textarea>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
          <button type="submit" class="btn btn-default">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Create form -->
<div class="modal fade generalForm" id="create-form" tabindex="-1" role="dialog" aria-labelledby="create-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear reportes</h4>
      </div>
      <div class="modal-body">
          <form action="/oracle/create" method="post" class="generalForm" v-on:submit="validate($event)">
            <!-- Fecha de fallo -->
            <div class="form-group">
              <label for="date">Fecha y hora</label>
              <input type="date" class="form-control" id="date" placeholder="Fecha" name="date" required>
            </div>
            <!-- Base de dato -->
            <div class="form-group">
              <label for="db">BD</label>
              <input type="text" class="form-control" id="db" placeholder="Base de dato" name="db" required>
            </div>
            <!-- Maquina -->
            <div class="form-group">
              <label for="host">Maquina</label>
              <input type="text" class="form-control" id="host" placeholder="Maquina" name="host" required>
            </div>
            <!-- Tipo diario o semanal , mensual -->
            <!--
            <div class="form-group">
              <label for="type">Tipo</label>
              <input type="text" class="form-control" id="type" placeholder="Tipo" name="type" required>
            </div>-->
              <select class="form-control" name="type" id="type">
                <option value="Diario">Diario</option>
                <option value="Semanal">Semanal</option>
                <option value="Mensual">Mensual</option>
            </select>
            <!-- Ultimo bk fallido -->
            <div class="form-group">
              <label for="last_bk">Ultimo BK</label>
              <input type="text" class="form-control" id="last_bk" placeholder="Ultimo bk" name="last_bk" required>
            </div>
            <!-- Numero de bk fallidos -->
            <div class="form-group">
              <label for="num_failed_bk">Numero de BK fallidos</label>
              <input type="text" class="form-control" id="num_failed_bk" placeholder="Numero de fallidos" name="num_failed_bk" required>
            </div>
            <!-- Relanzado -->
            <!--
            <div class="form-group">
              <label for="retried">Relanzado?</label>
              <input type="text" class="form-control" id="retried" placeholder="Relanzado" name="retried">
            </div>-->
            <select class="form-control" name="retried" id="retried">
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <!-- Estado fin ok o no? -->
            <!--<div class="form-group">
              <label for="status">Finaliza ok??</label>
              <input type="text" class="form-control" id="status" placeholder="Fin ok?" name="status" >
            </div>-->
            <select class="form-control" name="status" id="status">
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <textarea class="form-control" rows="3" name="observation" required></textarea>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
          <button type="submit" class="btn btn-default" >Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- ////////////////end forms /////////////// -->


<!-- Descripciones -->
<div id="desc_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Observación</h4>

            </div>
            <div class="modal-body" id="orderDetails">
              <p class="obs">hello</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End descripciones -->
@endsection

@section('scripts')
<script src="/js/oracle/app.js"></script>
@endsection

<script>
	
</script>

