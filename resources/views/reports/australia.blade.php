@extends('layouts.app')
@section('content')
<div class="container">
  <script type="text/javascript">
   /* sweetAlert("Oops...", "Something went wrong!", "error");*/
  </script>
  <div class="row">

    <div class="panel panel-default">
      <div class="panel-heading">Reportes Australia</div>
      <div class="panel-body" id="oracleReports">
        Reportes Australia
        <div class="responsive">
          <table class="ui celled table srvmast_table"  id="bootstrap-table">
            <thead>
              <tr >
                <th style="width: 160px">Hora de fallo</th>
                <th>sesión</th>
                <th >Especificación</th>
                <th>Host/Filesystem</th>
                <th style="width: 40px">Tipo</th>
                <th style="width: 120px">Relanzado?</th>
                <th style="width: 120px">Sesión nueva</th>
                <th style="width: 140px">Incidencia</th>
                <th style="width: 40px">Enlace</th>
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
                <th>Error</th>
              </tr>
            </thead>
            @foreach($backups as $bk)
            <tr>
              <td class="ui ribbon label" id="date" style="width: 160px">{{$bk->date}}</td>
              <td>{{$bk->session}}</td>
              <td>{{$bk->specification}}</td>
              <td>{{$bk->host}}</td>
              <td>{{$bk->type}}</td>
              <td>{{$bk->retried}}</td>
              <td>{{$bk->new_session}}</td>
              <td>{{$bk->incident}}</td>
              <td>{{$bk->link}}</td>
              <td>{{$bk->end_ok}}</td>
              <td>
                <a href="#" @click="addObservationToModal({{$bk->id}})"
                  data-toggle="modal" data-target="#observationModal"
                  >
                  <span class="glyphicon glyphicon-info-sign"></span>
                </a>
              </td>
              <td>
               <i class="edit icon" class="btn btn-primary btn-sm"
                data-toggle="modal" data-target="#myModal" @click="edit({{$bk->id}})" > </i>
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
          <textarea cols="75" rows="10" v-model="observations" id="txtarea">
          
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
            <input type="hidden" name="australia_id" v-model="id_for_report">
          </form>
        </div>
      </div>
    </div>
  </div>
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

  <!-- ////// end Errors modal box -->
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
        <form action="/australia/update" method="post" class="generalForm" v-on:submit="validate($event)">
          <!-- Fecha de fallo -->
          <div class="form-group">
            <input type="hidden" name="id" v-model="report_id">
            <label for="date">Fecha y hora</label>
            <input type="date" class="form-control" id="date" placeholder="Fecha" name="date" v-model="date" required>
          </div>
          <!-- Sesion -->
          <div class="form-group">
            <label for="sesion">Sesión</label>
            <input type="text" class="form-control" id="session" placeholder="Sesion" name="session" v-model="session" required>
          </div>
          <!-- Especificacion-->
          <div class="form-group">
            <label for="specifications">Especificación</label>
            <input type="text" class="form-control" id="specifications" placeholder="Especificación" name="specification" v-model="specification" required>
          </div>
          <!-- Maquina -->
          <div class="form-group">
            <label for="host">Maquina</label>
            <input type="text" class="form-control" id="host" placeholder="Maquina" name="host" v-model="host" required>
          </div>
          <div class="form-group">
            <label for="">Tipo</label>
            <select class="form-control" name="type" id="type">
              <option value="full">Full</option>
              <option value="incremental">Incremental</option>
              <option value="diferencial">Diferencial</option>
            </select>
          </div>
          <!-- Relanzado -->
          <!--
          <div class="form-group">
            <label for="retried">Relanzado?</label>
            <input type="text" class="form-control" id="retried" placeholder="Relanzado" name="retried">
          </div>-->
          <div class="form-group">
            <label for="">Relanzado?</label>
            <select class="form-control" name="retried" id="retried">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>
          <!-- Nueva sesión -->
          <div class="form-group">
            <label for="new_session">Nueva Sesión</label>
            <input type="text" class="form-control" id="new_session" placeholder="Sesión nueva" name="new_session" v-model="new_session" required>
          </div>
          <!-- Tipo diario o semanal , mensual -->
          <!--
          <div class="form-group">
            <label for="type">Tipo</label>
            <input type="text" class="form-control" id="type" placeholder="Tipo" name="type" required>
          </div>-->
          <!-- Incidencia -->
          <div class="form-group">
            <label for="incident">Incidencia</label>
            <input type="text" class="form-control" id="incident" placeholder="Incidencia" name="incident" v-model="incident" required>
          </div>
          <!-- Enlace -->
          <div class="form-group">
            <label for="link">Enlace</label>
            <input type="text" class="form-control" id="link" placeholder="Enlace" name="link" v-model="link" required>
          </div>
          <!-- Estado fin ok o no? -->
          <!--<div class="form-group">
            <label for="status">Finaliza ok??</label>
            <input type="text" class="form-control" id="status" placeholder="Fin ok?" name="status" >
          </div>-->
          <div class="form-group">
            <label for="">Finaliza ok?</label>
            <select class="form-control" name="end_ok" id="end_ok">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>
          <textarea class="form-control" rows="3" name="observations" v-model="observations"  required></textarea>
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
<!-- Create form -->
<div class="modal fade generalForm" id="create-form" tabindex="-1" role="dialog" aria-labelledby="create-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear reportes</h4>
      </div>
      <div class="modal-body">
        <form action="/australia/create" method="post" class="generalForm" v-on:submit="validate($event)">
        
          <!-- Fecha de fallo -->
          <div class="form-group">
            <label for="date">Fecha y hora</label>
            <input type="date" class="form-control" id="date" placeholder="Fecha" name="date" required>
          </div>
          <!-- Sesion -->
          <div class="form-group">
            <label for="sesion">Sesión</label>
            <input type="text" class="form-control" id="session" placeholder="Sesion" name="session" required>
          </div>
          <!-- Especificacion-->
          <div class="form-group">
            <label for="specifications">Especificación</label>
            <input type="text" class="form-control" id="specifications" placeholder="Especificación" name="specification" required>
          </div>
          <!-- Maquina -->
          <div class="form-group">
            <label for="host">Maquina</label>
            <input type="text" class="form-control" id="host" placeholder="Maquina" name="host" required>
          </div>
          <div class="form-group">
            <label for="">Tipo</label>
            <select class="form-control" name="type" id="type">
              <option value="full">Full</option>
              <option value="incremental">Incremental</option>
              <option value="diferencial">Diferencial</option>
            </select>
          </div>
          <!-- Relanzado -->
          <!--
          <div class="form-group">
            <label for="retried">Relanzado?</label>
            <input type="text" class="form-control" id="retried" placeholder="Relanzado" name="retried">
          </div>-->
          <div class="form-group">
            <label for="">Relanzado?</label>
            <select class="form-control" name="retried" id="retried">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>
          <!-- Nueva sesión -->
          <div class="form-group">
            <label for="new_session">Nueva Sesión</label>
            <input type="text" class="form-control" id="new_session" placeholder="Sesión nueva" name="new_session" required>
          </div>
          <!-- Tipo diario o semanal , mensual -->
          <!--
          <div class="form-group">
            <label for="type">Tipo</label>
            <input type="text" class="form-control" id="type" placeholder="Tipo" name="type" required>
          </div>-->
          <!-- Incidencia -->
          <div class="form-group">
            <label for="incident">Incidencia</label>
            <input type="text" class="form-control" id="incident" placeholder="Incidencia" name="incident" required>
          </div>
          <!-- Enlace -->
          <div class="form-group">
            <label for="link">Enlace</label>
            <input type="text" class="form-control" id="link" placeholder="Enlace" name="link" required>
          </div>
          <!-- Estado fin ok o no? -->
          <!--<div class="form-group">
            <label for="status">Finaliza ok??</label>
            <input type="text" class="form-control" id="status" placeholder="Fin ok?" name="status" >
          </div>-->
          <div class="form-group">
            <label for="">Finaliza ok?</label>
            <select class="form-control" name="end_ok" id="end_ok">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>
          <textarea class="form-control" rows="3" name="observations" required></textarea>
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
<script src="/js/australia/app.js"></script>
@endsection
<script>

</script>