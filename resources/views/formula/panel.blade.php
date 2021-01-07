@extends('pv.tempvv')
@section('title', 'PRODEV|Data Panel')
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
        <h4><li class="fa fa-glass"></li> Panel</h4>
      </div>
      <div class="panel-body">
        <div class="form-group">
        @if(auth()->user()->role->namaRule != 'pv_global' && auth()->user()->role->namaRule != 'pv_lokal')
          @if($cek_panel=='null')
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilpanel') }}">
              <span class="section">Form Panel</span>
              <input type='hidden' name='idf' maxlength='45' value='{{$myFormula->id}}' class='form-control col-md-7 col-xs-12'>
              <input type='hidden' name='wb' maxlength='45' value='{{$myFormula->workbook_id}}' class='form-control col-md-7 col-xs-12'>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Panel</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" id="date" name="date" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pilih Panel</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" required="required" name="panel" id="panel">
                    <option value="">---</option>
                    @foreach ($panel as $keys => $value)
                    <option value="{{$value->id}}">{{$value->panel}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">HUS</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="hus" type="text"name="hus" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12"  required="required" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Kesimpulan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="kesimpulan" required="required" name="kesimpulan" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4 col-sm-offset-4">
                  <a href="" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-circle-left"></li> Back</a>
                  <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
                  <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                  {{ csrf_field() }}
                </div>
              </div>
            </form>
          </div>
          @elseif($cek_panel!=0)
          <div class="col-md-12 col-sm-12 col-xs-12 text-right">
          <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#panel"><li class="fa fa-plus"></li> Add Data Panel</button>
          @if($myFormula->workbook_id!=NULL)
          <a href="{{ route('rekappkp',$myFormula->workbook_id) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-share"></li> Back To Home</a>
          @elseif($myFormula->workbook_pdf_id!=NULL)
          <a href="{{ route('rekappdf',$myFormula->workbook_pdf_id) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-share"></li> Back To Home</a>
          @endif
          </div>
          <!-- Modal -->
          <div class="modal fade" id="panel" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="NWModalLabel">New Panel</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilpanel') }}" novalidate>
                    <input type='hidden' name='idf' maxlength='45' value='{{$myFormula->id}}' class='form-control col-md-7 col-xs-12'>
                    <input type='hidden' name='wb' maxlength='45' value='{{$myFormula->workbook_id}}' class='form-control col-md-7 col-xs-12'>
                    <input type='hidden' name='wb_pdf' maxlength='45' value='{{$myFormula->workbook_pdf_id}}' class='form-control col-md-7 col-xs-12'>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Panel</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="date" id="date" name="date" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pilih Panel</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="form-control"  required="required" name="panel" id="panel">
                          <option value="">---</option>
                          @foreach ($panel as $keys => $value)
                          <option value="{{$value->id}}">{{$value->panel}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">HUS</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input id="hus" type="text" name="hus" required="required" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Kesimpulan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea id="kesimpulan" required="required" name="kesimpulan" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-5">
                        <button type="reset" class="btn btn-warning btn-sm">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
            <tr style="background-color:#d8d0d2;">
              <th width="5%" class="text-center">No</th>
              <th class="text-center">Tanggal Panel</th>
              <th class="text-center">Jenis Panel</th>
              <th class="text-center">HUS</th>
              <th class="text-center">kesimpulan</th>
              <th class="text-center">Action</th>
            </tr>
            @php $no = 0; @endphp
            @foreach($pn as $pn)
            <tr>
              <td class="text-center">{{ ++$no}}</td>
              <td width="10%" class="text-center">{{ $pn->tgl_panel }}</td>
              <td width="14%">{{ $pn->panel }}</td>
              <td>{{ $pn->hus }}</td>		
              <td>{{ $pn->kesimpulan }}</td>
              <td width="15%" class="text-center">
                @if($pn->status=='proses')
                @if($pn->id_wb!=NULL)
                <a href="{{ route('ajukanpanel',[$pn->id_wb,$pn->id]) }}" class="btn btn-sm btn-primary" title="Done"><li class="fa fa-check"></li></a>
                @elseif($pn->id_wb_pdf!=NULL)
                <a href="{{ route('ajukanpanel',[$pn->id_wb_pdf,$pn->id]) }}" class="btn btn-sm btn-primary" title="Done"><li class="fa fa-check"></li></a>
                @endif
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{$pn->id}}" title="Edit"><li class=" fa fa-edit"></li></button>
                <!-- modal -->
                <div class="modal fade" id="edit{{ $pn->id }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body" style="overflow-x: scroll;">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ route('editpanel',$pn->id) }}" novalidate>
                          <span class="section">Edit Panel</span>
                          <input type='hidden' name='idf' maxlength='45' value='$myFormula->id' class='form-control col-md-7 col-xs-12'>
                          <input type='hidden' name='wb' maxlength='45' value='$myFormula->workbook_id' class='form-control col-md-7 col-xs-12'>
                          <input type='hidden' name='wb_pdf' maxlength='45' value='$myFormula->workbook_pdf_id' class='form-control col-md-7 col-xs-12'>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Panel</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" value="{{$pn->tgl_panel}}" id="date" name="date" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pilih Panel</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select class="form-control" name="panel" id="panel">
                                <option value="{{$pn->panel}}">{{$pn->panel}}</option>
                                @foreach ($panel as $keys => $value)
                                <option value="{{$value->id}}">{{$value->panel}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">HUS</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <input id="hus" type="text" name="hus" value="{{$pn->hus}}" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Kesimpulan</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <textarea id="kesimpulan" required="required" value="{{$pn->kesimpulan}}" name="kesimpulan" class="form-control col-md-7 col-xs-12">{{$pn->kesimpulan}}</textarea>
                            </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                              <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
                              <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                              {{ csrf_field() }}
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                <a href="{{route('deletepanel',$pn->id)}}" class="btn btn-sm btn-danger" title="Delete"><li class="fa fa-trash"></li></a>
              </td>	
            </tr>
            @endforeach	
          </table>
          @endif
        @else
          <table id="myTable" class="table table-hover table-bordered">
            <tr style="background-color:#d8d0d2;">
              <th class="text-center">No</th>
              <th class="text-center">Tanggal Panel</th>
              <th class="text-center">Jenis Panel</th>
              <th class="text-center">Formula</th>
              <th class="text-center">HUS</th>
              <th class="text-center">kesimpulan</th>
            </tr>
            @php $no = 0; @endphp
            @foreach($pn as $pn)
            <tr>
              <td>{{ ++$no}}</td>
              <td width="10%" class="text-center">{{ $pn->tgl_panel }}</td>
              <td width="14%">{{ $pn->panel }}</td>
              <td width="20%">{{ $pn->formula }}</td>
              <td>{{ $pn->hus }}</td>		
              <td>{{ $pn->kesimpulan }}</td>
            </tr>
            @endforeach	
          </table>  
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section ('s')
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
@endsection