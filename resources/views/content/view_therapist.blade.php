<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{$title}}</h2>
                <div class="d-flex flex-row-reverse">
                  <a href="/add_therapist">
                    <button class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder">
                      <i class="fas fa-plus"></i>Add Therapist
                    </button>
                  </a>
                  
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="tableTherapist">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th style="width:90px;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @foreach ($users as $r_users)
                                    <tr>
                                <td>{{$r_users->id}}</td>
                                <td>{{$r_users->name}}</td>
                                <td>{{$r_users->email}}</td>
                                <td>{{$r_users->level}}</td>
                                <td>
                                    <div class="btn btn-success editUser" data-id="{{$r_users->id}}">Edit</div>
                                    <div class="btn btn-danger deleteUser" data-id="{{$r_users->id}}">Delete</div>
                                </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  <!-- Modal-->
  <div class="modal fade" id="modal-user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Modal Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDepartment" name="formDepartment">
                    <div class="form-group">
  
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name"><br>
                        <input type="text" name="details" class="form-control" id="details" placeholder="Details"><br>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="saveBtn">Save changes</button>
            </div>
        </div>
    </div>
  </div>
  
  
  
  @push('scripts')
  <script>
    $('document').ready(function () {
        // success alert
        function swal_success() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1000
            })
        }
        // error alert
        function swal_error() {
            Swal.fire({
                position: 'centered',
                icon: 'error',
                title: 'Something goes wrong !',
                showConfirmButton: true,
            })
        }
        // table serverside
        var table = $('#tableTherapist').DataTable({
            processing: false,
            serverSide: true,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            ajax: "{{ route('therapist.index') }}",
            columns: [{
                    data: 'ther_name',
                    name: 'ther_name'
                },
                {
                    data: 'ther_phone',
                    name: 'ther_phone'
                },
                {
                    data: 'ther_address',
                    name: 'ther_address'
                },
                {
                    data: 'ther_email',
                    name: 'ther_email'
                },
                {
                    data: 'ther_dept_id',
                    name: 'ther_dept_id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        
        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       /*  // initialize btn add
        $('#createNewDepartment').click(function () {
            $('#saveBtn').val("create department");
            $('#dept_id').val('');
            $('#formDepartment').trigger("reset");
            $('#modal-user').modal('show');
        }); */
        // initialize btn edit
        $('body').on('click', '.editEmployee', function () {
            var emp_id = $(this).data('id');
            $.get("{{route('employee.index')}}" + '/' + emp_id + '/edit', function (data) {
                $('#saveBtn').val("edit-employee");
                $('#modal-user').modal('show');
                $('#dept_id').val(data.emp_id);
                $('#name').val(data.emp_name);
                $('#details').val(data.emp_details);
            })
        });
        // initialize btn save
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Save');
  
            $.ajax({
                data: $('#formDepartment').serialize(),
                url: "{{ route('employee.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
  
                    $('#formDepartment').trigger("reset");
                    $('#modal-user').modal('hide');
                    swal_success();
                    table.draw();
  
                },
                error: function (data) {
                    swal_error();
                    $('#saveBtn').html('Save Changes');
                }
            });
  
        });
        // initialize btn delete
        $('body').on('click', '.deleteDepartment', function () {
            var dept_id = $(this).data("id");
  
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{route('department.store')}}" + '/' + dept_id,
                        success: function (data) {
                            swal_success();
                            table.draw();
                        },
                        error: function (data) {
                            swal_error();
                        }
                    });
                }
            })
        });
  
        // statusing
  
  
    });
  
  </script>
  @endpush
  