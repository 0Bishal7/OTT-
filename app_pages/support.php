<section class="content-header">
    <h1>Support Messages</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Support</li>
    </ol>
</section>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Support Messages List</h3>
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Is Trash</th>
                        </tr>
                    </thead>
                    <tbody id="support">
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
                <h4 class="modal-title">Add New Support Message</h4>
            </div>
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <form role="form" id="supportForm">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="FirstName">First Name</label>
                                <input type="text" class="form-control" id="FirstName" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="LastName">Last Name</label>
                                <input type="text" class="form-control" id="LastName" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="PhoneNo">Phone No</label>
                                <input type="text" class="form-control" id="PhoneNo" placeholder="Enter Phone No">
                            </div>
                            <div class="form-group">
                                <label for="Message">Message</label>
                                <textarea class="form-control" id="Message" rows="4" placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitSupportData()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitSupportData(){
        var formData = {
            'first_name': $('#FirstName').val(),
            'last_name': $('#LastName').val(),
            'email': $('#Email').val(),
            'phone_no': $('#PhoneNo').val(),
            'message': $('#Message').val()
        };

        const controller = "http://127.0.0.1:7452/support/add";
        $.ajax({
            type: 'POST',
            url: controller,
            data: formData,
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
