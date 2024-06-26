<section class="content-header">
    <h1>Welcome to <?=$CompanyName;?> Support</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Movie Cast</h3>
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
                            <th>Cast Image</th>
                            <th>Status</th>
                            <th>Trash</th>
                        </tr>
                    </thead>
                    <tbody id="movie_cast">
                        <!-- Data will be populated dynamically using JavaScript -->
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Movie Cast</h4>
                </div>
                <div class="modal-body">
                    <form role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="CastImage">Cast Image</label>
                                <input type="file" class="form-control" id="CastImage" placeholder="Upload Image">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitMovieCastData()">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</section>

<script>
    function submitMovieCastData() {
        var formData = new FormData();
        formData.append('cast_image', $('#CastImage')[0].files[0]);

        const controller = "http://127.0.0.1:7452/movie_cast/add";
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
                    movieCast(); // Refresh the table after adding a new record
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
