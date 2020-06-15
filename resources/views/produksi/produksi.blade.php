@extends('produksi.tempproduksi')

@section('title','Feasibility|Inputor')

@section('content')

<div id="RM" class="tab-pane">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
    <div class="card-block">
      <div class="card-header">
        <h2><i class="fa fa-cogs"></i> Data Mesin </h2>
        <div class="clearfix"></div>
      </div>
      <br>
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="{{ route('produksi',$id_feasibility) }}">GRANULASI</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mixing',$id_feasibility) }}">MIXING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('filling',$id_feasibility) }}">FILLING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('packing',$id_feasibility) }}">PACKING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('oh',$id_feasibility) }}">ACTIVITY</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
<br>
          <!-- GGRANULASI -->
          <table class="table table-hover table-bordered">
      <thead>
        <tr>
        <th class="text-center">No</th>
          <th class="text-center">mesin</th>
          <th class="text-center">Kategori</th>
          <th class="text-center">Runtime</th>
          <th class="text-center">standar SDM</th>
          <th class="text-center">SDM</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php $no = 0;?>
        @foreach($Mdata as $dM)

        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('/updatesdmmesin')}}/{{$dM->id_mesin}}" method="post">
        {!!csrf_field()!!}
    <tr>
    <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
    </div>
    <?php ++$no ;?>
    @if( $dM->meesin->kategori=='granulasi' )
    <td width="3%" class="text-center">{{ $no }}</td>
    <td>{{ $dM->meesin->nama_mesin }}</td>
    <td class="text-center">{{ $dM->meesin->kategori }}</td>
    <td class="text-center">{{ $dM->runtime  }} Menit</td>
    <td class="text-center">{{ $dM->standar_sdm }} Orang</td>
    @if($dM->SDM==NULL)
    <td><input id="SDM" name="SDM" class="date-picker form-control col-md-7 col-xs-12" type="text"></td>
    <td><button type="submit" class="btn btn-primary">Submit</button></td>
    @else
    <td class="text-center">{{$dM->SDM}} orang</td>
    <td class="text-center"><button type="button" class="btn btn-warning fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin  }}"  data-toggle="tooltip" data-placement="top" title="Edit"></button>
    <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content text-left">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Edit Data
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></h3>
          </div>
          <div class="modal-body">
            <form >
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">jumlah SDM:</label>
                <input id="SDM" value="{{$dM->SDM}}" name="SDM" class="date-picker form-control" type="text">
              </div></div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
                        </div>
                      </div>
                    </div>
                  </div>
    @endif
    </tr>
    @endif
        </form>
        @endforeach
      </tbody>
    </table>

                        @foreach($dataF as $dF)
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('statusP',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
                        <input class="form-control1" type="hidden" name="statusP" class="text-center col-md-7 col-xs-12" value="sending">

                        <center>
      <button type="submit" class="btn btn-primary">Selesai</button>
			                      {{ csrf_field() }}
    </div> @endforeach
    </center>
    </form>
                      </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
@endsection
