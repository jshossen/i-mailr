<!-- Modal -->
<div id="import_subscriber" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo BASE;?>/subscribers/?process=import_subscribers" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Import subscribers</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>CSV file format:</p>
          <img src="<?php echo BASE; ?>/files/images/csv_format.png" style="max-width: 100%;">
          <?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 
            Choose your .csv file: <br /> 
            <input name="csv" type="file" id="csv" /> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form> 
    </div>
  </div>
</div>