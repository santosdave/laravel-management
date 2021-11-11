
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">

        <div class="clearfix"></div>
        <div class="card">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="">
                        <div>
                            <div class="card-header">
                                <h2>Client list</h2>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" data-toggle="modal" data-target="#myModal">
                                    <i class="fas fa-plus"></i>
                                    Add New 
                                </button>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box table-responsive">
                                        <table id="example" class="table table-striped table-bordered table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>CID</th>
                                                    <th>Name</th>
                                                    <th>Sex</th>
                                                    <th>Age</th>
                                                    <th>Phone</th>
                                                    <th>Therapist</th>
                                                    <th>Room</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0 @endphp
                                                @foreach($client as $value)
                                                <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $value->c_s }}</td>
                                                <td>{{ $value->c_name }}</td>
                                                <td>{{ $value->c_sex }}</td>
                                                <td>{{ $value->c_age }}</td>
                                                <td>{{ $value->c_phone }}</td>
                                                <td>@php $therapy= collect($therapist)->where('ther_id',$value->c_ther_id)->first() @endphp
                                                    {{$therapy->ther_name}}
                                                </td>
                                                <td>
                                                    @php $room= collect($rooms)->where('room_id',$value->c_room_id)->first() @endphp
                                                    @php $room_category = collect($room_categorys)->where('room_category_id', $value->c_room_category_id)->first() @endphp
                                                    {{ $room->room_name }} - {{$room_category->room_category_name}}
                                                </td>
                                                <td>
                                                    <button  class='show btn btn-outline-primary btn-sm' data-toggle='modal' data-target='#showModal' data="{{$value->c_id}}"><i class="fa fa-eye"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm delete" data="{{$value->c_id}}"><i class="fa fa-trash-alt"></i></button>
                                                    <form method="get" id="success" action="{{url('client.success')}}">
                                                        <input type="hidden" readonly name="status" id="status">
                                                    <button id="success" type="submit" hidden></button>
                                                    </form>
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
                           <h5 class="modal-title" style="color: white;">Add Client</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true" style="color: white;">&times;</span></button>
                       </div>
                       <div class="modal-body">
                           <div class="row">
                               <div class="col-md-8">
                                   <div class="col-md-12">
                                       <div class="form-group col-md-12">
                                        <label for="c_name"><b>Client Name</b></label>
                                        <div>
                                            <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Patient Name"/>
                                            <span id="c_name_error"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label><b>Gender</b></label>
                                        <div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radio" name="c_sex" value="Male"> Male
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="radio" name="c_sex" value="Female"> Female
                                                </label>
                                            </div>
                                            <span id="c_sex_error"></span>
                                        </div>
                                    </div>
    
                                    <div class="form-group col-md-2">
                                        <label for="c_age"><b>Age</b></label>
                                        <div>
                                            <input type="text" class="form-control" id="c_age" name="c_age" placeholder="Age"/>
                                            <span id="c_age_error"></span>
                                        </div>
                                    </div>
    
                                    <div class="form-group col-md-4">
                                        <label for="c_phone"><b>Phone</b></label>
                                        <div>
                                            <input type="text" class="form-control" id="c_phone" name="c_phone" type="text" placeholder="Phone"/>
                                            <span id="c_phone_error"></span>
                                        </div>
                                    </div>
    
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-12">
                                        <label for="c_address"><b>Address</b></label>
                                        <div>
                                            <textarea rows="1" class="form-control" id="c_address" placeholder="Address" name="c_address"></textarea>
                                            <span id="c_address_error"></span>
                                        </div>
                                    </div>
                                </div> 
    
                                <div class="form-group col-md-12">
                                    <label for="c_note"><b>Note</b></label>
                                    <div>
                                        <textarea rows="2" class="form-control" id="c_note" name="c_note" placeholder="Note"></textarea>
                                        <span id="c_note_error"></span>
                                    </div>
                                </div>
                                
                            </div>
    
                            <div class="col-md-4" style="background: #f4f4f4;">
                                <div class="form-group col-md-12">
                                    <label for="c_reference"><b>Reference</b></label>
                                    <div>
                                    <input class="form-control" id="c_reference" name="c_reference"/>
                                    <span id="c_reference_error"></span>
                                    </div>
                                </div>
    
                                <div class="form-group col-md-12">
                                    <label for="c_doc_id"><b>Therapist</b></label>
                                    <div>
                                    <select class="form-control" id="c_doc_id" name="c_doc_id">
                                            <option selected hidden>-----Choose Therapist-----</option>
                                            @foreach($therapist as $value)
                                            <option value="{{$value->ther_id}}">{{$value->ther_name}}</option>
                                            @endforeach
                                        </select>
                                    <span id="c_doc_id_error"></span>
                                    </div>
                                </div>
    
                                <div class="form-group col-md-12">
                                    <label for="c_bed_category_id"><b>Room Category</b></label>
                                    <div>
                                    <select class="form-control" id="c_room_category_id" name="c_room_category_id">
                                            <option selected hidden>Category</option>
                                            @foreach($room_categorys as $room_category)
                                            <option value="{{$room_category->room_category_id}}">{{$room_category->room_category_name}}</option>
                                            @endforeach
                                        </select>
                                    <span id="c_bed_category_id_error"></span>
                                    </div>
                                </div>
    
                                <div class="form-group col-md-12">
                                    <label for="c_room_id"><b>Room</b></label>
                                    <div>
                                    <select class="form-control" id="c_room_id" name="c_room_id">
                                            <option selected hidden>Room</option>
                                            @foreach($rooms as $rooms)
                                            <option value="{{$rooms->room_id}}">{{$rooms->room_name}}</option>
                                            @endforeach
                                        </select>
                                    <span id="c_room_id_error"></span>
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
                           <h5 class="modal-title" style="color: white;">Client</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true" style="color: white;">&times;</span></button>
                       </div>
          <div class="modal-body">
            <div>
              <h6 style="display:inline"><b>Client Sl:</b></h6>
              <p style="display:inline" id="s_c_sl"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Client Name:</b></h6>
              <p style="display:inline" id="s_c_name"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Gender:</b></h6>
              <p style="display:inline" id="s_c_gender"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Age:</b></h6>
              <p style="display:inline" id="s_c_age"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Phone:</b></h6>
              <p id="s_c_phone" style="display:inline"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Address:</b></h6>
              <p id="s_c_adress" style="display:inline"></p>
            </div> 
              <h6 style="display:inline"><b>Reference:</b></h6>
              <p style="display:inline" id="s_c_reference"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Therapist:</b></h6>
              <p style="display:inline" id="s_c_ther"></p>
            </div>
            <div>
              <h6 style="display:inline"><b>Room:</b></h6>
              <p style="display:inline" id="s_c_room"></p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    
        </div>
        </div>
        
  </div>
