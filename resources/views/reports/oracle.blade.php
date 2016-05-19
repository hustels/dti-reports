@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">Reportes Oracle</div>
      <div class="panel-body" id="oracleReports">
        Reportes oralce
        <div class="responsive">
        <!-- /////// Display Errors  //////-->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <table class="ui celled table"  id="bootstrap-table">
            <thead>
              <tr >
                <th style="width: 160px">Fecha</th>
                <th>BD</th>
                <th style="width: 30px">Máquina</th>
                <th style="width: 40px">Tipo</th>
                <th style="width: 120px">Ultimo fallido</th>
                <th style="width: 140px">Número de fallidos</th>
                <th style="width: 40px">Relanzado</th>
                <th style="width: 100px">Finaliza ok?</th>
                <th style="width: 27px">Observaciones</th>
                <th style="width: 100px">
                  <!--
                  <a href="#" data-toggle="modal"  data-target="#create-form" >
                    Añadir
                    <i class="add square icon" ></i>
                  </a> -->
                  <button type="button" class="ui blue basic button"
                  data-toggle="modal"  data-target="#create-form"  >
                  Añadir
                  </button>
                </th>
                <th>Errores</th>
              </tr>
            </thead>
            @foreach($backups as $bk)
            <tr>
              <td class="ui ribbon label" id="date" style="width: 160px">{{$bk->date}}</td>
              <td>{{$bk->db}}</td>
              <td>{{$bk->host}}</td>
              <td>{{$bk->type}}</td>
              <td>{{$bk->last_bk}}</td>
              <td>{{$bk->num_failed_bk}}</td>
              <td>{{$bk->retried}}</td>
              <td>{{$bk->status}}</td>
              <td>
                <a href="#" @click="addObservationToModal({{$bk->id}})"
                  data-toggle="modal" data-target="#observationModal"
                  >
                  <span class="glyphicon glyphicon-info-sign"></span>
                </a>
              </td>
              <td>
                <i class="edit icon" data-toggle="modal" 
                data-target="#myModal" @click="edit({{$bk->id}})"></i>
                <i class="remove icon" @click="borrar({{$bk->id}})"></i>
              </td>
                  <td>
                <a href="#" 
                  data-toggle="modal" data-target="#ErrorsModal" 
                  @click="addErrorToModal({{$bk->id}})"
                  >
                  
                  <i class="attach icon"></i>
                </a>
                  <a href="#" 
                  data-toggle="modal" data-target="#getErrorsModal" 
                  @click="displayErrorsInModal({{$bk->id}})"
                  >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
        
      </div>
    </div>
  </div>
  <!-- //// observation modal box -->
  <!-- Observation modal Modal -->
  <div class="modal fade" id="observationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Observaciones</h4>
        </div>
        <div class="modal-body" >
          <textarea cols="75" rows="10" v-model="observation" id="txtarea">
          
          </textarea>
        </div>
      </div>
    </div>
  </div>
  <!-- ////// end observation modal box -->
   <!-- //// Errors modal box -->
      <div class="modal fade" id="ErrorsModal" tabindex="-1" role="dialog" aria-labelledby="ErrorsModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" >Errores</h4>
          </div>
        <div class="modal-body" >
          <form action="errors" method="post" class="dropzone">
            <input type="hidden" name="oracle_id" v-model="id_for_report">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end Errors modal Modal -->
  <!-- Display errors modal Modal -->
      <!-- //// Errors modal box -->
      <div class="modal fade" id="getErrorsModal" tabindex="-1" role="dialog" aria-labelledby="getErrorsModal">
    <div class="modal-dialog" role="document" style="width: 1080px">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" >Errores</h4>
          </div>
        <div class="modal-body" >
          <div class="row" >
            <div class="col-md-6">
              <ul>
                <li v-for="error in errors">
                <img src="@{{error.path}}" alt="" style="max-width: 80%; max-height: 80%">
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Display errors modal Modal -->
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
<!-- /////// Create form  ///////-->

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
            <input type="date" class="form-control" id="last_bk" placeholder="Ultimo bk" name="last_bk" required>
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
          <label> Relanzado? </label>
          <select class="form-control" name="retried" id="retried">
            <option value="Si">Si</option>
            <option value="No">No</option>
          </select>
          <!-- Estado fin ok o no? -->
          <!--<div class="form-group">
            <label for="status">Finaliza ok??</label>
            <input type="text" class="form-control" id="status" placeholder="Fin ok?" name="status" >
          </div>-->
          <label> Finaliza ok ? </label>
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