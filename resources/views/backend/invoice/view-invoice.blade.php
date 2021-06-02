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
                      <h3>Manage Invoice
                        <a class="btn btn-success btn-sm float-right" href="{{ route('invoice.add') }} "> <i class="fa fa-plus-circle"></i> Add</a>
                      </h3>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-sm table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Customer Name</th>
                          <th>Invoice No</th>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($allData as $key => $invoice) --}}
                            <tr>
                              <td>1</td>
                              <td>a</td>
                              <td>b</td>
                              <td>c</td>
                              <td>d</td>
                              <td>ac</td>
                                {{-- <td>{{ $key+1 }}</td>
                                <td>customer name</td>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ date('d-m-Y',strtotime($invoice->date)) }}</td>
                                <td>{{ $invoice->description }}</td>
                                <td>
                                  @if ($invoice->status==1)
                                    <span class="right badge badge-success">approve</span>
                                  @else
                                    <span class="right badge badge-danger">pending</span>
                                  @endif
                                </td>
                                <td>
                                  @if ($invoice->status== 0)
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <a type="button" id="delete" href="{{ route('invoice.delete',$invoice->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </div>
                                  @endif
                                </td> --}}
                              </tr>
                                
                            {{-- @endforeach --}}
                            
                            
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