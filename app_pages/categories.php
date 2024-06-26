<section class="content-header">
    <h1>
        Categories Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categories</li>
    </ol>
</section>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categories Table</h3>
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
                            <th>Movie Link 1</th>
                            <th>Movie Link 2</th>
                            <th>Movie Link 3</th>
                            <th>Movie Link 4</th>
                            <th>Movie Type</th>
                            <th>Status</th>
                            <th>Is Trash</th>
                        </tr>
                    </thead>
                    <tbody id="categories">
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
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Category</h4>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="MovieType">Movie Type</label>
                            <input type="text" class="form-control" id="MovieType" placeholder="Enter Movie Type">
                        </div>
                        <div class="form-group">
                            <label for="MovieLink1">Movie Link 1</label>
                            <input type="file" class="form-control" id="MovieLink1" placeholder="Upload Movie Link 1">
                        </div>
                        <div class="form-group">
                            <label for="MovieLink2">Movie Link 2</label>
                            <input type="file" class="form-control" id="MovieLink2" placeholder="Upload Movie Link 2">
                        </div>
                        <div class="form-group">
                            <label for="MovieLink3">Movie Link 3</label>
                            <input type="file" class="form-control" id="MovieLink3" placeholder="Upload Movie Link 3">
                        </div>
                        <div class="form-group">
                            <label for="MovieLink4">Movie Link 4</label>
                            <input type="file" class="form-control" id="MovieLink4" placeholder="Upload Movie Link 4">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitCategoryData()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
function submitCategoryData(){
    var formData = new FormData();
    formData.append('movie_type', $('#MovieType').val());
    formData.append('movie_link1', $('#MovieLink1')[0].files[0]);
    formData.append('movie_link2', $('#MovieLink2')[0].files[0]);
    formData.append('movie_link3', $('#MovieLink3')[0].files[0]);
    formData.append('movie_link4', $('#MovieLink4')[0].files[0]);

    const controller = "http://127.0.0.1:7452/categories/add";
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
                fetchCategories(); // Reload categories
            } else {
                alert('Failed to save data!');
            }
        },
        error: (xhr, status, error) => {
            console.error(`Error: ${status} - ${error}`);
            alert('Error saving data!');
        }
    });
}

</script>
