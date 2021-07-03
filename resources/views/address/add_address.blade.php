<div class="modal fade" id="add_address" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="address" placeholder="Dirección" class="form-control" maxlength="100" />
        <div id="err_message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_address_btn" name="button">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" name="button">Close</button>
      </div>
    </div>
  </div>
</div>
