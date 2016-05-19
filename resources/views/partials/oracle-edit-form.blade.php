<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" @click="edit()">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear reportes</h4>
      </div>
      <div class="modal-body">
          <form action="/oracle/create" method="post">
            <!-- Fecha de fallo -->
            <div class="form-group">
              <label for="date">Fecha y hora</label>
              <input type="date" class="form-control" id="date" placeholder="Fecha" name="date">
            </div>
            <!-- Base de dato -->
            <div class="form-group">
              <label for="db">BD</label>
              <input type="text" class="form-control" id="db" placeholder="Base de dato" name="db">
            </div>
            <!-- Maquina -->
            <div class="form-group">
              <label for="host">Maquina</label>
              <input type="text" class="form-control" id="host" placeholder="Maquina" name="host">
            </div>
            <!-- Tipo diario o semanal , mensual -->
            <div class="form-group">
              <label for="type">Tipo</label>
              <input type="text" class="form-control" id="type" placeholder="Tipo" name="type">
            </div>
            <!-- Ultimo bk fallido -->
            <div class="form-group">
              <label for="last_bk">Ultimo BK</label>
              <input type="text" class="form-control" id="last_bk" placeholder="Ultimo bk" name="last_bk">
            </div>
            <!-- Numero de bk fallidos -->
            <div class="form-group">
              <label for="num_failed_bk">Numero de BK fallidos</label>
              <input type="text" class="form-control" id="num_failed_bk" placeholder="Numero de fallidos" name="num_failed_bk">
            </div>
            <!-- Relanzado -->
            <div class="form-group">
              <label for="retried">Relanzado?</label>
              <input type="text" class="form-control" id="retried" placeholder="Relanzado" name="retried">
            </div>
            <!-- Estado fin ok o no? -->
            <div class="form-group">
              <label for="status">Finaliza ok??</label>
              <input type="text" class="form-control" id="status" placeholder="Fin ok?" name="status">
            </div>
            <textarea class="form-control" rows="3" name="observation"></textarea>
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
