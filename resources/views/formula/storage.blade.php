@extends('pv.tempvv')
@section('title', 'PRODEV|Data Storage')
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

<div class="col-md-12 col-sm-12 col-xs-12 content-panel">
  <div class="x_panel panel-default">
    <div id="" class="container">	
      <div class="x_title">
        <h4><li class="fa fa-flask"></li> Storage</h4>
      </div>
      <div class="panel-body">
        <div class="form-group">
          @if(auth()->user()->role->namaRule != 'pv_global' && auth()->user()->role->namaRule != 'pv_lokal')
            @if($cek_storage=='0')
            <div class="col-md-12 col-sm-12 col-xs-12">
              <form method="post" class="form-horizontal form-label-left" action="{{route('hasilstorage')}}" enctype="multipart/form-data">
                <input type='hidden' name='idf' maxlength='45' value='{{$formula->id}}' class='form-control col-md-7 col-xs-12'>
                <input type='hidden' name='wb' maxlength='45' value='{{$formula->workbook_id}}' class='form-control col-md-7 col-xs-12'>
                <input type='hidden' name='wb_pdf' maxlength='45' value='{{$formula->workbook_pdf_id}}' class='form-control col-md-7 col-xs-12'>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No.PST *</label>
                  <div class="col-md-6 col-sm-8 col-xs-12">
                    <input type="text" id="spt" name="spt" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Suhu *</label>
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Estimasi Selesai *</label>
                  <div class="col-md-6 col-sm-8 col-xs-12">
                    <input type="date" id="estimasi" name="estimasi" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File</label>
                  <div class="col-md-6 col-sm-8 col-xs-12">
                    <input type="file" class="form-control" id="data" name="filename">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-5 col-sm-offset-5">
                    @if($formula->workbook_id!=NULL)
                    <a href="{{ route('rekappkp',[$pkp,$id]) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-ban"></li> Back To Home</a>
                    @elseif($formula->workbook_pdf_id!=NULL)
                    <a href="{{ route('rekappdf',$formula->workbook_pdf_id) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-ban"></li> Back To Home</a>
                    @endif
                    <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
                    <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                    {{ csrf_field() }}
                  </div>
                </div>
              </form>
            </div>
            @elseif($cek_storage!='null')
            <div class="col-md-12 col-sm-12 col-xs-12 text-right">
              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#panel"><li class="fa fa-plus"></li> New Storage</button>
              @if($formula->workbook_id!=NULL)
              <a href="{{ route('rekappkp',[$pkp,$id]) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-ban"></li> Back To Home</a>
              @elseif($formula->workbook_pdf_id!=NULL)
              <a href="{{ route('rekappdf',$formula->workbook_pdf_id) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-ban"></li> Back To Home</a>
              @endif
            </div>
            <!-- Modal -->
            <div class="modal fade" id="panel" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilstorage') }}" enctype="multipart/form-data">
                      <span class="section">Form Storage</span>
                      <input type='hidden' name='idf' maxlength='45' value='{{$formula->id}}' class='form-control col-md-7 col-xs-12'>
                      <input type='hidden' name='wb' maxlength='45' value='{{$formula->workbook_id}}' class='form-control col-md-7 col-xs-12'>
                      <input type='hidden' name='wb_pdf' maxlength='45' value='{{$formula->workbook_pdf_id}}' class='form-control col-md-7 col-xs-12'>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No.PST</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" id="spt" name="spt" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Suhu</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
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
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="date" id="estimasi" name="estimasi" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="file" class="form-control" id="data" name="filename">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-md-offset-5">
                          <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
                          <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                          {{ csrf_field() }}
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><br><br>
            <!-- Modal Selesai -->
            <table id="myTable" class="table table-hover table-bordered">
              <thead>
                <tr style="background-color:#d8d0d2;">
                  <th class="text-center">No</th>
                  <th class="text-center">No.PST</th>
                  <th class="text-center">Suhu</th>
                  <th class="text-center">Estimasi Selesai</th>
                  <th class="text-center">No.HSA</th>
                  <th class="text-center">Kesimpulan Akhir</th>
                  <th class="text-center">Tanggal Selesai</th>
                  <th class="text-center" width="20%">File</th>
                  <th class="text-center">Action</th>
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
                  <td>{{ $value->selesai }}</td>
                  <td>
                    <table>
                      <tr>
                        <td>@if($value->data_file!=NULL)<a href="{{asset('data_file/'.$value->data_file)}}" download="{{$value->data_file}}" title="download file"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a>@endif</td>
                        <td> {{ $value->data_file }}</td>
                      </tr>
                    </table>
                  </td>
                  <td width="13%" class="text-center">
                    @if($value->status=='proses')
                    <a href="{{ route('ajukanstorage',[$formula->id,$value->id]) }}" class="btn btn-primary btn-sm" title="Done" type="submit"><li class="fa fa-check"></li></a>
                    <button class="btn btn-warning btn-sm" title="Edit" data-toggle="modal" data-target="#ayoedit{{$value->id}}"><li class="fa fa-edit"></li></button>  
                    @endif
                    <a href="{{route('deletest',$value->id)}}" title="Delete" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>    
                    <!-- modal edit -->
                    <div class="modal fade" id="ayoedit{{ $value->id }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="NWModalLabel">Edit Data Storage </h4>
                          </div>
                          <div class="modal-body" >
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Selesai</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                  <input type="date" id="selesai" name="selesai" value="{{ $value->selesai}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kesimpulan Akhir</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                  <input type="Text" id="kesimpulan" name="kesimpulan" value="{{ $value->keterangan}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="text-center">
                                  <button type="submit" class="btn btn-info fa fa-check"> Simpan perubahan</button>
                                  {{ csrf_field() }}
                                </div>
                              </div>
                              </form>
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
            <div class="text-center"><br>
            </div>
            @endif
          @else
            <table id="myTable" class="table table-hover table-bordered">
              <thead>
                <tr style="background-color:#d8d0d2;">
                  <td>No</td>
                  <td>No.PST</td>
                  <td>Suhu</td>
                  <td>Estimasi Selesai</td>
                  <td>No.HSA</td>
                  <td>Kesimpulan Akhir</td>
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
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5"><br>
              <a href="{{ route('rekappkp',[$pkp,$id]) }}" class="btn btn-danger" type="submit"><li class="fa fa-sign-out"></li> Kembali</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection