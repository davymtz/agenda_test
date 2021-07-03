<div class="modal fade" id="edit_email" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edición de correo electrónico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="row">
          <div class="col">
            <input type="email" name="email" placeholder="Email" class="form-control" maxlength="80" />
          </div>
        </div>
        <div id="err_message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="edit_email_btn" name="button">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" name="button">Close</button>
      </div>
    </div>
  </div>
</div>
