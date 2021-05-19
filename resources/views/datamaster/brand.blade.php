@extends('pv.tempvv')
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
  <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_brand" id="tambah"><i class="fa fa-plus"></i> Add Brand</a>
  <div class="card-block">
    <div class="dt-responsive table-responsive">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th width="5%">ID</th>
            <th>Brand</th>
            <th width="15%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
				  @php $no = 0; @endphp
          @foreach($brands as $brand)
          <tr>
					  <td>{{++$no}}</td>
            <td>{{ $brand->brand }}</td>
            <td class="text-center">
              <a class="btn-sm btn-primary" type="button" data-toggle="modal" data-target="#edit_brand{{ $brand->id}}"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a> &nbsp
              <a class="btn-sm btn-danger" onclick="return confirm('Hapus Bahan Baku ?')" data-toggle="tooltip" title="Delete" href="{{ route('brand.destroy',$brand->id) }}"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
            <!-- Edit Brand-->
            <div class="modal fade" id="edit_brand{{ $brand->id}}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Brand {{ $brand->brand}}
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                  </div>
                  <form method="POST" action="{{ route('brand.update',$brand->id) }}">
                  <div class="modal-body">
                    <label for="nama_produk" class="control-label">Brand</label>
                    <input class="form-control" id="brand" name=brand placeholder="Brand" value="{{ $brand->brand }}" required />
                  </div>
                  <div class="modal-footer">
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Save</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- selesai -->
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add New Brand-->
<div class="modal fade" id="add_brand" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Add Brand
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <form method="POST" action="{{ route('brand.store') }}">
      <div class="modal-body">
        <label for="nama_produk" class="control-label">Brand</label>
        <input class="form-control" id="brand" name=brand placeholder="Brand" required />
        {{ csrf_field() }}     
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- selesai -->
@endsection
@section('s')
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection