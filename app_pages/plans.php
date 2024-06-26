<section class="content-header">
    <h1>Welcome to <?=$CompanyName;?> Plans</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Plans</li>
    </ol>
</section>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Plans List</h3>
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
                            <th>Duration</th>
                            <th>Plan Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Is Trash</th>
                        </tr>
                    </thead>
                    <tbody id="plans">
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
                <h4 class="modal-title">Add New Plan</h4>
            </div>
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Duration">Duration</label>
                                <input type="text" class="form-control" id="Duration" placeholder="Enter Duration">
                            </div>
                            <div class="form-group">
                                <label for="PlanName">Plan Name</label>
                                <input type="text" class="form-control" id="PlanName" placeholder="Enter Plan Name">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea class="form-control" id="Description" rows="4" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Price">Price</label>
                                <input type="text" class="form-control" id="Price" placeholder="Enter Price">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitPlanData()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitPlanData(){
        var formData = new FormData();
        formData.append('duration', $('#Duration').val());
        formData.append('plan_name', $('#PlanName').val());
        formData.append('description', $('#Description').val());
        formData.append('price', $('#Price').val());

        const controller = "http://127.0.0.1:7452/plans/add";
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
