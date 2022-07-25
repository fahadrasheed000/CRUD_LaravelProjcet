<x-header />

<section class="main">
    <div class="row">
        <div class="col-sm-12">
            <center><h1>{{env('APP_NAME')}}</h1></center>
            <hr>
            <div class="card">
                <div class="card-header search-tag">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control student_no" placeholder="Search by studentID" />
                        </div>

                        <div class="col-md-3">
                            <button type="button" onclick="apply()" class="btn btn-primary"><i
                                    class="fa fa-search"></i>&nbsp;Apply</button>&nbsp;&nbsp;
                            <button type="button" onclick="resetData()" class="btn btn-danger"><i
                                    class="fa fa-close"></i>&nbsp;Reset</button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="card-header">

                    <a href="#addStudentModal" style="color:white" class="btn btn-primary pull-right"
                        data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Add New Student</a>

                </div>
                <div class="card-block">
               
                        <table id="studentsTable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>StudentID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>

                        </table>
                    
                </div>
            </div>
        </div>


    </div>

</section>

<x-footer />
@include('includes.modals.students_modal')
@include('includes.js_scripts.students_js')
