@extends('backend.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <section class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>Add User
                        <a class="btn btn-success btn-sm float-right" href="{{ route('users.view') }} "> <i class="fa fa-list"></i> List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ route('users.store') }}" id="myForm">
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="usertype">User Role</label>
                                  <select name="usertype" id="usertype" class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name">
                                <font style="cilor: red"> {{ ($errors->has('name')) ? ($errors->first('name')): '' }} </font>  
                              </div>
                              <div class="form-group col-md-4">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email">
                                <font style="cilor: red"> {{ ($errors->has('email')) ? ($errors->first('email')): '' }} </font>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="password1">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <font style="cilor: red"> {{ ($errors->has('password')) ? ($errors->first('password')): '' }} </font>    
                              </div>
                              <div class="form-group col-md-4">
                                <label for="password2">Confirm Password</label>
                                <input type="password" class="form-control" name="password2">    
                              </div>
                              <div class="form-group col-md-6">
                                <input type="submit" value="submit" class="btn btn-primary">    
                              </div>
        
                          </div>
                      </form>
                    
                  </div>
              </div>


          </section>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
    </section>
    <!-- /.content -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
            rules: {
                usertype: {
                required: true,
                },
                name: {
                required: true,
                },
                email: {
                required: true,
                email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password2: {
                    required: true,
                    equalTo: '#password'
                },
                
            },
            messages: {
                usertype: {
                required: "Please select User Role",
                },
                name: {
                required: "Please enter name",
                },
                email: {
                required: "Please enter a email address",
                email: "Please enter a <em> vaild </em> email address",
                },
                password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 6 characters",
                },
                password2: {
                required: "Please enter confirm password",
                equalTo: "Confirm password does not match",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
            });
        });
    </script>
@endsection