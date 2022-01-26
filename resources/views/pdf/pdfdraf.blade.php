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
          <div class="x_content" style="overflow-x: scroll;">
            <table class="table table-striped table-bordered">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <th class="text-center">#</th>
                  <th class="text-center">Brand</th>
                  <th class="text-center">Project Name</th>
                  <th class="text-center">Author</th>
                  <th class="text-center">Created Date</th>
                  <th width="11%" class="text-center">Status</th>
                  <th width="11%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @php $no = 0; @endphp
                  @foreach($pdf as $pdf)
                  <td class="text-center">{{ ++$no }}</td>
                  <td>{{ $pdf->id_brand }}</td>
                  <td>{{ $pdf->project_name }}</td>
                  <td>{{ $pdf->author1->name }}</td>
                  <td>{{ $pdf->created_date }}</td>
                  <td class="text-center">{{ $pdf->status_project }}</td>
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    <a href="{{route('hapuspdf',$pdf->id_project_pdf)}}" onclick="return confirm('Are you sure ?')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                    {{csrf_field()}}
                  </td>
                </tr>
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