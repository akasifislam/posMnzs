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
                      <h3>Manage Supplier
                        <a class="btn btn-success btn-sm float-right" href="{{ route('suppliers.add') }} "> <i class="fa fa-plus-circle"></i> Add</a>
                      </h3>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Supplier Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Mobile No</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $suppliers)
                            <tr class="{{ $suppliers->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $suppliers->name }}</td>
                                <td>{{ $suppliers->email }}</td>
                                <td>{{ $suppliers->address }}</td>
                                <td>{{ $suppliers->mobile_no }}</td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a href="{{ route('suppliers.edit',$suppliers->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                      <a type="button" id="delete" href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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