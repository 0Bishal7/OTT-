
<section class="content-header">
      <h1>
        Welcome to <?=$CompanyName;?> Support
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
    <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Add New
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>status</th>
                    <th>is_trash</th>

                    

              
                  </tr>
                </thead>
                <tbody id="faq">
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <div class="row">
      </div>
    </section>
  



    <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
  <div class="box-body">
    <div class="form-group">
      <label for="Question">Question</label>
      <input type="text" class="form-control" id="Question" placeholder="Enter Question">
    </div>
    <div class="form-group">
      <label for="Answer">Answer</label>
      <textarea class="form-control" id="Answer" rows="4" placeholder="Enter Answer"></textarea>
    </div>
  </div>
  <!-- /.box-body -->
</form>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary" onclick="submitFAQData()">Save changes</button>
</div>
</div>

<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<script>
function submitFAQData(){
    var formData = {
        'question': $('#Question').val(),
        'answer': $('#Answer').val()
    };

    const controller = "http://127.0.0.1:7452/faq/add";
    $.ajax({
        type: 'POST',
        url: controller,
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: (response) => {
            if (response.res === 1) {
                alert('FAQ entry saved successfully!');
                $('#modal-default').modal('hide');

            } else {
                alert('Failed to save FAQ entry!');
            }
            console.log(response);
        },
        error: (xhr, status, error) => {
            console.error(`Error: ${status} - ${error}`);
            alert('Error saving FAQ entry!');
        }
    });
}
</script>
