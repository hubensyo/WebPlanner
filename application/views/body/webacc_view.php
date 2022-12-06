<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <br />
        <h3 style="text-align:center">User Registration Database</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-1">
                        <h3 class="panel-title">Users</h3>
                    </div>
                    <div class="col">
                        <button type="button" id="add_button" class="btn btn-info">Add</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Program</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="userModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" id="user_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <label>Enter First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" />
                        <span id="first_name_error" class="text-danger"></span>
                        <br />
                        <label>Enter Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" />
                        <span id="last_name_error" class="text-danger"></span>
                        <br />
                        <label>Enter Student Number</label>
                        <input type="number" name="student_number" id="student_number" class="form-control" />
                        <span id="student_number_error" class="text-danger"></span>
                        <br />
                        <label>Enter Program</label>
                        <input type="text" name="program" id="program" class="form-control" />
                        <span id="program_error" class="text-danger"></span>
                        <br />
                        <label>Enter Email</label>
                        <input type="email" name="email" id="email" class="form-control" />
                        <span id="email_error" class="text-danger"></span>
                        <br />
                        <label>Enter Password</label>
                        <input type="password" name="password" id="password" class="form-control" />
                        <span id="password_error" class="text-danger"></span>
                        <br />
                        <input type="checkbox" onclick="myFunction()"> Show Password
                        <br />
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id" required />
                        <input type="hidden" name="data_action" id="data_action" value="" required />
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Add" required />
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {

        function fetch_data() {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/webacc_api/action",
                method: "POST",
                data: {
                    data_action: 'fetch_all'
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        }

        fetch_data();

        $('#add_button').click(function() {
            $('#user_form')[0].reset();
            $('.modal-title').text("Add User");
            $('#action').val('Add');
            $('#data_action').val("Insert");
            $('#userModal').modal('show');
        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/webacc_api/action",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if ($('#data_action').val() == "Insert") {
                        $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                    }
                    console.log('clicked');
                }
            })
        });

        $(document).on('click', '.edit', function() {
            let user_id = $(this).attr('id');
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/webacc_api/action",
                method: "POST",
                data: {
                    user_id: user_id,
                    data_action: 'fetch_single'
                },
                dataType: "json",
                success: function(data) {
                    $('#userModal').modal('show');
                    $('#student_number').val(data.student_number);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#program').val(data.program);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                    $('.modal-title').text('Edit User');
                    $('#user_id').val(user_id);
                    $('#action').val('Edit');
                    $('#data_action').val('Edit');
                }
            })
        });

        $(document).on('click', '.delete', function() {
            var user_id = $(this).attr('id');
            if (confirm("Are you sure you want to delete this?")) {

                console.log('clicked');
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/webacc_api/action",
                    method: "POST",
                    data: {
                        user_id: user_id,
                        data_action: 'Delete'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success) {
                            $('#success_message').html('<div class="alert alert-success">Data Deleted</div>');
                            fetch_data();
                        }
                    }
                })
            }
        });

    });

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>