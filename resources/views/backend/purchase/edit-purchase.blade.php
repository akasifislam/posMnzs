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
                          Add Product
                          @endif

                        <a class="btn btn-success btn-sm float-right" href="{{ route('products.view') }} "> <i class="fa fa-list"></i> Supplier List</a>
                      </h3>
                      
                  </div>
                  <div class="card-body">
                    <form action="{{ route('products.update',$editData->id) }}" method="POST" id="myForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Suplier Name</label>
                                <select class="form-control" name="supplier_id" id="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $key => $supplier)
                                        <option 
                                        {{ 
                                           ($editData->supplier_id==$supplier->id) ? 'selected' : ''
                                        }}

                                        value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="name">Categories Name</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option
                                    value="">Select Category</option>
                                    @foreach ($categories as $key => $category)
                                        <option
                                        {{ 
                                            ($editData->category_id==$category->id) ? 'selected' : ''
                                        }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="name">Unit Key</label>
                                <select class="form-control" name="unit_id" id="unit_id">
                                    <option value="">Select Unit</option>
                                    @foreach ($units as $key => $unit)
                                        <option
                                        {{ 
                                            ($editData->unit_id==$unit->id) ? 'selected' : ''
                                        }}
                                         value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="name">Product Name</label>
                                <input placeholder="Product Name" type="text" value="{{ $editData->name }}" class="form-control" name="name" id="name">
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
@endsection