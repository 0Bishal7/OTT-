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
                <h3 class="box-title">Movie Information</h3>
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
                            <th>Released Year</th>
                            <th>Language</th>
                            <th>Rating</th>
                            <th>Genres</th>
                            <th>Director</th>
                            <th>Music</th>
                            <th>Status</th>
                            <th>Trash</th>
                        </tr>
                    </thead>
                    <tbody id="movie_info">
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
                    <h4 class="modal-title">Add New Movie Information</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Released">Released Year</label>
                                <input type="number" class="form-control" id="Released" placeholder="Enter Released Year">
                            </div>
                            <div class="form-group">
                                <label for="Language">Language</label>
                                <input type="text" class="form-control" id="Language" placeholder="Enter Language">
                            </div>
                            <div class="form-group">
                                <label for="Rating">Rating</label>
                                <input type="text" class="form-control" id="Rating" placeholder="Enter Rating">
                            </div>
                            <div class="form-group">
                                <label for="Genres">Genres</label>
                                <input type="text" class="form-control" id="Genres" placeholder="Enter Genres">
                            </div>
                            <div class="form-group">
                                <label for="Director">Director</label>
                                <input type="text" class="form-control" id="Director" placeholder="Enter Director">
                            </div>
                            <div class="form-group">
                                <label for="Music">Music</label>
                                <input type="text" class="form-control" id="Music" placeholder="Enter Music">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitMovieInfoData()">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</section>

<script>
   

    function submitMovieInfoData() {
        var released = $('#Released').val();
        var language = $('#Language').val();
        var rating = $('#Rating').val();
        var genres = $('#Genres').val();
        var director = $('#Director').val();
        var music = $('#Music').val();

        const controller = "http://127.0.0.1:7452/movie_info/add";
        $.ajax({
            type: 'POST',
            url: controller,
            data: {
                released: released,
                language: language,
                rating: rating,
                genres: genres,
                director: director,
                music: music
            },
            success: (response) => {
                if (response.res === 1) {
                    alert('Data saved successfully!');
                    $('#modal-default').modal('hide');
                    movieInfo(); // Refresh the table after adding a new record
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
