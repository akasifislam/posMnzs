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
                      <h3>
                          @if(isset($editData))
                          Edit Employee 
                          @else
                          Add Employee
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('suppliers.view') }} "> <i class="fa fa-list"></i> Employee List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <form action="{{ route('suppliers.store') }}" method="POST" id="myForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Suplier Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile_no">Mobile</label>
                                <input type="text" class="form-control" name="mobile_no" id="mobile_no">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-sm {{ (@$editData)?'btn-primary':'btn-success' }}">{{ (@$editData)?'Update':'Submit' }}</button>   
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
               
                name: {
                required: true,
                },
                mobile_no: {
                required: true,
                },
                email: {
                required: true,
                },
                address: {
                required: true,
                },
            },
            messages: {
              
                name: {
                required: "Please enter name",
                },
                mobile_no: {
                required: "Please enter mobile number",
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