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
                      <h3>Manage Purches
                        <a class="btn btn-success btn-sm float-right" href="{{ route('purchase.add') }} "> <i class="fa fa-plus-circle"></i> Add</a>
                      </h3>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-sm table-responsive table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Purchase No</th>
                          <th>Date</th>
                          <th>Supplier Name</th>
                          <th>Category</th>
                          <th>Product Name</th>
                          <th>Description</th>
                          <th>Quentity</th>
                          <th>Unit Price</th>
                          <th>Buying Price</th>
                          <th>ststus</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $purchase)
                            <tr class="{{ $purchase->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $purchase->purchase_no }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase['supplier']['name'] }}</td>
                                <td>{{ $purchase['category']['name'] }}</td>
                                <td>{{ $purchase['product']['name'] }}</td>
                                <td>{{ $purchase->description }}</td>
                                <td>
                                  {{ $purchase->buying_qty }}
                                  {{ $purchase['product']['unit']['name'] }}
                                </td>
                                <td>{{ $purchase->unit_price }}</td>
                                <td>{{ $purchase->buying_price }}</td>
                                <td>
                                  @if ($purchase->status==0)
                                    <code>approve</code>
                                  @else
                                    <span>pending</span>
                                  @endif
                                  
                                  
                                </td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a href="{{ route('purchase.edit',$purchase->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                      <a type="button" id="delete" href="{{ route('purchase.delete',$purchase->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                  </div>
                                </td>
                              </tr>
                                
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                  </div>
              </div>


          </section>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
    </section>
    <!-- /.content -->
@endsection