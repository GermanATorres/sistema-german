<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div id="calendario"></div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left">Agendar actividad</h5>
        <button type="button" class="close pull-rigth" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="box-body">
          <div class="form-group">
            <label for="eventoId">Evento</label>
            <input type="text" class="form-control" id="eventoId" placeholder="Ingrese el nombre del evento" />
          </div>
          <div class="form-group">
            <label for="descripcion">Descripcion del Evento</label>
            <textarea type="text" class="form-control" id="descripcion" placeholder="Digite la descripcion"></textarea>
          </div>
          <div class="box-footer">
            <button type="button" id="btnSubmit" class="btn btn-primary">Agregar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>