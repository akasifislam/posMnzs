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
                          Add Invoice
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('invoice.view') }} "> <i class="fa fa-list"></i> Invoice List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    {{-- <form action="{{ route('invoice.store') }}" method="POST" id="myForm">
                        @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="invoice_no">Invoice No</label>
                                <input type="text" value="{{ $invoice_no }}" name="invoice_no" id="invoice_no" class="form-control form-control-sm" placeholder="Purchase No" readonly style="background-color: rgb(191, 235, 195)">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="datepicker">Date</label>
                                <input type="text" name="date" id="date" class="form-control form-control-sm datepicker" placeholder="MM-DD-YYYY" readonly style="background-color: rgb(191, 235, 195)">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_id">Category Name</label>
                                <select class="form-control select2" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_id">Product Name</label>
                                <select class="form-control select2" name="product_id" id="product_id">
                                    <option value="">select product</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_id">Stock(PCS/KG)</label>
                                <input type="text" class="form-control form-control-sm" class="current_stock_qty" id="current_stock_qty" readonly style="background-color: rgb(191, 235, 195)">
                            </div>
                            <div class="form-group col-md-12">
                                <a class="btn btn-primary addeventmore text-white"><i class="fa fa-plus"> Add Item </i></a>
                                
                            </div>
                        </div>    
                    {{-- </form> --}}
                  </div>
                  <div class="card-body">
                    <form action="{{ route('invoice.store') }}" method="POST" id="myForm">
                        @csrf
                        <table class="table-sm table-bordered table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="15%">Category</th>
                                    <th width="15%">Product Name</th>
                                    <th width="5%">pcs/kg</th>
                                    <th width="15%">Unit Price</th>
                                    <th width="15%">Total Price</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody name="addRow" id="addRow">

                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="4">Discount</td>
                                    <td><input type="text" class="form-control form-control-sm text-right" name="discount_amount" id="discount_amount" style="background-color: hsl(200, 3%, 66%)" placeholder="Discount Amount"></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>
                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #42dbc2">
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="">
                                    <textarea name="description" id="description" class="form-control form-control-sm" placeholder="write description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="paid_status">Paid Status</label>
                                <select name="paid_status" id="paid_status" class="form-control form-control-sm select2">
                                    <option value=""> -- select status -- </option> 
                                    <option value="full_paid">Full paid</option> 
                                    <option value="full_due">Full due</option>
                                    <option value="partial_paid">Partial paid</option>
                                </select>
                                <input style="display: none" type="text" name="paid_amount" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="customer_id">Customer Name</label>
                                <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                                    <option value=""> -- select customer -- </option>
                                    <option value="0">New Customer </option>
                                    @foreach ($customers as $key=>$customer) 
                                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->mobile_no }},{{ $customer->address }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row new_customer">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Wtrite Customer Name">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="storeButton">Invoice Store</button>
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
            $(document).on("click",".addeventmore",function() {
                var date = $('#date').val(); 
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var category_id = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text(); 
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();     
                if (date=='') {
                    $.notify("Date is required", {globalPosition: 'top-right',className:'error'});
                    return false;
                }
                if (category_id=='') {
                    $.notify("Category Id required", {globalPosition: 'top-right',className:'error'});
                    return false;
                }
                if (product_id=='') {
                    $.notify("Product Id required", {globalPosition: 'top-right',className:'error'});
                    return false;
                }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date:date,
                invoice_no:invoice_no,
                supplier_id:supplier_id,
                category_id:category_id,
                category_name:category_name,
                product_id:product_id,
                product_name:product_name
            };
            var html = template(data);
            $("#addRow").append(html);
            });
            $(document).on("click",".removeeventmore",function(event) {
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });
            $(document).on("keyup click",'.unit_price,.selling_qty',function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.selling_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.selling_price").val(total);
                $('#discount_amount').tigger('keyup');
            });
            $(document).on('keyup','#discount_amount',function() {
                totalAmountPrice();
            });
            // calcularate sum of amount
            function totalAmountPrice(){
                var sum=0;
                $(".selling_price").each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length !=0) {
                        sum += parseFloat(value);
                    }
                });
                var discount_amount = parseFloat($('#discount_amount').val());
                if(!isNaN(discount_amount) && discount_amount.length!=0){
                    sum-=parseFloat(discount_amount);
                }
                $('#estimated_amount').val(sum);
            }
        });
       
    </script>
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{date}}">
            <input type="hidden" name="invoice_no[]" value="@{{invoice_no}}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{category_name}}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
            </td>
            <td>
                <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
            </td>
            <td> <i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i> </td>
        </tr>
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('change','#product_id',function() {
                var product_id = $(this).val();
                $.ajax({
                    url:"{{ route('check.product.stock') }}",
                    type: "GET",
                    data:{product_id:product_id},
                    success:function(data){
                        $('#current_stock_qty').val(data);
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
               
                date: {
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
              
                // name: {
                // required: "Please enter name",
                // },
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({ format: 'dd/mm/yyyy' });
        });
    </script>
@endsection