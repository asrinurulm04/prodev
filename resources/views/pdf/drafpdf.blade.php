@extends('layout.tempvv')
@section('title', 'PRODEV|Data PDF')
@section('content')

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="x_title">
            <h3><li class="fa fa-file-zip-o"> </li> Draf PDF</h3>
          </div>
          <div class="clearfix"></div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <th class="text-center">#</th>
                  <th class="text-center">Brand</th>
                  <th class="text-center">Project Name</th>
                  <th class="text-center">Author</th>
                  <th class="text-center">Created Date</th>
                  <th class="text-center">Priority</th>
                  <th class="text-center">Last Update</th>
                  <th width="11%" class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @php
                    $no = 0;
                  @endphp
                  @foreach($pdf as $pdf)
                  @if($pdf->status_project=="draf")
                  <th>{{ ++$no }}</th>
                  <th>{{ $pdf->id_brand }}</th>
                  <th>{{ $pdf->project_name }}</th>
                  <th>{{ $pdf->author1->name }}</th>
                  <th>{{ $pdf->created_date }}</th>
                  <th>
                    @if($pdf->prioritas==1) <span class="label label-danger">High Priority</span>
                    @elseif($pdf->prioritas==2) <span class="label label-warning">Standar Priority</span>
                    @elseif($pdf->prioritas==3) <span class="label label-primary">Low Priority</span>
                    @endif
                  </th>
                  <th>{{ $pdf->last_updated }}</th>
                  <th class="text-center">{{ $pdf->status_project }}</th>
                  <th class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    <a href="{{route('hapuspdf',$pdf->id_project_pdf)}}" onclick="return confirm('Are you sure ?')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                    {{csrf_field()}}
                  </th>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
@endsection