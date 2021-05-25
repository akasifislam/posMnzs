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
                          Edit Supplier 
                          @else
                          Add Supplier
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('categories.view') }} "> <i class="fa fa-list"></i> Unit List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <form action="{{ route('categories.update',$editData->id) }}" method="POST" id="myForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Suplier Name</label>
                                <input  value="{{ (old('name')) ? old('name'): $editData->name }}" type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-12">
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