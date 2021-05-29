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
                                <a class="btn btn-primary addeventmore text-white"><i class="fa fa-plus"> Add Item </i></a>
                                
                            </div>
                        </div>    
                    {{-- </form> --}}
                  </div>
                  <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="POST" id="myForm">
                        @csrf
                        <table class="table-sm table-bordered table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>pcs/kg</th>
                                    <th>Unit Price</th>
                                    <th>Description</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody name="addRow" id="addRow">

                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>
                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="storeButton">Purchase Store</button>
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
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="data[]" value="@{{ data }}">
            <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                @{{ category_id }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                @{{ product_id }}
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right unit_price[]" name="unit_price[]" value="">
            </td>
            <td>
                <input type="text" name="description[]" class="form-control form-control-sm">
            </td>
            <td>
                <input name="description[]" class="form-control form-control-sm text-right buying_price" name="buying_price" value="0" readonly>
            </td>
            <td> <i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i> </td>
        </tr>
    </script>
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
        $(function() {
            $(document).on('change','#category_id',function(){
                var category_id = $(this).val();
                $.ajax({
                    url: "{{ route('app.get.product') }}" ,
                    type: "GET",
                    data:{category_id:category_id},
                    success: function(data) {
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function(key,v) {
                            html += '<option value="'+v.id+'">'+v.name+'</option>'
                        });
                        $('#product_id').html(html);
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