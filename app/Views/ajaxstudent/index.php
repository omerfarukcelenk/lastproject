<?php echo $this->extend('frontend/layouts/main'); ?>
<?= $this->section('style'); ?>
<style>

</style>
<?= $this->endsection(); ?>
<?= $this->section('artical'); ?>

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Full Name</label> <span id="error_name" class="text-danger ms-3"></span>
                    <input type="text" class="form-control" id="name" placeholder="Enter your Full Name">
                </div>
                <div class="form-group">
                    <label>Email</label> <span id="error_email" class="text-danger ms-3"></span>
                    <input type="email" class="form-control " id="email" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                    <label>Phone Number</label> <span id="error_phone" class="text-danger ms-3"></span>
                    <input type="number" class="form-control " id="phone" placeholder="Enter your phone number">
                </div>
                <div class="form-group">
                    <label>Course</label> <span id="error_course" class="text-danger ms-3"></span>
                    <input type="text" class="form-control " id="course" placeholder="Enter your Course Name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ajaxstudent-save">Add</button>
            </div>
        </div>
    </div>
</div>


<!-- Student View Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student View</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4> ID : <span id="id_view"></span></h4>
                <h4> Name : <span id="name_view"></span></h4>
                <h4> Email : <span id="email_view"></span></h4>
                <h4> Phone : <span id="phone_view"></span></h4>
                <h4> Course : <span id="course_view"></span></h4>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Student Edit Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input hidden id="edit_id">
                <div class="form-group">
                    <label>Full Name</label> <span id="error_name" class="text-danger ms-3"></span>
                    <input type="text" class="form-control" id="edit_name" placeholder="Enter your Full Name">
                </div>
                <div class="form-group">
                    <label>Email</label> <span id="error_email" class="text-danger ms-3"></span>
                    <input type="email" class="form-control " id="edit_email" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                    <label>Phone Number</label> <span id="error_phone" class="text-danger ms-3"></span>
                    <input type="number" class="form-control " id="edit_phone" placeholder="Enter your phone number">
                </div>
                <div class="form-group">
                    <label>Course</label> <span id="error_course" class="text-danger ms-3"></span>
                    <input type="text" class="form-control " id="edit_course" placeholder="Enter your Course Name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ajaxstudent-update">Edit</button>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 my-4">
            <h1 class="text-center">JQUERY AJAX CRUD</h1>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jquery Ajax CRUD - Student DATA
                        <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal"
                           data-bs-target="#studentModal">Add</a>
                    </h4>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="studentdata">

                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
<?= $this->endsection(); ?>

<?= $this->section('jquery'); ?>

