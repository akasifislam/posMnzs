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
                      <h3>Manage Unit
                        <a class="btn btn-success btn-sm float-right" href="{{ route('units.add') }} "> <i class="fa fa-plus-circle"></i> Add</a>
                      </h3>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Unit Name</th>
                          <th>Author</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $units)
                            <tr class="{{ $units->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $units->name }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                @php
                                    $count_unit = App\Model\Product::where('unit_id',$units->id)->count();
                                @endphp 
                                <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a href="{{ route('units.edit',$units->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                      @if ($count_unit<1) 
                                      <a type="button" id="delete" href="{{ route('units.delete',$units->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </div>
                                    @endif
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