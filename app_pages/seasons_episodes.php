<section class="content-header">
    <h1>Welcome to <?=$CompanyName;?> Seasons and Episodes</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Seasons and Episodes</li>
    </ol>
</section>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Seasons and Episodes List</h3>
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
                            <th>Season No</th>
                            <th>Total Episodes</th>
                            <th>Episode No</th>
                            <th>Movie Link</th>
                            <th>Movie Title</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Is Trash</th>
                        </tr>
                    </thead>
                    <tbody id="seasons_episodes">
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
                <h4 class="modal-title">Add New Season Episode</h4>
            </div>
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <form role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="SeasonNo">Season No</label>
                                <input type="text" class="form-control" id="SeasonNo" placeholder="Enter Season No">
                            </div>
                            <div class="form-group">
                                <label for="TotalEpisodes">Total Episodes</label>
                                <input type="text" class="form-control" id="TotalEpisodes" placeholder="Enter Total Episodes">
                            </div>
                            <div class="form-group">
                                <label for="EpisodeNo">Episode No</label>
                                <input type="text" class="form-control" id="EpisodeNo" placeholder="Enter Episode No">
                            </div>
                            <div class="form-group">
                                <label for="MovieLink">Movie Link</label>
                                <input type="file" class="form-control" id="MovieLink" placeholder="Upload Image">
                            </div>
                            <div class="form-group">
                                <label for="MovieTitle">Movie Title</label>
                                <input type="text" class="form-control" id="MovieTitle" placeholder="Enter Movie Title">
                            </div>
                            <div class="form-group">
                                <label for="Duration">Duration</label>
                                <input type="text" class="form-control" id="Duration" placeholder="Enter Duration">
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
                <button type="button" class="btn btn-primary" onclick="submitSeasonEpisodeData()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitSeasonEpisodeData(){
        var formData = new FormData();
        formData.append('season_no', $('#SeasonNo').val());
        formData.append('total_episodes', $('#TotalEpisodes').val());
        formData.append('episode_no', $('#EpisodeNo').val());
        formData.append('movie_link', $('#MovieLink')[0].files[0]);
        formData.append('movie_title', $('#MovieTitle').val());
        formData.append('duration', $('#Duration').val());
        formData.append('description', $('#Description').val());

        const controller = "http://127.0.0.1:7452/seasons_episodes/add";
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
