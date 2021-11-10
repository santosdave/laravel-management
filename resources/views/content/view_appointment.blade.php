
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Appointment</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">Add New</button>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Appointment list</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">

                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Client Name</th>
                        <th>Client Phone</th>
                        <th>Therapist Name</th>
                        <th>Schedule</th>
                        <th>Status</th>
                        <th>Action
                          <form method="get" id="success" action="{{url('appointment.success')}}">
                            <input type="hidden" readonly name="status" id="status">
                            <button id="success" type="submit" hidden></button>
                          </form>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($appointments as $appointment)
                      <tr>
                        <td>{{$appointment->app_sl}}</td>
                        <td>@php $patient=collect($patients)->where('out_p_id',$appointment->app_p_id)->first() @endphp
                          {{$patient->out_p_name}}
                        </td>
                        <td>{{$patient->out_p_phone}}</td>
                        <td>@php $therapy=collect($therapys)->where('doc_id',$appointment->app_doc_id)->first() @endphp
                          {{$therapy->doc_name}}</td>
                        <td>{{$appointment->app_date}}</td>
                        <td>@if($appointment->app_status=='Pending')
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                              Pending
                            </button>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" id="status" data="Approved" get_id="{{$appointment->app_id}}">Approved</button>
                              <button class="dropdown-item" id="status" data="Cancel" get_id="{{$appointment->app_id}}">Cancel</button>
                            </div>
                          </div>

                          @elseif($appointment->app_status=='Approved')
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                              Approved
                            </button>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" id="status" data="Pending" get_id="{{$appointment->app_id}}">Pending</button>
                              <button class="dropdown-item" id="status" data="Cancel" get_id="{{$appointment->app_id}}">Cancel</button>
                            </div>
                          </div>
                          @else
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">
                              Cancel
                            </button>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" id="status" data="Pending" get_id="{{$appointment->app_id}}">Pending</button>
                              <button class="dropdown-item" id="status" data="Approved" get_id="{{$appointment->app_id}}">Approved</button>
                            </div>
                          </div>
                          @endif
                        </td>
                        <td>
                          <button class='show btn btn-outline-primary btn-sm' data-toggle='modal' data-target='#showModal' data="{{$appointment->app_id}}"><i class="fa fa-eye"></i></button>
                          <button class="btn btn-outline-danger btn-sm delete" data="{{$appointment->app_id}}"><i class="fa fa-trash-alt"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Insert Modal -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form id="form" method="post">
      <div class="modal-content">
      <div class="modal-header" style="background-color:  #808080; height: 60px;">
	               	<h5 class="modal-title" style="color: white;">Appointment</h5>
	             	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	               	<span aria-hidden="true" style="color: white;">&times;</span></button>
	           	</div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-8">
              <div class="col-md-12">
                <div class="form-group col-md-12">
                  <label for="app_p_id"><b>Client</b></label>
                  <div>
                    <select class="form-control" id="app_p_id" name="app_p_id">
                      <option selected hidden>-----Choose Client-----</option>
                      @foreach($patients as $patient)
                      <option value="{{$patient->out_p_id}}">{{$patient->out_p_name}} ({{$patient->out_p_s}})</option>
                      @endforeach
                    </select>
                    <span id="app_patient"></span>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group col-md-6">
                  <label for="p_age"><b>Age</b></label>
                  <div>
                    <input type="text" readonly class="form-control" id="p_age" placeholder="Age" />
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label for="p_phone"><b>Phone</b></label>
                  <div>
                    <input class="form-control" readonly type="text" id="p_phone" placeholder="Phone" />
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group col-md-12">
                  <label for="app_message"><b>Message</b></label>
                  <div>
                    <textarea rows="2" class="form-control" id="app_message" placeholder="Message" name="app_message"></textarea>
                    <span id="app_message_error"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4" style="background: #f4f4f4;">
              <div class="form-group col-md-12">
                <label for="app_date"><b>Appointment Date</b></label>
                <div>
                  <input class="form-control" id="app_date" placeholder="Appointment Date" name="app_date" />
                  <span id="app_date_error"></span>
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="app_doc_id"><b>Therapist</b></label>
                <div>
                  <select class="form-control" id="app_doc_id" name="app_doc_id">
                    <option selected hidden>-----Choose Therapist-----</option>
                    @foreach($therapys as $value)
                    <option value="{{$value->doc_id}}">{{$value->doc_name}}</option>
                    @endforeach
                  </select>
                  <span id="app_doc_id_error"></span>
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="app_status"><b>Status</b></label>
                <div>
                  <select class="form-control" id="app_status" name="app_status">
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Cancel">Cancel</option>
                  </select>
                  <span id="app_status_error"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- SHOW MODAL -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header" style="background-color:  #808080; height: 60px;">
	               	<h5 class="modal-title" style="color: white;">Appointment</h5>
	             	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	               	<span aria-hidden="true" style="color: white;">&times;</span></button>
	           	</div>
      <div class="modal-body">
        <div>
          <h6 style="display:inline"><b>Appointment Date:</b></h6>
          <p style="display:inline" id="s_app_date"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Appointment SL:</b></h6>
          <p style="display:inline" id="s_app_sl"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Client:</b></h6>
          <p style="display:inline" id="s_c_name"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Client Phone:</b></h6>
          <p id="s_c_phone" style="display:inline"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Client Age:</b></h6>
          <p id="s_c_age" style="display:inline"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Therapist:</b></h6>
          <p id="s_doc_name" style="display:inline"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Therapist Phone:</b></h6>
          <p id="s_doc_phone" style="display:inline"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Appointment Status:</b></h6>
          <p id="s_app_status" style="display:inline"></p>
        </div>
        <div>
          <h6 style="display:inline"><b>Appointment Note:</b></h6>
          <p id="s_app_note" style="display:inline"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


