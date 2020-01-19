<div id="group_list_modal_for_add_sibscriber" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add subscriber to a group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Select a group</label>
            <select class="form-control select_group_list" id="selected_group_list">
            </select>
        </div>
        <div>
          or <a class="btn btn-link" data-toggle="modal" data-target="#create_groups" data-dismiss="modal"><i class="fa fa-plus" aria-hidden="true"></i> Creat a new group</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add_this_subscriber_to_a_group();">Add</button>
      </div>
    </div>
  </div>
</div>