<script>

    $(document).ready(function () {
        loadstudent();

        $(document).on('click', '#view_btn', function () {
            var stud_id = $(this).closest('tr').find('.stud_id').text();
            // alert(stud_id);
            $.ajax({
                type: "POST",
                url: "<?=base_url('ajax-student/view')?>",
                data: {
                    'stud_id': stud_id,
                },
                success: function (response) {
                    // console.log(response);
                    $.each(response, function (key, value) {
                        // console.log(value['name']);
                        $('#id_view').text(value['id']);
                        $('#name_view').text(value['name']);
                        $('#email_view').text(value['email']);
                        $('#phone_view').text(value['phone']);
                        $('#course_view').text(value['course']);
                        $('#studentViewModal').modal('show');
                    });
                }
            });


        });

        $(document).on('click', '#edit_btn', function () {
            var stud_id = $(this).closest('tr').find('.stud_id').text();

            $.ajax({
                type: "POST",
                url: "<?=base_url('ajax-student/edit')?>",
                data: {
                    'stud_id': stud_id,
                },
                success: function (response) {
                    // console.log(response);
                    $.each(response, function (key, studentValue) {
                        $('#edit_id').val(studentValue['id']);
                        $('#edit_name').val(studentValue['name']);
                        $('#edit_email').val(studentValue['email']);
                        $('#edit_phone').val(studentValue['phone']);
                        $('#edit_course').val(studentValue['course']);
                        $('#studentEditModal').modal('show');
                    });
                }
            });
        });

        $(document).on('click', '#ajaxstudent-update', function (){
            var data = {
                'id': $('#edit_id').val(),
                'name': $('#edit_name').val(),
                'email': $('#edit_email').val(),
                'phone': $('#edit_phone').val(),
                'course': $('#edit_course').val(),

            };


            $.ajax({
                type:"POST",
                url:"<?=base_url('ajax-student/update')?>",
                data: data,
                success: function (response){
                    $('#studentEditModal').modal('hide');
                    $('#studentEditModal').find('input').val('');

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.status,
                        showConfirmButton: true,
                        timer: 500
                    });
                    setInterval(function () {
                        location.reload(true);
                    }, 700);
                }
            })
        });

        $(document).on('click', '#delete_btn', function () {
            var stud_id = $(this).closest('tr').find('.stud_id').text();

            $.ajax({
                type: "POST",
                url: "<?=base_url('ajax-student/delete')?>",
                data: {
                    'stud_id': stud_id,
                },
                success: function (response){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.status,
                        showConfirmButton: true,
                        timer: 500
                    });
                    setInterval(function () {
                        location.reload(true);
                    }, 700);
                }

            });
        });
    });

    function loadstudent() {
        $.ajax({
            type: "GET",
            url: "<?=base_url('ajax-student/getdata')?>",
            success: function (response) {
                // console.log(response.students);
                $.each(response.students, function (key, value) {
                    $('#studentdata').append(
                        '<tr>\
                        <td class="stud_id">' + value['id'] + '</td>\
                        <td>' + value['name'] + '</td>\
                        <td>' + value['email'] + '</td>\
                        <td>' + value['phone'] + '</td>\
                        <td>' + value['course'] + '</td>\
                        <td>' + value['created_at'] + '</td>\
                        <td>\
                         <a href="#" class="badge btn-info" id="view_btn">VIEW</a>\
                         <a href="#" class="badge btn-success" id="edit_btn">EDIT</a>\
                         <a href="#" class="badge btn-danger" id="delete_btn">DELETE</a>\
                        </td>\
                        </tr>');
                });


            }
        });
    }
</script>


<script>
    $(document).ready(function () {
        // alert("test");
        $(document).on('click', '#ajaxstudent-save', function () {
            if ($.trim($('#name').val()).length == 0) {
                error_name = "Please Enter Full name";
                $('#error_name').text(error_name);
            } else {
                error_name = "";
                $('#error_name').text(error_name);
            }

            if ($.trim($('#email').val()).length == 0) {
                error_email = "Please Enter your email";
                $('#error_email').text(error_email);
            } else {
                error_email = "";
                $('#error_email').text(error_email);
            }

            if ($.trim($('#phone').val()).length == 0) {
                error_phone = "Please Enter your phone";
                $('#error_phone').text(error_phone);
            } else {
                error_phone = "";
                $('#error_phone').text(error_phone);
            }

            if ($.trim($('#course').val()).length == 0) {
                error_course = "Please Enter Course name";
                $('#error_course').text(error_course);
            } else {
                error_course = "";
                $('#error_course').text(error_course);
            }

            if (error_name != '' || error_email != '' || error_phone != '' || error_course != '') {
                return false;
            } else {
                const mydata = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'phone': $('#phone').val(),
                    'course': $('#course').val()

                };
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('ajax-student/store')?>",
                    data: mydata,
                    success: function (response) {
                        console.log(response)
                        $('#studentModal').modal('hide');
                        $('#studentModal').find('input').val('');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.status,
                            showConfirmButton: true,
                            timer: 1800
                        });
                        setInterval(function () {
                            location.reload(true);
                        }, 2000);


                    }
                });
            }
        });
    });
</script>
<?= $this->endsection(); ?>


