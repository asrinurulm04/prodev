@extends('layout.tempvv')
@section('title', 'Form Pengajuan FS')
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
  <div class="col-md-12" align="right">
    <div class="x_panel">
      <a class="btn btn-info btn-sm" href="{{ Route('lihatpdf',['pdf_id' => $pdf->pdf_id,'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> PDF</a>
      <a class="btn btn-danger btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf) }}" data-toggle="tooltip" title="Show"><li class="fa fa-arrow-left"></li> Back</a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
  		<div class="x_title">
    		<h2><li class="fa fa-star"></li> Form Pengajuan Feasibility</h2>
    		<div class="clearfix"></div>
  		</div>
  		<div class="x_content">
        <form class="form-horizontal form-label-left" method="POST" action="{{ route('ajukanPDF',[$pdf->id_project_pdf,$for->id]) }}">
          <div class="field item form-group">
            <?php $last = Date('j-F-Y'); ?>
            <input id="create" value="{{ $last }}"type="hidden" name="create">
            <label class="col-form-label col-md-2 col-sm-2  label-align">Nama Formula</label>
            <div class="col-md-3 col-sm-3"><input class="form-control" value="{{$for->formula}}" type="text" readonly/></div>
            <label class="col-form-label col-md-2 col-sm-2  label-align">Project Name</label>
            <div class="col-md-3 col-sm-3"><input class="form-control" value="{{$pdf->project_name}}" name="name" required="required" readonly/></div>
          </div>
          <div class="field item form-group">
            <label class="col-form-label col-md-2 col-sm-2  label-align">Product Desc<span class="required">*</span></label>
            <div class="col-md-8 col-sm-8"><input class="form-control" value="{{$pdf->background}}" name="idea" required="required" type="text" /></div>
          </div>
          <div class="field item form-group">
            <label class="col-form-label col-md-2 col-sm-2  label-align">Note<span class="required">*</span></label>
            @if($hitung=='0')
            <div class="col-md-8 col-sm-8"><textarea name="note" id="note" rows="3" class="col-md-12 col-sm-12"></textarea></div>
            @elseif($hitung!='0')
            <div class="col-md-8 col-sm-8"><textarea value="{{$note->note}}" name="note" id="note" rows="3" class="col-md-12 col-sm-12">{{$note->note}}</textarea></div>
            @endif
          </div><hr>
          @if($for->status_feasibility=='proses' || $for->status_feasibility=='reject' || $for->status_feasibility=='')
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tabledata">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th width="25%" class="text-center">Forecast</th>
                    <th class="text-center" width="35%">Configuration Concept</th>
                    <th  width="20%" class="text-center">UOM</th>
                    <th width="10%" class="text-center">NFI Price</th>
                    <th width="10%" class="text-center">Costumer Price</th>
                  </tr>
                </thead>
        				<tbody>
        				  <tr id='tr_clone'>
                    <td>
                      <table class="table table-bordered table-hover">
                        @foreach($fch as $fch)
                        <tr>
                          <td><input type="number" name="forecast[]" value="{{$fch->forecast}}" width="10%" class="form-control" required></td>
                          <td><input type="text" readonly name="satuan[]" value="{{$fch->satuan}}" class="form-control" required></td>
                        </tr>
                        @endforeach
                      </table>
                    </td>
                    <td class="text-center">
                      <table class='table'>
                        <tr>
                          <td><input name='tersier' value="{{$pdf->kemas->tersier}}" id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>
                          <td>
                            <select class='form-control' name='s_tersier' required>
                            <option value="{{$pdf->kemas->s_tersier}}">{{$pdf->kemas->s_tersier}}</option>
                            @foreach($uom as $data)
                            <option value="{{$data->kode}}">{{$data->kode}}</option>
                            @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><input name='sekunder1' value="{{$pdf->kemas->sekunder1}}" id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                          <td>
                            <select class='form-control' name='s_sekunder1'>
                              <option value="{{$pdf->kemas->s_sekunder1}}">{{$pdf->kemas->s_sekunder1}}</option>
                              @foreach($uom as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><input name='sekunder2' id='sekunder2' value="{{$pdf->kemas->sekunder2}}" class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>
                          <td>
                            <select class='form-control' name='s_sekunder2'>
                              <option value="{{$pdf->kemas->s_sekunder2}}">{{$pdf->kemas->s_sekunder2}}</option>
                              @foreach($uom as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><input name='primer' id='primer' value="{{$pdf->kemas->primer}}" class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                          <td>
                            <select class='form-control' name='s_primer'>
                              <option value="{{$pdf->kemas->s_primer}}">{{$pdf->kemas->s_primer}}</option>
                              @foreach($uom_primer as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                      </table>
                      <h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>
                      <br><br>
                      <table class="table table-bordered">
                        <tr><th>Primary</th><td> <input name='primary' id='primary' class='form-control col-md-12 col-xs-12' value="{{$pdf->primery}}" type='text'></td></tr>
                        <tr><th>Secondary</th><td> <input name='secondary' id='secondary' class='form-control col-md-12 col-xs-12' value="{{$pdf->secondery}}" type='text'></td></tr>
                        <tr><th>Tertiary</th><td> <input name='tertiary' id='tertiary' class='form-control col-md-12 col-xs-12' value="{{$pdf->Tertiary}}" type='text'></td></tr>
                      </table>
                    </td>
                    <td>
                      <select name="uom" id="uom" required class="form-control">
                        <option value="{{$kemas->s_tersier}}">{{$kemas->s_tersier}}</option>
                        @if($kemas->s_sekunder1!=NULL)
                        <option value="{{$kemas->s_sekunder1}}">{{$kemas->s_sekunder1}}</option>
                        @endif
                        @if($kemas->s_sekunder2!=NULL)
                        <option value="{{$kemas->s_sekunder2}}">{{$kemas->s_sekunder2}}</option>
                        @endif
                        <option value="{{$kemas->s_primer}}">{{$kemas->s_primer}}</option>
                      </select>
                    </td>
                    <td><input type="number" value="{{$pdf->target_price}}" required class="form-control" name="target_price" id="target_price"></td>
                    <td><input type="number" value="{{$pdf->retailer_price}}" required class="form-control" name="retailer_price" id="retailer_price"></td>
                  </tr>
        					<tr id='addrow1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
          @endif
        	<div class="col-md-6 col-md-offset-5">
            @if($for->status_feasibility=='' || $for->status_feasibility=='reject')
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-paper-plane"></li> Ajukan FS</button>
            {{ csrf_field() }}
            @elseif($for->status_feasibility=='proses')
            <a href="{{route('BatalAjukanFS_PDF',[$pdf->id_project_pdf,$for->id])}}" type="button" class="btn btn-danger btn-sm"><li class="fa fa-times"></li> Batalkan Pengajuan</a>
            @endif
          </div>
        </form>
        @if($for->status_feasibility=='sent' || $for->status_feasibility=='done')
          <div class="form-group row">
            <table class="table table-bordered">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <td class="text-center" width="8%">Versi</td>
                  <td class="text-center">Note PV</td>
                  <td class="text-center">Note FS</td>
                  <td class="text-center">Date</td>
                  <td class="text-center" width="10%">Status</td>
                  <td class="text-center" width="15%"></td>
                </tr>
              </thead>
              <tbody>
                @foreach($fs as $fs)
                <tr>
                  <td class="text-center">{{$fs->revisi}}.{{$fs->revisi_kemas}}.{{$fs->revisi_proses}}.{{$fs->revisi_lab}}</td>
                  <td>{{$fs->note_approve}}</td>
                  <td>{{$fs->note_proses}}</td>
                  <td>{{$fs->tgl_kirim}}</td>
                  <td class="text-center">
                    @if($fs->status=='approve')    <span class="label label-success" style="color:white">Approve</span>
                    @elseif($fs->status=='reject') <span class="label label-danger" style="color:white">Reject</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{route('overviewpdf',$fs->id)}}" class="btn btn-sm btn-info" title="Show"><li class='fa fa-eye'></li></a>
                    @if($fs->status=='')
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectfs{{ $fs->id  }}" title="Reject"><li class="fa fa-times"></li></a>  
                    <!-- Modal Reject FS-->
                    <div class="modal" id="rejectfs{{ $fs->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Reject Feasibility
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button></h3>
                          </div>
                          
                          <div class="modal-body">
                            <form class="form-horizontal form-label-left" method="POST" action="{{route('tolakfs',$fs->id)}}">
                            <input id="type" value="PDF "type="hidden" name="type">
                            <?php $date = Date('j-F-Y'); ?>
                            <input id="tgl" value="{{ $date }}"type="hidden" name="tgl">
                            <textarea name="note" id="note" rows="2" cols="60" class="form-control" required></textarea><br>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" type="submit"><li class="fa fa-check"></li> submit</button>
                            {{ csrf_field() }}
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Selesai -->
                    <button class="btn btn-success btn-sm" title="Approve" data-toggle="modal" data-target="#fs{{ $fs->id  }}"><i class="fa fa-check"></i></a></button>
                    <!-- Modal Approve FS -->
                    <div class="modal" id="fs{{ $fs->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Approve Feasibility
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button></h3>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal form-label-left" method="POST" action="{{route('approvefs',$fs->id)}}">
                            <input id="type" value="PDF "type="hidden" name="type">
                            <?php $date = Date('j-F-Y'); ?>
                            <input id="tgl" value="{{ $date }}"type="hidden" name="tgl">
                            <textarea name="note" id="note" cols="60" rows="2" class="form-control" required></textarea><br>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" type="submit"><li class="fa fa-check"></li> submit</button>
                            {{ csrf_field() }}
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Selesai -->
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection