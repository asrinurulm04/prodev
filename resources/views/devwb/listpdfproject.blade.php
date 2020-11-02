@extends('formula.tempformula')
@section('title', 'List PDF')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="row">
    <!-- filter data -->
    <div class="panel panel-default">
	    <div class="panel-heading">
        <h2><li class="fa fa-filter"></li> Filter Project PDF</h2>
      </div>
      <div>
        <div>
          <form id="clear">
          <!--project-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col" data-column="1">
              <label>Project Name</label>
              <select name="name" class="form-control column_filter" id="col1_filter">
                <option disabled selected>-->Select One<--</option>
                @foreach($pdf as $pdf1)
                @if($pdf1->status_project=='proses' || $pdf1->status_project=='close')
                <option>{{$pdf1->project_name}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>    
          <!--brand-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col1" data-column="3">
              <label>Brand</label>
              <select name="brand" class="form-control column_filter" id="col3_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($brand as $br)
                <option>{{$br->brand}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--Data-->
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label>Status</label>
              <select name="status" class="form-control column_filter" id="col5_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($pdf as $pdf2)
                @if($pdf2->status_project=='proses' || $pdf2->status_project=='close')
                <option>{{$pdf2->status_project}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-1 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label class="text-center">refresh</label>    
              <a href="" class="btn btn-info btn-sm"><li class="fa fa-refresh"></li></a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- filter data selesai -->
  </div>
</div>

<div class="x_panel">
  <div class="card-header">
    <h3><li class="fa fa-wpforms"></li> List PDF</h5>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content" style="overflow-x: scroll;">
      <table class="Table table-bordered stylish-table table-striped no-border dtables" id="ex"> 
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>#</th>
            <th>PDF Number</th>
            <th>Project Name</th>
            <th>Brand</th>
            <th>Author</th>
            <th>Status</th>
            <th>Created_date</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          @php
            $no = 0;
          @endphp
          @foreach($pdf as $pdf)
          @if($pdf->userpenerima2=='NULL')
            @if($pdf->userpenerima==Auth::user()->id)
            <td>{{ ++$no }}</td>
            <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
            <td>{{ $pdf->project_name }}</td>
            <td>{{ $pdf->id_brand }}</td>
            <td>{{ $pdf->author1->name }}</td>
            <td class="text-center">
              @if($pdf->status_project=='proses')
              <span  class="label label-success" style="color:white">Proses</span>
              @elseif($pdf->status_project=='close')
              <span  class="label label-info" style="color:white">Close</span>
              @endif
            </td>
            <td>{{ $pdf->created_date }}</dh>
            <td>{{ $pdf->waktu }}</td>
            <td class="text-center">{{ $pdf->status }}</td>
            <td class="text-center">
              @if($pdf->status_project=='proses')  
                <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @elseif($pdf->status_project=='revisi')
                The Project in the revised proses
              @elseif($pdf->status_project=='close')
              <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
              @endif
            </td>
            @endif
          @else($pdf->userpenerima2!='NULL')
            @if($pdf->userpenerima==Auth::user()->id || $pdf->userpenerima2==Auth::user()->id)
            <td>{{ ++$no }}</td>
            <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
            <td>{{ $pdf->project_name }}</td>
            <td>{{ $pdf->id_brand }}</td>
            <td>{{ $pdf->author1->name }}</td>
            <td class="text-center">
              @if($pdf->status_project=='proses')
              <span  class="label label-success" style="color:white">Proses</span>
              @elseif($pdf->status_project=='close')
              <span  class="label label-info" style="color:white">Close</span>
              @endif
            </td>
            <td>{{ $pdf->created_date }}</td>
            <td class="text-center">
              @if($pdf->status_project=='proses')
              <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @elseif($pdf->status_project=='revisi')
                The Project in the revised proses
              @elseif($pdf->status_project=='close')
              <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
              @endif
            </td>
            @endif
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('s')
<script>
  function filterGlobal () {
    $('#ex').DataTable().search(
      $('#global_filter').val(),  
    ).draw();
  }
    
  function filterColumn ( i ) {
    $('#ex').DataTable().column( i ).search(
      $('#col'+i+'_filter').val()
    ).draw();
  }
    
  $(document).ready(function() {
    $('#ex').DataTable();    
      $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('div').attr('data-column') );
    } );
  });

  $('select.column_filter').on('change', function () {
    filterColumn( $(this).parents('div').attr('data-column') );
  } );
</script>
@endsection