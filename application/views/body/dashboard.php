<div class="card-primary mb-3" style="width: 100%; background: white	; border-radius: 10px 10px 10px 10px;">
    <div class="card-body">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Students
            </button>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div style="width: 100%; border-radius: 10px 10px 10px 10px;">
                                <div class="card-body">
                                    <div class="card-body">
                                        <h2 class="w3-text-black">Add Students</h2>
                                        <form action="<?= base_url('index.php/welcome/add_students'); ?>" method="post">
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="student_number" placeholder="Student No." required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="first_name" placeholder="First Name" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="middle_name" placeholder="Middle Name" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="last_name" placeholder="Last Name" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="program" placeholder="Program" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="email" placeholder="Email" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="password" placeholder="Password" required></div>

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
            <div class="container-fluid p-3" style="color:red">
                <table id="content" class="table table-light table-bordered border-dark">
                    <thead>
                        <tr class="table-active table-light border border-dark" style="color:red">
                            <th>Student No.</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Program</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>To-Do List</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($content as $list) {
                        ?>
                            <tr>
                                <td class="border-bottom"><?= $list['student_number'] ?></td>
                                <td class="border-bottom"><?= $list['first_name']  ?></td>
                                <td class="border-bottom"><?= $list['middle_name']  ?></td>
                                <td class="border-bottom"><?= $list['last_name']  ?></td>
                                <td class="border-bottom"><?= $list['program']  ?></td>
                                <td class="border-bottom"><?= $list['email']  ?></td>
                                <td class="border-bottom"><?= $list['password']  ?></td>

                                <!-- view to-do section -->
                                <td class="border-bottom"><a href="<?= base_url('index.php/welcome/todo/'. $list['student_number']);  ?>" class="btn btn-info">View</a></td>


                                <!-- edit section -->
                                <!-- Button trigger modal -->
                                <td class="border-bottom"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal<?= $list['student_number'] ?>">
                                        Edit
                                    </button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal<?= $list['student_number'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="exampleModalLabel" style="color: black">Edit Student</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <input type="hidden" value=<?= $list['student_number'] ?> name="studentModalID" id="studentModalID">
                                                <div class="modal-body">
                                                    <form action="<?= base_url('index.php/welcome/update_students/' . $list['student_number']); ?>" method="post">
                                                        <div style="color: black">Student No.</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="student_number" placeholder="Student No." value="<?= $list['student_number'] ?>" required></div>

                                                        <div style="color: black">First Name</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="first_name" placeholder="Name" value="<?= $list['first_name'] ?>" required></div>

                                                        <div style="color: black">Middle Name</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="middle_name" placeholder="Name" value="<?= $list['middle_name'] ?>" required></div>

                                                        <div style="color: black">Last Name</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="last_name" placeholder="Name" value="<?= $list['last_name'] ?>" required></div>

                                                        <div style="color: black">Program</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="program" placeholder="Program" value="<?= $list['program'] ?>" required></div>

                                                        <div style="color: black">Email</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="email" placeholder="Email" value="<?= $list['email'] ?>" required></div>

                                                        <div style="color: black">Password</div>
                                                        <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="password" placeholder="Password" value="<?= $list['password'] ?>" required></div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-bottom"><a class="btn btn-info" onclick="clickDelete('<?= $list['student_number']; ?>')">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#content').DataTable();
    });

    clickstudentlist()

    function clickDelete($id) {
        
        var _conf = confirm("Are you sure to deletet?");
        if (_conf === true) {
            location.href = "<?= base_url('index.php/welcome/delete/'); ?>" + $id 
        }
    }
</script>