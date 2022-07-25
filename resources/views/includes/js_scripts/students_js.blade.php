<script>
    var studentTable;
    $(document).ready(function() {

        fillStudentDataTable();
    });
//Load data from db via ajax datatable
    function fillStudentDataTable() {
        var student_id = $('.student_no').val();
        studentTable = $('#studentsTable').DataTable({
            lengthMenu: [[-1],['All']],
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [0, 1, 2, 3, 4]
            }],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('students.get_filtered_data') }}",
                dataType: "json",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    student_id: student_id
                }
            },
        });

    }

    function apply() {
        studentTable.destroy();
        fillStudentDataTable();
    }

    //===========Student Add/Edit Form Validation===========
    var studentValidator = $('#add_student_form').validate({

        rules: {
            student_id: {
                required: true,
                maxlength: 20
            },
            name: {
                required: true,
                maxlength: 100
            },
            address: {
                required: true,
                maxlength: 255
            },



        },
        // Specify validation error messages
        messages: {
            student_id: {
                required: "Please enter studentID",
                maxlength: "studenID must be less than 20 characters"
            },
            name: {
                required: "Please enter name",
                maxlength: "Name must be less than 100 characters"
            },
            address: {
                required: "Please enter address",
                maxlength: "Address must be less than 255 characters"
            },


        },
        submitHandler: function(form) {
            var url = "{{ route('students.store') }}";
            $.ajax({
                url: url,
                type: form.method,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status == 0) {
                        swal(response.message);
                        closeAddStudentModal();
                        reloadDataTable()

                    } else if (response.status == 1) {
                        swal(response.message);

                    }
                },
                error: function(xhr, status, error) {
                    swal(error, JSON.stringify(xhr.responseJSON));
                }
            });
        }
    });

    var studentUpdateValidator = $('#update_student_form').validate({
        rules: {
            student_id: {
                required: true,
                maxlength: 20
            },
            name: {
                required: true,
                maxlength: 100
            },
            address: {
                required: true,
                maxlength: 255
            },



        },
        // Specify validation error messages
        messages: {
            student_id: {
                required: "Please enter studentID",
                maxlength: "studenID must be less than 20 characters"
            },
            name: {
                required: "Please enter name",
                maxlength: "Name must be less than 100 characters"
            },
            address: {
                required: "Please enter address",
                maxlength: "Address must be less than 255 characters"
            },

        },
        submitHandler: function(form) {
            var id = $('.id').val();
            var url = "/students/" + id;
            $.ajax({
                url: url,
                type: 'PATCH',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status == 0) {
                        swal(response.message);
                        closeupdateStudentModal();
                        reloadDataTable()

                    } else if (response.status == 1) {
                        swal(response.message);

                    }
                },
                error: function(xhr, status, error) {
                    responseText = jQuery.parseJSON(xhr.responseText);
                    console.log(responseText.message);
                    swal(error,responseText.message);
                }
            });
        }
    });
    //close add model and refresh form
    function closeAddStudentModal() {
        studentValidator.resetForm();
        $('#add_student_form').trigger("reset");
        $('#addStudentModal').modal('hide');
    }
    //close update model and refresh form
    function closeupdateStudentModal() {
        studentUpdateValidator.resetForm();
        $('#update_student_form').trigger("reset");
        $('#updateStudentModal').modal('hide');
    }
    //refresh ajax Datatable
    function reloadDataTable() {
        $('#studentsTable').DataTable().ajax.reload();
    }
    //delete student data from db by sending ajax request
    function deleteStudent(id) {

        swal({
                title: "Are you sure?",
                text: "you want to delete this Student.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "students/" + id,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        data: {
                            "id": id
                        },
                        success: function(response) {
                            if (response.status == 0) {
                                swal(response.message);
                                reloadDataTable()

                            } else if (response.status == 1) {
                                swal(response.message);

                            }
                        },
                        error: function(xhr, status, error) {
                            swal(error, JSON.stringify(xhr.responseJSON));
                        }
                    });
                } else {
                    swal.close();
                }
            });
    }
    //reset filters
    function resetData() {
        $('.student_no').val('');
        apply();
    }
    //get student data from db by sending ajax request
    function getStudentData(id) {

        var url = "/students/" + id + "/edit";
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.id').val(response[0].id);
                $('.name').val(response[0].name);
                $('.student_id').val(response[0].student_id);
                $('.address').val(response[0].address);
                $('#updateStudentModal').modal('show');
            },
            error: function(xhr, status, error) {
                swal(xhr, "error");
            }
        });
    }
</script>
