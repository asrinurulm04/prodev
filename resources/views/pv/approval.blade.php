@extends('pv.tempvv')
@section('title', 'Approval')
@section('judulhalaman','Approval')
@section('content')

<div class="">
  @if (session('status'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success" style="margin:20px">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
      </div>
    </div>
  </div>  
  @endif

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3>Approval</h3>
          <div class="x_content" style="overflow-x: scroll;">
          <table class="table table-striped table-advance table-hover" id="Table">
            <thead>
            <tr>
              <th>No</th>
              <th>User</th>
              <th>Departement</th>
              <th>No PKP</th>
              <th>Nama Project</th>
              <th>Revisi</th>
              <th class="text-center">Jumlah Pengajuan</th>
              <th class="text-center">Pesan</th>
              <th class="text-center">Action</th>
            </tr>  
            </thead> 
            <tbody>
            @foreach ($projects as $project)
              <tr>
                <td>{{ $project['no'] }}</td>
                <td>{{ $project['user'] }}</td>
                <td>{{ $project['dept'] }}</td>
                <td>{{ $project['pkp'] }}</td>
                <td>{{ $project['project'] }}</td>
                <td>{{ $project['revisi'] }}</td>
                <td class="text-center">{{ $project['jumlah_pengajuan'] }}</td>
                <td class="text-center">
                  <span class="badge bg-info">{{ $project['pt'] }}</span>
                  <span class="badge bg-important">{{ $project['pm'] }}</span>
                </td>
                <td class="text-center">
                  <a href="{{ route('detailproject',$project['id']) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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