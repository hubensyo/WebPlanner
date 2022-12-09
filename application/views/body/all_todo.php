<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.css" />

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
        --bs-btn-focus-shadow-rgb: 225, 83, 97;
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
                    <br>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        Add Task
                    </button>
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div style="width: 100%; border-radius: 10px 10px 10px 10px;">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <h2 class="w3-text-black">Add Task</h2>
                                                <form action="<?= base_url('index.php/welcome/add_alltask'); ?>" method="post">
                                                    <div>
                                                        <h5>Task</h5>
                                                    </div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="task" placeholder="Task" required></div>
                                                    <div>
                                                        <h5>Student No.</h5>
                                                    </div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="student_number" placeholder="Student No." required></div>
                                                    <div>
                                                        <h5>Date Start</h5>
                                                    </div>
                                                    <div class="col-md-12 form-group"><input type="date" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="date_start" placeholder="Date Start" required></div>
                                                    <div>
                                                        <h5>Date End</h5>
                                                    </div>
                                                    <div class="col-md-12 form-group"><input type="date" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="date_end" placeholder="Date End" required></div>
                                                    <div>
                                                        <h5>Due Time</h5>
                                                    </div>
                                                    <div class="col-md-12 form-group"><input type="time" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="due_time" placeholder="Due Time" required></div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </h2>
            </div>
        </div>
        <div class="container-fluid p-3" style="color:red">
            <table id="content" class="table table-light table-bordered border-dark">
                <thead>
                    <tr class="table-active table-light border border-dark" style="color:red">
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
                    <?php
                    foreach ($todolist as $list) {
                    ?>
                        <tr>
                            <td class="border-bottom"><?= $list['task'] ?></td>
                            <td class="border-bottom"><?= $list['student_number']  ?></td>
                            <td class="border-bottom"><?= date("F j, Y", strtotime($list['date_start']))  ?></td>
                            <td class="border-bottom"><?= date("F j, Y", strtotime($list['date_end']))  ?></td>
                            <td class="border-bottom"><?= date("g:i a", strtotime($list['due_time']))  ?></td>
                            <td class="border-bottom"><?= $list['status']  ?></td>

                            <!-- edit section -->
                            <!-- Button trigger modal -->
                            <td class="border-bottom"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal<?= $list['id'] ?>">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal<?= $list['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title" id="exampleModalLabel" style="color: black">Edit Task</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('index.php/welcome/todoall_update/' . $list['id']); ?>" method="post">

                                                    <div style="color: black">Task</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="task" placeholder="Task" value="<?= $list['task'] ?>" required></div>

                                                    <div style="color: black">Student Number</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="student_number" placeholder="Student No." value="<?= $list['student_number'] ?>" required></div>

                                                    <div style="color: black">Date Start</div>
                                                    <div class="col-md-12 form-group"><input type="date" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="date_start" placeholder="Date Start" value="<?= $list['date_start'] ?>" required></div>

                                                    <div style="color: black">Date End</div>
                                                    <div class="col-md-12 form-group"><input type="date" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="date_end" placeholder="Date End" value="<?= $list['date_end'] ?>" required></div>

                                                    <div style="color: black">Due Time</div>
                                                    <div class="col-md-12 form-group"><input type="time" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="due_time" placeholder="Due Time" value="<?= $list['due_time'] ?>" required></div>

                                                    <!-- <div style="color: black">Status</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="status" placeholder="Status" value="<?= $list['status'] ?>" required></div> -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-bottom"><a class="btn btn-info" onclick="clickDelete('<?= $list['id']; ?>')">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#content').DataTable();
    });

    clicktodo()

    function clickDelete($id) {

        var _conf = confirm("Are you sure to delete?");
        if (_conf === true) {
            location.href = "<?= base_url('index.php/welcome/delete_todo/'); ?>" + $id
        }
    }
</script>