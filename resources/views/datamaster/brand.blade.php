@extends('layout.tempvv')
@section('title', 'PRODEV|Data Brand')
@section('content')

<div class="row">
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
</div>

<!-- BRAND -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Brand</li></h3>
  </div>
  <div class="card-block">
    <div class="dt-responsive table-responsive">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th width="5%">#</th>
            <th>Brand</th>
          </tr>
        </thead>
        <tbody>
				  @php $no = 0; @endphp
          @foreach($brands as $brand)
          <tr>
					  <td>{{++$no}}</td>
            <td>{{ $brand->brand }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection