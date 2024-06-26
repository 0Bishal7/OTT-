<section class="content-header">
    <h1>Welcome to <?=$CompanyName;?> Must Watch</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Must Watch</li>
    </ol>
</section>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Must Watch List</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                        Add New
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Movie Link</th>
                            <th>Time</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Is Trash</th>
                        </tr>
                    </thead>
                    <tbody id="must_watch">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Add Must Watch</h4>
            </div>
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <form role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="MovieLink">Movie Link</label>
                                <input type="file" class="form-control" id="MovieLink" placeholder="Upload Image">
                            </div>
                            <div class="form-group">
                                <label for="Time">Time</label>
                                <input type="text" class="form-control" id="Time" placeholder="Enter Time">
                            </div>
                            <div class="form-group">
                                <label for="Rating">Rating</label>
                                <input type="text" class="form-control" id="Rating" placeholder="Enter Rating">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitMustWatchData()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitMustWatchData(){
        var formData = new FormData();
        formData.append('movie_link', $('#MovieLink')[0].files[0]);
        formData.append('time', $('#Time').val());
        formData.append('rating', $('#Rating').val());

        const controller = "http://127.0.0.1:7452/must_watch/add";
        $.ajax({
            type: 'POST',
            url: controller,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.res === 1) {
                    alert('Data saved successfully!');
                    $('#modal-default').modal('hide');
                } else {
                    alert('Failed to save data!');
                }
                console.log(response);
            },
            error: (xhr, status, error) => {
                console.error(`Error: ${status} - ${error}`);
                alert('Error saving data!');
            }
        });
    }


  
</script>
