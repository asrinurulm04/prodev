@extends('pv.tempvv')
@section('title', 'PRODEV|Data PKP promo')
@section('content')

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-zip-o"> </li> Draf PROMO</h3>
        </div>
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">#</th>
                <th class="text-center">Brand</th>
                <th class="text-center">Project Name</th>
                <th class="text-center">Author</th>
                <th class="text-center">Date</th>
                <th class="text-center">Last update</th>
                <th class="text-center">Priority</th>
                <th width="11%" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @php $no = 0; @endphp
                @foreach($promo as $pkp)
                <th>{{ ++$no }}</th>
                <th>{{ $pkp->brand }}</th>
                <th>{{ $pkp->project_name }}</th>
                <th>{{ $pkp->author1->name }}</th>
                <th>{{ $pkp->created_date }}</th>
                <th>{{ $pkp->last_update }}</th>
                <th></th>
                <th class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  <a href="{{route('hapuspromo',$pkp->id_pkp_promo)}}" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><li class="fa fa-trash" data-toggle="tooltip" title="Delete"></li></a>
                  {{csrf_field()}}
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection