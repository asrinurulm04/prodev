@extends('pv.tempvv')
@section('title', 'Draf PKP')
@section('judulhalaman','Draf PKP')
@section('content')

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:500px">
        <div class="x_title">
          <h3><li class="fa fa-file-zip-o"> </li> Draf PKP</h3>
        </div>
        <div class="x_content" style="overflow-x: scroll;">
          <table class="Table table-bordered table-striped border">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">#</th>
                <th class="text-center">Brand</th>
                <th class="text-center">Project Name</th>
                <th class="text-center">Author</th>
                <th class="text-center">Date</th>
                <th class="text-center">status</th>
                <th width="11%" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr style="">
                @php $no = 0; @endphp
                @foreach($pkp as $pkp)
                @if($pkp->status_project=='draf')
                <td class="text-center">{{ ++$no}}</td>
                <td>{{ $pkp->id_brand }}</td>
                <td>{{ $pkp->project_name }}</td>
                <td>{{ $pkp->author1->name}}</td>
                <td class="text-center">{{ $pkp->created_date }}</td>
                <td class="text-center">{{ $pkp->approval }}</td>
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  <a href="{{route('hapuspkp',$pkp->id_project)}}" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><li class="fa fa-trash"></li></a>
                  {{csrf_field()}}
                </td>
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

@endsection