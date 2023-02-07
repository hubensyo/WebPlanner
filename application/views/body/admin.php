<div class="card-primary mb-3" style="width: 100%; background: white	; border-radius: 10px 10px 10px 10px;">
    <div class="card-body">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Instructor
            </button>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div style="width: 100%; border-radius: 10px 10px 10px 10px;">
                                <div class="card-body">
                                    <div class="card-body">
                                        <h2 class="w3-text-black">Add Instructor</h2>
                                        <form action="<?= base_url('index.php/welcome/add_admin'); ?>" method="post">
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="name" placeholder="Name" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="program" placeholder="Program" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="email" placeholder="Email" required></div>
                                            <br>
                                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="password" placeholder="Password" required></div>
                                            <br>
                                            <div class="col-md-12 form-group">
                                                <select style="color: black; font-size: 15px; background-color:gainsboro;" name="position" class="form-select" id="color" required>
                                                    <option value="1"> Instructor</option>
                                                    <option value="2"> Admin</option>
                                                </select>
                                            </div>
                                    </div>

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
                        <th>Name</th>
                        <th>Program</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Position</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($admin as $list) {
                    ?>
                        <tr>
                            <td class="border-bottom"><?= $list['name']  ?></td>
                            <td class="border-bottom"><?= $list['program']  ?></td>
                            <td class="border-bottom"><?= $list['email']  ?></td>
                            <td class="border-bottom"><?= $list['password']  ?></td>
                            <td class="border-bottom"><?php if ($list['position'] == "1") {
                                                            echo 'Instructor';
                                                        } elseif ($list['position'] == "2") {
                                                            echo 'Admin';
                                                        } ?></td>


                            <!-- edit section -->
                            <!-- Button trigger modal -->
                            <td class="border-bottom"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal<?= $list['ID_Admin'] ?>">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal<?= $list['ID_Admin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title" id="exampleModalLabel" style="color: black">Edit Student</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('index.php/welcome/update_admin/' . $list['ID_Admin']); ?>" method="post">
                                                    <div style="color: black">Name</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="name" placeholder="Name" value="<?= $list['name'] ?>" required></div>

                                                    <div style="color: black">Program</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="program" placeholder="Program" value="<?= $list['program'] ?>" required></div>

                                                    <div style="color: black">Email</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="email" placeholder="Email" value="<?= $list['email'] ?>" required></div>

                                                    <div style="color: black">Password</div>
                                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px; background-color:gainsboro;" id="color" class="form-control" name="password" placeholder="Password" value="<?= $list['password'] ?>" required></div>

                                                    <div style="color: black">Position</div>
                                                    <div class="col-md-12 form-group"><select style="color: black; font-size: 15px; background-color:gainsboro;" name="position" class="form-select" id="color" required>
                                                            <option value="1"> Instructor</option>
                                                            <option value="2"> Admin</option>
                                                        </select></div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-bottom"><a class="btn btn-info" onclick="clickDelete('<?= $list['ID_Admin']; ?>')">Delete</a></td>
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

    clickadmin()

    function clickDelete($id) {

        var _conf = confirm("Are you sure to delete?");
        if (_conf === true) {
            location.href = "<?= base_url('index.php/welcome/delete_admin/'); ?>" + $id
        }
    }
</script>