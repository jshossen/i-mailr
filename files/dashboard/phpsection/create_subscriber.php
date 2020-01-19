<!-- Modal -->
<div id="create_subscriber" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add new subscriber</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>First name</label>
            <input class="form-control" placeholder="First name" id="input_first_name">
            <label>Last name</label>
            <input class="form-control" placeholder="Last name" id="input_last_name">
            <label>Email</label>
            <input class="form-control" placeholder="Email" id="input_email">
            <label>Phone</label>
            <input class="form-control" placeholder="phone" id="input_phone">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add_this_subscriber();">Add</button>
      </div>
    </div>
  </div>
</div>