@section('script')
<script type="text/javascript">
  $(document).ready(function() {

    $(document).on("change", "#app_c_id", function() {
      var app_p_id = $(this).val();
      $.ajax({
        url: "{{url('appointment')}}" + "/client/" + app_p_id,
        type: 'get',
        dataType: "json",
        success: function(data) {
          $("#p_phone").val(data.out_p_phone);
          $("#p_age").val(data.out_p_age);
        }
      });
    });


    $(document).on("submit", "#form", function(e) {
      e.preventDefault();
      var data = $(this).serializeArray();

      $.ajax({
        url: "{{route('appointment.store')}}",
        data: data,
        type: "post",
        dataType: "json",
        success: function(data) {
          $('#status').val('Inserted');
          $('#success').submit();
        },
        error: function(errors) {
          let error = JSON.parse(errors.responseText).errors;
          $.each(error, function(i, message) {
            $("#" + i + "_error").html('<span class="help-block" style="color:red;">' + message + '</span>');
          });
        }
      });
    });

    $(document).on("click", ".delete", function() {
      var data = $(this).attr("data");

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: "/appointment/" + data,
              type: "delete",
              dataType: "json",
              success: function(data) {
                if (data.status == 200) {
                  $('#status').val('Deleted');
                  $('#success').submit();
                } else {
                  toastr["error"]("Something Went Wrong");
                }
              }
            });
          } else {
            swal("Your Data is safe!");
          }
        });
    });

    $(document).on('click', '#status', function() {
      var id = $(this).attr("get_id");
      var status = $(this).attr("data");
      $.ajax({
        url: "{{url('appointment.update')}}",
        type: "get",
        data: {
          id: id,
          status: status
        },
        dataType: "json",
        success: function(data) {
          $('#success').submit();
        }
      });
    });

    $(document).on('click', '.show', function() {
      var id = $(this).attr("data");
      $.ajax({
        url: "{{url('appointment.show')}}",
        type: 'get',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(data) {
          $("#s_app_date").text(data.appointment.app_date);
          $("#s_app_sl").text(data.appointment.app_sl);
          $("#s_c_name").text(data.client.c_name);
          $("#s_c_phone").text(data.client.c_phone);
          $("#s_c_age").text(data.client.c_age);
          $("#s_ther_name").text(data.therapist.ther_name);
          $("#s_ther_phone").text(data.therapist.ther_phone);
          $("#s_app_status").text(data.appointment.app_status);
          $("#s_app_note").text(data.appointment.app_message);
        }
      });
    });

  });


  $("#example").dataTable();

  jQuery(function($) {
    $("#app_date").datetimepicker({
      dateFormat: 'yy-mm-dd',
    });
  });
</script>
@endsection