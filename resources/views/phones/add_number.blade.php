<div class="modal fade" id="add_number" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar número</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <input type="text" name="tag" placeholder="Etiqueta" class="form-control" maxlength="30" autocomplete="off" />
          </div>
          <div class="col">
            <input type="tel" name="number" placeholder="Número" class="form-control" maxlength="10" autocomplete="off" />
          </div>
        </div>
        <div id="err_message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_number_btn" name="button">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" name="button">Close</button>
      </div>
    </div>
  </div>
</div>
