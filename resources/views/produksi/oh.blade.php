@extends('produksi.tempproduksi')
@section('title','Feasibility|Inputor')
@section('content')

<div id="RM" class="tab-pane">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-cogs"> Data Mesin</li></h3>
        </div>
        <div class="x_content">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul class="nav nav-tabs  tabs" role="tablist">
              <li role="presentation" class=""><a href="{{ route('produksi',$id_feasibility) }}">GRANULASI</a></li>
              <li role="presentation" class=""><a href="{{ route('mixing',$id_feasibility) }}">MIXING</a></li>
              <li role="presentation" class=""><a href="{{ route('filling',$id_feasibility) }}">FILLING</a></li>
              <li role="presentation" class=""><a href="{{ route('packing',$id_feasibility) }}">PACKING</a></li>
              <li role="presentation" class="active"><a href="{{ route('oh',$id_feasibility) }}">ACTIVITY</a></li>
            </ul>
            <div id="myTabContent" class="tab-content"><br>

              <!-- PACKING -->
              <table class="Table table-hover table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th class="text-center">No</th>
                    <th class="text-center">Aktifitas</th>
                    <th class="text-center">runtime</th>
                    <th class="text-center">Standar SDM</th>
                    <th class="text-center">SDM</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $noll = 0; @endphp
                  @foreach($dataO as $dO)
                  @php ++$noll; @endphp
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('/updatesdmoh')}}/{{$dO->id_oh}}" method="post">
                  {!!csrf_field()!!}
                  <tr>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                    </div>
                    <td width="3%" class="text-center">{{ $noll }}</td>
                    <td>{{ $dO->dataoh->direct_activity }}</td>
                    <td class="text-center">{{ $dO->runtime  }} Menit</td>
                    <td class="text-center">{{ $dO->standar_sdm }}</td>
                    @if($dO->SDM==NULL)
                    <td><input id="SDM" name="SDM" class="date-picker form-control col-md-7 col-xs-12" type="text"></td>
                    <td><button type="submit" class="btn btn-primary">Submit</button></td>
                    @else
                    <td class="text-center">{{$dO->SDM}} orang</td>
                    <td class="text-center">
                      <button type="button" class="btn btn-warning fa fa-edit" data-toggle="modal" data-target="#exampleModal2{{ $dO->id_oh  }}"  data-toggle="tooltip" data-placement="top" title="Edit"></button>
                      <div class="modal fade" id="exampleModal2{{ $dO->id_oh  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <input id="SDM" value="{{$dO->SDM}}" name="SDM" class="date-picker form-control" type="text">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                            </div>
                          </div>
                      </div>
                    @endif
                  </tr>
                  </form>
                  @endforeach
                </tbody>
              </table>
            </div>
            @foreach($dataF as $dF)
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('statusP',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
            <input class="form-control1" type="hidden" name="statusP" class="text-center col-md-7 col-xs-12" value="sending">
            <center><button type="submit" class="btn btn-primary">Selesai</button>
			        {{ csrf_field() }}
            </center>
            @endforeach
            </form>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
