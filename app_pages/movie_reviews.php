<section class="content-header">
    <h1>Welcome to <?=$CompanyName;?> Movie Reviews</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Movie Reviews</li>
    </ol>
</section>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Movie Reviews</h3>
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
                            <th>Name</th>
                            <th>Country</th>
                            <th>Rating</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Is Trash</th>
                        </tr>
                    </thead>
                    <tbody id="movie_reviews">
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
                <h4 class="modal-title">Add Movie Review</h4>
            </div>
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="Name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <input type="text" class="form-control" id="Country" placeholder="Enter Country">
                            </div>
                            <div class="form-group">
                                <label for="Rating">Rating</label>
                                <input type="text" class="form-control" id="Rating" placeholder="Enter Rating">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea class="form-control" id="Description" rows="4" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitReviewData()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitReviewData(){
        var formData = new FormData();
        formData.append('name', $('#Name').val());
        formData.append('country', $('#Country').val());
        formData.append('rating', $('#Rating').val());
        formData.append('description', $('#Description').val());

        const controller = "http://127.0.0.1:7452/movie_reviews/add";
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
