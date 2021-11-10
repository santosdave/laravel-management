<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container">
      <div class="card">
        <div class="card-header">
            <h2>Add Therapist</h2> 
        </div>
          <div class="clearfix"></div>
      
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="card-body">
        
                    <div class="col-md-12 ">
      
      
                  <form class="form-horizontal form-label-left" method="POST" action="{{-- {{route('therapy.store')}} --}}" enctype="multipart/form-data">
                    @csrf
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Therapist Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6">
                        <input id="name" class="form-control" name="ther_name" placeholder="Enter Name" type="text" value="{{ old('ther_name') }}">
                        <p class="text-danger">{{$errors->first('ther_name')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Therapist Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" id="number" name="ther_phone" placeholder="Enter Your Number" class="form-control" value="{{ old('ther_phone') }}">
                        <p class="text-danger">{{$errors->first('ther_phone')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="address">Therapist Address <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" id="address" name="ther_address" placeholder="Enter Address" class="form-control" value="{{ old('ther_address') }}">
                        <p class="text-danger">{{$errors->first('ther_address')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label for="profile" class="col-form-label col-md-3 col-sm-3  label-align">Profile <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6">
                        <input id="profile" type="text" name="ther_profile" class="form-control" placeholder="Enter Profile" value="{{ old('ther_profile') }}">
                        <p class="text-danger">{{$errors->first('ther_profile')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label for="department" class="col-form-label col-md-3 col-sm-3  label-align">Therapist Department <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6">
                        <select class="form-control" name="ther_dept_id">
                          @foreach($department as $value)
                          <option value="" hidden>--Select--</option>
                          <option value="{{ $value->dept_id }}">{{ $value->dept_name }}</option>
                          @endforeach
                        </select>
                        <p class="text-danger">{{$errors->first('ther_dept_id')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="email"> Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6">
                        <input type="email" id="email" name="ther_email" placeholder="Enter Email" class="form-control" value="{{ old('ther_email') }}">
                        <p class="text-danger">{{$errors->first('ther_email')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="password">Password <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="password" id="password" name="ther_password" placeholder="Password" value="{{ old('ther_password') }}">
                        <p id="pass" class="text-danger">{{$errors->first('ther_password')}}</p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="c_password">Confirm Password <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="password" id="c_password" placeholder="Confirm Password">
                        <p id="cp"></p>
                      </div>
                    </div>
      
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="telephone">Photo <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6">
                        <img id='previmage' style="height:140px;" src="{{asset('images/blankavatar.png')}}" alt="your image" class='img-responsive img-circle'>
                        <br>
                        <input type="file" id="image" name="ther_img" onchange="readURL(this);" value="{{ old('ther_img') }}">
                        <p class="text-danger">{{$errors->first('ther_img')}}</p>
                      </div>
                    </div>
      
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 offset-md-3">
                        <button type="reset" class="btn btn-primary btn-sm">Reset</button>
                        <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    
  </div>
</div>
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $("#password").keyup(function() {
      var pass = $(this).val().length;

      if (pass >= 8) {
        $("#pass").html('<font color="green">Password Strong</font>');
        $(".submit").attr('disabled', true);
      } else {
        $("#pass").html('<font color="red">Password Length Must Be 8 Charecters</font>');
        $(".submit").attr('disabled', true);
      }
    });

    $("#c_password").keyup(function() {
      var con_pass = $(this).val();
      var password = $("#password").val();

      if (con_pass != '' && password != '' && con_pass == password) {
        $("#cp").html('<font color="green">Password Matched</font>');
        $(".submit").attr("disabled", false);
      } else {
        $("#cp").html('<font color="red">Password Not Matched</font>');
        $(".submit").attr("disabled", true);
      }
    });
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#previmage')
          .attr('src', e.target.result)
          .width(140)
          .height(140);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function myFunction() {
    window.print();
  }
</script>
@endsection