</div>


@section('script')
<script type="text/javascript">
	$(document).ready(function() {

        $("#c_room_category_id").change(function(){
            var bed_cat_id=$(this).val();
            $.ajax({
                url:"{{url('room.status')}}",
                type:'get',
                data:{room_category_id:room_category_id},
                dataType:"json",
                success:function(data)
                {
                    var b=$();
                    $.each(data, function (i, item) 
                    {
                        console.log(item);
                    b=b.add("<option value="+item.room_id+">"+item.room_name+"</option>");
                    });
                    $("#c_room_id").html(b);
                }
            });
        });

         // csrf token
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$(document).on("submit", "#form", function(e) {
			e.preventDefault();
			var data = $(this).serializeArray();

			$.ajax({
				url     : "{{route('client.store')}}",
				data    : data,
				type    : "post",
				dataType: "json",
				success: function(data) {
				$('#status').val('Inserted');
          		$('#success').submit();
				}, error: function(errors) {
					let error = JSON.parse(errors.responseText).errors;
			        $.each(error,function(i,message){
			            $("#"+i+"_error").html('<span class="help-block" style="color:red;">'+message+'</span>');
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
		          url     : "/client/"+data,
		          type    : "delete",
		          dataType: "json",
		          success: function(data) {
		            if (data.status==200) {
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

	$(document).on('click', '.show', function() {
      var id = $(this).attr("data");
      $.ajax({
        url: "{{url('client.show')}}",
        type: 'get',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(data) {
          $("#s_c_name").text(data.client.c_name);
          $("#s_c_gender").text(data.client.c_sex);
          $("#s_c_age").text(data.client.c_age);
          $("#s_c_phone").text(data.client.c_phone);
          $("#s_c_adress").text(data.client.c_address);
		  $('#s_c_sl').text(data.client.c_s);
		  $('#s_c_reference').text(data.client.c_reference);
		  $('#s_c_ther').text(data.therapy.ther_name);
		  $('#s_c_room').text(data.room.room_name);room_name+"-"+data.room_categories.room_category_name);
        }
      });
    });

	});


	$("#example").dataTable();

	jQuery(function($) {
        $("#c_admission_date").datetimepicker({
        	dateFormat: 'yy-mm-dd',
        	timeFormat: 'hh:mm:ss',
        });
    });
</script>

