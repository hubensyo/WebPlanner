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
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }

    body {
        height: 100%;
        width: 100%;
        font-family: sans-serif;

    }

    .btn-danger {
        --bs-btn-border-color: #fbe07e;
        background-color: #f9ce34;
        --bs-btn-bg: #fbe07e;
        --bs-btn-border-color: #fbe07e;
        --bs-btn-hover-bg: #fbe07e;
        --bs-btn-hover-border-color: #fbe07e;
        --bs-btn-focus-shadow-rgb: 225,83,97;
        --bs-btn-active-bg: #fbe07e;
        --bs-btn-active-border-color: #fbe07e;
        --bs-btn-disabled-bg: #fbe07e;
        --bs-btn-disabled-border-color: #fbe07e;
    }

    
    
</style>

<body>
    <div class="card-primary mb-3" style="width: 100%; background: white	; border-radius: 10px 10px 10px 10px;">
        <div class="card-body">
            <div class="card-body">
                <h2 class="w3-text-black">To-Do List
                    <a href="<?= base_url('index.php/welcome/back'); ?>" class="btn btn-primary">Back</a>

                    <div class="col-md-12" style="text-align:center">
                        <button type="button" id="add_button" class="btn btn-info btn-xs">Add</button>
                    </div>
                </h2>

            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Student Number</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Due Time</th>
                            <th>Status</th>
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
                        <label>Enter Task</label>
                        <input type="text" name="task" id="task" class="form-control" />
                        <span id="task_error" class="text-danger"></span>
                        <br />
                        <label>Enter Student Number</label>
                        <input type="number" name="student_number" id="student_number" class="form-control" />
                        <span id="student_number_error" class="text-danger"></span>
                        <br />
                        <label>Enter Date Start</label>
                        <input type="date" name="date_start" id="date_start" class="form-control" />
                        <span id="date_start_error" class="text-danger"></span>
                        <br />
                        <label>Enter Date End</label>
                        <input type="date" name="date_end" id="date_end" class="form-control" />
                        <span id="date_end_error" class="text-danger"></span>
                        <br />
                        <label>Enter Due Time</label>
                        <input type="time" name="due_time" id="due_time" class="form-control" />
                        <span id="due_time_error" class="text-danger"></span>
                        <br />
                        <label>Enter Status</label>
                        <input type="number" name="status" id="status" class="form-control" />
                        <span id="status_error" class="text-danger"></span>
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

</html>
<script>
    $(document).ready(function() {

        function fetch_data() {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/webtodo_api/action",
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
            $('.modal-title').text("Add Task");
            $('#action').val('Add');
            $('#data_action').val("Insert");
            $('#userModal').modal('show');
        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/webtodo_api/action",
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
                }
            })
        });

        $(document).on('click', '.edit', function() {
            let user_id = $(this).attr('id');
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/webtodo_api/action",
                method: "POST",
                data: {
                    user_id: user_id,
                    data_action: 'fetch_single'
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#userModal').modal('show');
                    $('#task').val(data.task);
                    $('#student_number').val(data.student_number);
                    $('#date_start').val(data.date_start);
                    $('#date_end').val(data.date_end);
                    $('#due_time').val(data.due_time);
                    $('#status').val(data.status);
                    $('.modal-title').text('Edit Task');
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
                    url: "<?php echo base_url(); ?>index.php/webtodo_api/action",
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
</script>