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
                          Add Purches
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('purchase.view') }} "> <i class="fa fa-list"></i> Purches List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    {{-- <form action="{{ route('purchase.store') }}" method="POST" id="myForm">
                        @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="datepicker">Date</label>
                                <input type="text" name="date" id="datepicker" class="form-control datepicker" placeholder="MM-DD-YYYY" readonly>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="purchase_no">Purchase No</label>
                                <input type="text" name="purchase_no" id="purchase_no" class="form-control" placeholder="Purchase No">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supplier_id">Supplier Name</label>
                                <select class="form-control" name="supplier_id" id="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $key => $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_id">Categories Name</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_id">Product Name</label>
                                <select class="form-control" name="product_id" id="product_id">
                                    <option value="">select product</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <i class="btn btn-primary fa fa-plus addeventmore"> Add Item </i>
                            </div>
                        </div>    
                    {{-- </form> --}}
                  </div>
              </div>
          </section>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
    </section>
    <!-- /.content -->
    <script type="text/javascript">
        $(function() {
            $(document).on('change','#supplier_id',function(){
                var supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('app.get.category') }}" ,
                    type: "GET",
                    data:{supplier_id:supplier_id},
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,v) {
                            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>'
                        });
                        $('#category_id').html(html);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
            rules: {
               
                name: {
                required: true,
                },
                supplier_id: {
                required: true,
                },
                category_id: {
                required: true,
                },
                unit_id: {
                required: true,
                },
            },
            messages: {
              
                name: {
                required: "Please enter name",
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
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script>
        // $(function(){
        //     $(".datepicker").datepicker();
        // });
        $(function () {
            $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
        });
    </script>
@endsection