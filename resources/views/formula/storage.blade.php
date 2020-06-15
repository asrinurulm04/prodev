@extends('formula.tempformula')
@section('title', 'Data Storage')
@section('judul', 'Data Storage')
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

<div class="row">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="{{ route('step2',$idf) }}"><span class="nmbr">1</span>Penyusunan</a></li>
        <li class="active"><a href="{{ route('summarry',$idf) }}"><span class="nmbr">2</span>Summary</a></li>
        <li class="active"><a href="{{ route('step3',$idf) }}"><span class="nmbr">3</span>Premix</a></li>
        <li class="completed"><a href="{{ route('panel',$idf) }}"><span class="nmbr">4</span>Data Panel</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 content-panel">
  <div class="panel panel-default"><br>
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <li role="presentation" class=""><a href="{{ route('panel',$idf) }}">DATA PANEL</a></li>
      <li role="presentation" class="active"><a href="{{ route('st',$idf) }}">DATA STOREGE</a></li>
    </ul>
	  <div class="panel-body">
      <div class="form-group">
        @if($cek_storage=='0')
        <div class="col-md-12 col-sm-12 col-xs-12">
          <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilstorage') }}" novalidate>
            <input type='hidden' name='idf' maxlength='45' value='{{$fo->workbook_id}}' class='form-control col-md-7 col-xs-12'>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No.PST</label>
              <div class="col-md-6 col-sm-8 col-xs-12">
                <input type="text" id="spt" name="spt" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Suhu</label>
              <div class="col-md-6 col-sm-8 col-xs-12">
                <select class="form-control" name="suhu" id="suhu">
                  <option disabled>---</option>
                  <option value="27">27</option>
                  <option value="37">37</option>
                  <option value="47">47</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Estimasi Selesai</label>
              <div class="col-md-6 col-sm-8 col-xs-12">
                <input type="date" id="estimasi" name="estimasi" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
              </div>
            </div>
          </form>
        </div>
        @elseif($cek_storage!='null')
        <button class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#panel"> Tambah Data Storage ?</button>
        {{-- Modal --}}
        <div class="modal fade" id="panel" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="NWModalLabel">Data Storage Baru </h4>
              </div>
              <div class="modal-body" style="overflow-x: scroll;">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilstorage') }}" novalidate>
                  <span class="section">Form Storage</span>
                  <input type='hidden' name='idf' maxlength='45' value='{{$fo->workbook_id}}' class='form-control col-md-7 col-xs-12'>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No.PST</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                      <input type="text" id="spt" name="spt" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Suhu</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                      <select class="form-control" name="suhu" id="suhu">
                        <option type="disabled">---</option>
                        <option value="27">27</option>
                        <option value="37">37</option>
                        <option value="47">47</option>
                      </select>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Estimasi Selesai</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                      <input type="date" id="estimasi" name="estimasi" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                      <button type="reset" class="btn btn-danger">Reset</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                      {{ csrf_field() }}
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div><br><br>
       {{-- Modal selesai --}}
        <table id="myTable" class="table table-hover table-bordered">
          <thead>
            <tr style="background-color:#d8d0d2;">
              <td>No</td>
              <td>No.PST</td>
              <td>Suhu</td>
              <td>Estimasi Selesai</td>
              <td>No.HSA</td>
              <td>Kesimpulan Akhir</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @php $no = 0;  @endphp
            @foreach($storage as $value)
            <tr>
              <td class="text-center" width="3%">{{ ++$no }}</td>
              <td>{{ $value->no_PST }}</td>
              <td>{{ $value->suhu }}</td>
              <td>{{ $value->estimasi_selesai }}</td>
              <td>{{ $value->no_HSA }}</td>
              <td>{{ $value->keterangan }}</td>
              <td width="12%" class="text-center">
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ayo{{$value->id}}"><li class="fa fa-eye"></li></button>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ayoedit{{$value->id}}"><li class="fa fa-edit"></li></button>  
							    <!-- modal info -->
                  <div class="modal fade" id="ayo{{ $value->id }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="NWModalLabel">Info Detail </h4>
                        </div>
                        <div class="modal-body" style="overflow-x: scroll;">
                          <div class="col-md-6 col-sm-6 col-xs-12" >
                            <table id="myTable" class="table table-hover table-bordered">
                              <tr style="background-color:#d8d0d2;">
                                <th class="text-center" width="35%">Tanggal input</th>
                                <th class="text-center">Progress</th>
                              </tr>
                              @foreach($proses as $key => $pr)
                              @if($value->id == $pr->id_storage)
                              <tr>
                                <th>{{ $pr->tgl_input }}</th>
                                <th>{{ $pr->proses }}</th>
                              </tr>
                              @endif
                              @endforeach
                            </table>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12" >
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h2>Data Progress
                                <h2 ><i class="fa fa-clipboard"></i style="margin-left : 700px;"> </h2>
                              </div>
                              <div class="panel-body">
                                <form class="form-horizontal form-label-left" method="POST" action="{{ route('progress') }}" novalidate>
                                <input type="hidden" name="storage" maxlength="45" required="required" value="{{$value->id}}" class="form-control col-md-7 col-xs-12">
                                <input type='hidden' name='idf' maxlength='45' value='{{$fo->id}}' class='form-control col-md-7 col-xs-12'>
                                <div class="item form-group">
                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name">Tanggal</label>
                                  <div class="col-md-10 col-sm-6 col-xs-12">
                                    <input type="date" id="input" name="input" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div><br>
                                <div class="item form-group">
                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name">Progress</label>
                                  <div class="col-md-10 col-sm-6 col-xs-12">
                                    <input type="text" id="progres" name="progres" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-info fa fa-plus"> Submit</button>
                                {{ csrf_field() }}
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal info selesai -->

                  <!-- modal edit -->
                  <div class="modal fade" id="ayoedit{{ $value->id }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="NWModalLabel">Edit Data Storage </h4>
                        </div>
                        <div class="modal-body" style="overflow-x: scroll;">
                          <div class="col-md-12 col-sm-12 col-xs-12" >
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h2><i class="fa fa-edit"> Edit Data</i style="margin-left : 700px;"> </h2>
                              </div>
                              <div class="panel-body">
                                <form class="form-horizontal form-label-left" method="POST" action="{{url('/updatedst')}}/{{$value->id}}" novalidate>
                                <input type="hidden" name="storage" maxlength="45" required="required" value="{{$value->id}}" class="form-control col-md-7 col-xs-12">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No.HSA</label>
                                  <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input type="Text" id="hsa" name="hsa" value="{{ $value->no_HSA}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div> 
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kesimpulan Akhir</label>
                                  <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input type="Text" id="kesimpulan" name="kesimpulan" value="{{ $value->keterangan}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-info fa fa-check"> Simpan perubahan</button>
                                {{ csrf_field() }}
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal edit selesai -->
              </td>	
					  </tr>
				    @endforeach
          </tbody>
        </table>
        @endif
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5"><br>
          <a href="{{ route('showworkbook',$formula->workbook_id) }}" class="btn btn-primary" type="submit"><li class="fa fa-check"></li> Proses Selesai</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection