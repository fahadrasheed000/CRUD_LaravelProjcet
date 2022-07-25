<!--===================== ADD STUDENT MODAL =============== -->
<div id="addStudentModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-lg modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Student</h4>
            </div>
            <div class="modal-body">
                <form id="add_student_form" method="post">
                    <div class="row">
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="name">StudentID:</label>
                                <input type="text" name="student_id" data-max-length="20" class="form-control"
                                    placeholder="Enter studentID" required>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Name:</label>
                                <input type="text" name="name" data-max-length="100" class="form-control"
                                    placeholder="Enter Name" required>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Address:</label>
                                <input type="text" name="address" data-max-length="255" class="form-control"
                                    placeholder="Enter Address" required>
                            </div>

                        </div>



                        <div class=" col-md-12">
                            <div style="float:right">
                                <button type="button" class="btn btn-danger"
                                    onclick="closeAddStudentModal()">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<div id="updateStudentModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-lg modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Student</h4>
            </div>
            <div class="modal-body">
                <form id="update_student_form" method="PATCH">
                    <div class="row">
                        <input type="hidden" name="id" class="id" />
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="name">StudentID:</label>
                                <input type="text" name="student_id" data-max-length="20"
                                    class="form-control student_id" placeholder="Enter studentID" required>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Name:</label>
                                <input type="text" name="name" data-max-length="100" class="form-control name"
                                    placeholder="Enter Name" required>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Address:</label>
                                <input type="text" name="address" data-max-length="255" class="form-control address"
                                    placeholder="Enter Address" required>
                            </div>

                        </div>




                        <div class=" col-md-12">
                            <div style="float:right">
                                <button type="button" class="btn btn-danger"
                                    onclick="closeupdateStudentModal()">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
