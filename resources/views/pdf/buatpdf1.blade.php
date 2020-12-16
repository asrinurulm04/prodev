@extends('pv.tempvv')
@section('title', 'Request PDF')
@section('judulhalaman','Form PDF')
@section('content')

<div class="x_panel data">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>PDF</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Mandatory Information</td>
        <td>* : Filled by Marketing</td>
        <td>^ : Filled By PV</td>
        <td>** : Filled by Marketing Or PV</td>
      </tr>
    </table>
  </div>
</div>

<div class="main">
@foreach($pdf as $pdf)
  @if($pdf->status_project=='draf')
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('updatepdf',['pdf_id' => $pdf->pdf_id, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" novalidate>
	@else
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('updatepdf2',['pdf_id' => $pdf->pdf_id, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" novalidate>
  @endif
  <?php $date = Date('j-F-Y'); ?>
  <input id="last_up" value="{{ $date }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-folder-o"></li> Data</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Project Name</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input required value="{{ $pdf->project_name }}" onkeyup="this.value = this.value.toUpperCase()" id="name" class="form-control col-md-12 col-xs-12" type="text" name="name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Brand</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select name="brand" id="brand" class="form-control">
                <option value="{{$pdf->id_brand}}" readonly>{{$pdf->id_brand}}</option>
                @foreach($brand as $brand)
                <option value="{{$brand->brand}}">{{$brand->brand}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="x_panel">
        <div class="x_title">
          <h3 style="color:#258039"><li class="fa fa-edit"></li> Packaging concept**</h3><h5 style="color:red">*requaired</h5>
          <input type="hidden" value="{{ $id_pdf->id_project_pdf }}" name="id">
        </div>
        <div>
          
        <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tabledata">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th colspan="2" width="25%" class="text-center">Forecast</th>
                    <th class="text-center" width="35%">Configuration Concept</th>
                    <th  colspan="2" width="20%" class="text-center">UOM</th>
                    <th width="10%" class="text-center">NFI Price</th>
                    <th width="10%" class="text-center">Costumer Price</th>
                    <th width="5%"></th>
                  </tr>
                </thead>
        				<tbody>
                  @foreach($for as $for)
        				  <tr id='tr_clone'>
                    <td><input type="number" name="forecast[]" value="{{$for->forecast}}" min="0" step="0.0001" width="10%" class="form-control" required></td>
                    <td>
                      <select name="satuan[]" class="form-control items">
                        <option value="{{$for->satuan}}" readonly>{{$for->satuan}}</option>
                        <option value="1 Month">1 Month</option>
                        <option value="2 Month">2 Month</option>
                        <option value="3 Month">3 Month</option>
                      </select>
                    </td>
                    <td class="text-center">
                      <table class='table'>
                        <tr>
                          <td><input name='tersier[]' value="{{$for->kemas->tersier}}" id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>
                          <td>
                            <select class='form-control' name='s_tersier[]' required>
                            <option value="{{$for->kemas->s_tersier}}">{{$for->kemas->s_tersier}}</option>
                            @foreach($data_uom as $data)
                            <option value="{{$data->kode}}">{{$data->kode}}</option>
                            @endforeach
                            </select>
                          </td>
                        </tr>
                        @if($for->kemas->sekunder1!= NULL)
                        <tr>
                          <td><input name='sekunder1[]' value="{{$for->kemas->sekunder1}}" id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>
                          <td>
                            <select class='form-control' name='s_sekunder1[]' required>
                              <option value="{{$for->kemas->s_sekunder1}}">{{$for->kemas->s_sekunder1}}</option>
                              @foreach($data_uom as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        @else
                        <tr hidden>
                          <td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                          <td><input name='s_sekunder1[]' id='s_sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                        </tr>
                        @endif
                        @if($for->kemas->sekunder2!= NULL)
                        <tr>
                          <td><input name='sekunder2[]' id='sekunder2' value="{{$for->kemas->sekunder2}}" class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required>
                          <td>
                            <select class='form-control' name='s_sekunder2[]' required>
                              <option value="{{$for->kemas->s_sekunder2}}">{{$for->kemas->s_sekunder2}}</option>
                              @foreach($data_uom as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        @else
                        <tr hidden>
                          <td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>
                          <td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>
                        </tr>
                        @endif
                        <tr>
                          <td><input name='primer[]' id='primer' value="{{$for->kemas->primer}}" class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                          <td>
                            <select class='form-control' name='s_primer[]'>
                              <option value="{{$for->kemas->s_primer}}">{{$for->kemas->s_primer}}</option>
                              @foreach($uom_primer as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                      </table>
                      <h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>
                      <br><br>
                      <div class='form-group'>
                        <label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>
                        <div class='col-md-10 col-sm-10 col-xs-12'>
                        <input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' value="{{$for->informasi_Primary}}" type='text' required>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>
                        <div class='col-md-10 col-sm-10 col-xs-12'>
                        <input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' value="{{$for->Secondary}}" type='text' required>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>
                        <div class='col-md-10 col-sm-10 col-xs-12'>
                        <input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' value="{{$for->Tertiary}}" type='text' required>
                        </div>
                      </div>
                      <div class='ln_solid'></div>
                    </td>
                    <td><input type="number" value="{{$for->jlh_uom}}" required class="form-control" name="satuan_uom[]" id="satuan_uom"></td>
                    <td>
                      <select name="uom[]" id="UOM" class="form-control">
                        <option value="{{$for->uom}}">{{$for->uom}}</option>
                        @foreach($data_uom as $data)
                        <option value="{{$data->kode}}">{{$data->kode}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="number" value="{{$for->nfi_price}}" required class="form-control" name="price[]" id="price"></td>
                    <td><input type="number" value="{{$for->costumer}}" required class="form-control" name="costumer[]" id="costumer"></td>
                    <td>
                      <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li></button><br><br>
                      <a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>
                    </td>
                  </tr>
                  @endforeach
        					<tr id='addrow1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
            @if($pdf->primery	!=NULL)
            <div class="form-group row">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Primary </label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input name="primary" class="col-md-8 col-sm-12 col-xs-12 form-control" id="" value="{{$pdf->primery	}}">
              </div>
            </div>
            @endif
            @if($pdf->secondery!=NULL)
            <div class="form-group row">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Secondary</label>
              <div class="col-md-8 col-sm-3 col-xs-12">
                <input name="secondary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pdf->secondery}}">
              </div>
            </div>
            @endif
            @if($pdf->Tertiary!=NULL)
            <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Tertiary</label>
            <div class="col-md-8 col-sm-3 col-xs-12">
              <input name="tertiary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pdf->Tertiary}}">
            </div>
          </div>
            @endif 
          <div id="lihat"></div>
          @if($pdf->kemas_eksis!=NULL) <br><br>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Additional data (Optional)</label>
            <div class="col-md-8 col-sm-8 col-xs-12"><br>
              <table class="table table-bordered col-md-12 col-sm-12 col-xs-12" id="tablekemas">
                <thead>
                  <tr>
                    <td class="text-center">Oracle</td>
                    <td class="text-center">KK Code</td>
                    <td class="text-center">Note</td>
                    <td class="text-center" width="14%">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <tr id='addkemas0'>
                  @if($hitungkemaspdf>=1)
                    @foreach($kemaspdf as $kf)
                    @if($kf->oracle!='')
                    <tr>
                      <td><input type="text" name="oracle[]" id="oracle" value="{{$kf->oracle}}" class="form-control"></td>
                      <td><input type="text" name="kk[]" id="kk" value="{{$kf->kk}}" class="form-control"></td>
                      <td><input type="text" name="information[]" id="information" value="{{$kf->information}}" class="form-control"></td>
                      <td class="text-center"><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button>
                      <a hreaf='' type="button" class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>
                    </tr>
                    @endif
                    @endforeach
                  @elseif($hitungkemaspdf==0)
                  <tr>
                    <td><input type="text" name="oracle[]" id="oracle" class="form-control"></td>
                    <td><input type="text" name="kk[]" id="kk" class="form-control"></td>
                    <td><input type="text" name="information[]" id="information" class="form-control"></td>
                    <td class="text-center"><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button>
                    <a hreaf='' type="button" class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>
                  </tr>
                  @endif
                  <tr id='addkemas1'></tr>
                </tbody>
              </table>
            </div>
          </div>
          @endif
          <hr>
        </div>
        
        <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Additional data (Optional)</label>
            <div class="col-md-8 col-sm-8 col-xs-12"><br>
              <table class="table table-bordered col-md-12 col-sm-12 col-xs-12" id="tablekemas">
                <thead>
                  <tr>
                    <td class="text-center">Oracle</td>
                    <td class="text-center">KK Code</td>
                    <td class="text-center">Note</td>
                    <td class="text-center" width="14%">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <tr id='addrow0'>
                  @if($hitungkemaspdf>=1)
                    @foreach($kemaspdf as $kf)
                    <tr>
                      <td><input type="text" name="oracle[]" id="oracle" value="{{$kf->oracle}}" class="form-control"></td>
                      <td><input type="text" name="kk[]" id="kk" value="{{$kf->kk}}" class="form-control"></td>
                      <td><input type="text" name="information[]" id="information" value="{{$kf->information}}" class="form-control"></td>
                      <td class="text-center"><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button>
                      <a hreaf='' type="button" class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>
                    </tr>
                    @endforeach
                  @elseif($hitungkemaspdf==0)
                  <tr>
                    <td><input type="text" name="oracle[]" id="oracle" class="form-control"></td>
                    <td><input type="text" name="kk[]" id="kk" class="form-control"></td>
                    <td><input type="text" name="information[]" id="information" class="form-control"></td>
                    <td class="text-center"><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button>
                    <a hreaf='' type="button" class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>
                  </tr>
                  @endif
                  <tr id='addrow1'></tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file"></li> Project</h3>
        </div>
        <div class="card-block">
        <input type="hidden" value="$pdf->datapdf->edit" name="edit" id="edit">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Age Range**</label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input required value="{{ $pdf->dariusia }}" type="number"  name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input required value="{{ $pdf->sampaiusia }}" type="varchar" name="sampaiumur" id="sampaiumur" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12" style="color:#258039">SES</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <select class="form-control form-control-line" id="select" name="ses[]"   multiple="multiple">
                @foreach($datases as $ses1)
                <option value="{{$ses1->ses}}" selected>{{$ses1->ses}}</option>
                @endforeach
                @foreach ($ses as $ses)
              <option value="{{$ses->ses}}">{{$ses->ses}}</option>   
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Gender</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <select  class="form-control form-control-line" name="gender" >
                <option readonly selected>{{ $pdf->gender }}</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Male & Female">Male & Female</option>
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12" style="color:#258039">Other**</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <input required value="{{ $pdf->other }}" id="other" class="form-control col-md-12 col-xs-12" type="text" name="other">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-edit"></li> Product Concept</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Weight**</label>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->wight }}" id="weight" class="form-control col-md-12 col-xs-12" type="number" name="weight">
            </div>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <select required class="form-control form-control-line" name="serving" >
                <option selected="" value="{{ $pdf->serving }}">{{ $pdf->serving }}</option>
                <option value="gram">Gram</option>
                <option value="ml">ML</option>
              </select>
            </div>
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Target price**</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->target_price }}" id="target_price" class="form-control col-md-12 col-xs-12" type="text" name="target_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Ingredient**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea required value="{{ $pdf->ingredient }}" id="ingredient" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="ingredient" rows="3">{{ $pdf->ingredient }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th class="text-center" >Komponen</th>
                    <th class="text-center" width="15%">Klaim</th>
                    <th class="text-center" width="25%">Detail</th>
                    <th class="text-center" width="20%">Note</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="tr_clone">
                  @foreach($dataklaim as $dk)
                    <td>
                      <select class="form-control items komponen"   name="komponen[]">
                        <option value="{{$dk->id_komponen}}">{{$dk->datakp->komponen}}</option>
                        @foreach($komponen as $kp)
                        <option value="{{ $kp->id }}">{{ $kp->komponen }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <select name="klaim[]" class="form-control items">
                        <option value="{{$dk->id_klaim}}">{{$dk->datakl->klaim}}</option>
                        <option readonly>--> Select One <--</option>
                      </select>
                    </td>
                    <td>
                      <select name="detail[]"  multiple="multiple" class="form-control items">
                        @foreach($datadetail as $dd)
                        @if($dd->id_klaim==$dk->id)
                        <option readonly selected value="{{$dd->id_detail}}">{{$dd->datadl->detail}}{{$dk->id_klaim}}</option>
                        @endif
                        @endforeach
                      </select>
                    </td>
                    <td><textarea type="text" class="form-control" name="ket[]" value="{{$dk->note}}" id="ket">{{$dk->note}}</textarea></td>
                    <td><a href="" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                    <button class="tr_clone_add btn btn-info btn-sm" type="button"><li class="fa fa-plus"></li></button>
                  </tr>
                  @endforeach
                  <tr id='addr0'>
                    <input type="hidden" value="{{$Ddetail}}" name="iddetail" id="iddetail">
                    <td>
                      <select class="form-control items komponen" id="komponen" name="komponen[]">
                        @foreach($komponen as $kp)
                        <option value="{{ $kp->id }}">{{ $kp->komponen }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <select name="klaim[]" class="form-control items" id="klaimm"> </select>
                    </td>
                    <td>
                      <select name="detail[]"  id="detaill" multiple="multiple" class="form-control items"> </select>
                    </td>
                    <td><textarea type="text" class="form-control" name="ket[]" id="ket"></textarea></td>
                    <td><button class="tr_clone_add btn btn-info btn-sm" id="add_row" type="button"><li class="fa fa-plus"></li></button></td>
                  </tr>
                  <tr id='addr1'></tr>
                </tbody>
              </table>
              <label style="color:red;">* Mandatory for CCT request</label>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-folder-open"></li> Data</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Background**</label>
          	<div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->background }}" id="background" placeholder="Backgroung / Insight" class="form-control col-md-12 col-xs-12" type="text" name="background">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Attractiveness**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->	attractiveness }}" id="attractive" class="form-control col-md-12 col-xs-12" type="text" name="attractive">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Target RTO**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->rto }}" id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
	</div>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-group"></li> Competitors</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Name**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->name }}" id="name_competitors" class="form-control col-md-12 col-xs-12" type="text" name="name_competitors">
            </div>
					</div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Retailer Price**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->retailer_price }}" id="retailer_price" class="form-control col-md-12 col-xs-12" type="number" name="retailer_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">What's Special**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->special }}" id="special" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="special">
            </div>
          </div>
          <input type="hidden" value="{{$pdf->datapdf->author1->email}}" name="pengirim1" id="pengirim1">
          @foreach($user as $user)
          @if($user->role_id=='5')
          <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
          <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
          @endif
          @endforeach
          <div class="ln_solid"></div>
          <div class="col-md-6 col-md-offset-5">
            <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
          </div>
        </div>
			</div>
		</div>
	</div>
  </form>
@endforeach
</div>
@endsection
@section('s')
<script>
  $(document).ready(function() {
  // delete baris proses
  $('#tablekemas').on('click', 'tr a', function(e) {
    e.preventDefault();
    $(this).parents('tr').remove();
  });

  var i = 1;
    $("#add_kemas").click(function() {
      $('#addkemas' + i).html( "<td><input type='text' name='oracle[]' id='oracle' class='form-control'>"+
      "<td><input type='text' name='kk[]' id='kk' class='form-control'></td>"+
      "<td><input type='text' name='information[]' id='information' class='form-control'></td>"+
      "<td><a hreaf='' class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>");

      $('#tablekemas').append('<tr id="addkemas' + (i + 1) + '"></tr>');
      i++;
    });
  });
</script>
<script>
    $(document).ready(function() {
  
      var idkomponen = []
    <?php foreach($komponen as $key => $value) { ?>
      if(!idkomponen){
        idkomponen += [ { '<?php echo $key; ?>' : '<?php echo $value->id; ?>', } ];
      } else { idkomponen.push({ '<?php echo $key; ?>' : '<?php echo $value->id; ?>', }) }
    <?php } ?>
  
    var komponen = []
    <?php foreach($komponen as $key => $value) { ?>
      if(!komponen){
        komponen += [ { '<?php echo $key; ?>' : '<?php echo $value->komponen; ?>', } ];
      } else { komponen.push({ '<?php echo $key; ?>' : '<?php echo $value->komponen; ?>', }) }
    <?php } ?>
  
    var komponen1 = '';
      for(var i = 0; i < Object.keys(komponen).length; i++){
      komponen1 += '<option value="'+idkomponen[i][i]+'">'+komponen[i][i]+'</option>';
    }
  
    var i = 1;
    var a = {!! json_encode($Ddetail) !!};
    $("#add_row").click(function() {
      $('#addr' + i).html("<input type='hidden' value='"+(a+i)+"' name='iddetail' id='iddetail'><td><select class='form-control items' name='komponen[]' id='komponen"+(a+i)+"' >"+komponen1+
        "</select></td><td><select name='klaim[]' class='form-control items' id='klaimm"+(a+i)+"'>"+
        "</select></td><td><select name='detail[]' multiple='multiple' class='form-control items' id='detaill"+(a+i)+"'>"+
        "</select></td><td><textarea type='text' class='form-control' name='ket[]' id='ket'></textarea></td><td></td>");
  
        var b = a+i;
        console.log(b);
        $('#komponen' + b).on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
                url: '{{URL::to('getdetail')}}/'+myId,
                type: "GET",
                dataType: "json",
                beforeSend: function(){
                $('#loader').css("visibility", "visible");
            },
  
            success:function(data){
              console.log(data)
                $('#detaill' + b).empty();
                $.each(data, function(key, value){
                  $('#detaill' + b).append('<option value="'+ key +'">' + value + '</option>');
                });
              console.log(data)
              },
              complete: function(){
                $('#loader').css("visibility","hidden");
            }
          });
  
          }
          else{
            $('#detaill' + b).empty();
          }
        });
  
        $('#komponen'+b).on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('getkomponen')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },
  
          success:function(data){
            console.log(data)
              $('#klaimm'+b).empty();
              $.each(data, function(key, value){
                  $('#klaimm'+b).append('<option value="'+ key +'">' + value + '</option>');
              });
          console.log(data)
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });
  
        }
        else{
            $('#klaimm'+b).empty();
        }
    });
      $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
      i++;
    });
  
    $('#komponen').on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('getkomponen')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },
  
          success:function(data){
            console.log(data)
              $('#klaimm').empty();
              $.each(data, function(key, value){
                  $('#klaimm').append('<option value="'+ key +'">' + value + '</option>');
              });
          console.log(data)
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });
  
        }
        else{
            $('#klaimm').empty();
        }
    });
  
    $('#komponen').on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('getdetail')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },
  
          success:function(data){
            console.log(data)
              $('#detaill').empty();
              $.each(data, function(key, value){
                  $('#detaill').append('<option value="'+ key +'">' + value + '</option>');
              });
          console.log(data)
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });
  
        }
        else{
            $('#katbpom').empty();
        }
    });
  
    });
  
  </script>

<script>
  $(document).ready(function() {

  var i = 1;
  $(".add_data").click(function() {
    $('#addrow' + i).html( "<td><input type='number' name='forecast[]' class='form-control'></td><td><select name='satuan[]'  class='form-control'>"+
    "<option disabled selected>--> Select One <--</option>"+
    "<option value='1 Month'>1 Month</option>"+
    "<option value='2 Month'>2 Month</option>"+
    "<option value='3 Month'>3 Month</option>"+
    "</select></td><td><input type='text' name='keterangan[]' class='form-control'></td><td><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li> Delete</a></td>");

    $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    i++;
  });
  });
</script>

<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
  $('#select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

  $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  })
</script>

<script>
  $(document).ready(function() {
    // delete baris proses
    $('#tabledata').on('click', 'tr a', function(e) {
    e.preventDefault();
        $(this).parents('tr').remove();
    });
  });

  var uom_primer = []
  <?php foreach($uom_primer as $key => $value) { ?>
  if(!uom_primer){
    uom_primer += [ { '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', } ];
  } else { uom_primer.push({ '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', }) }
  <?php } ?>

  var pilihan_uom_primer = '';
  for(var i = 0; i < Object.keys(uom_primer).length; i++){
    pilihan_uom_primer += '<option value="'+uom_primer[i][i]+'">'+uom_primer[i][i]+'</option>';
  }

  var data_uom = []
  <?php foreach($data_uom as $key => $value) { ?>
    if(!data_uom){
      data_uom += [ { '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', } ];
    } else { data_uom.push({ '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', }) }
  <?php } ?>

  var datauom = '';
    for(var i = 0; i < Object.keys(data_uom).length; i++){
      datauom += '<option value="'+data_uom[i][i]+'">'+data_uom[i][i]+'</option>';
  }

  var i = 1;
  $("#add_data").click(function() {
    $('#addrow' + i).html( 
    "<td><input type='number' required name='forecast[]' class='form-control'></td>"+
    "<td>"+
      "<select name='satuan[]' class='form-control items'>"+
        "<option value='1 Month'>1 Month</option>"+
        "<option value='2 Month'>2 Month</option>"+
        "<option value='3 Month'>3 Month</option>"+
      "</select>"+
    "</td>"+
    "<td class='text-center'>"+
      '<input type="radio" name="gramasi'+(i+1)+'[]" required id="rad'+(i+1)+'" value="pertama'+(i+1)+'" class="rad"/> 2 Dimensi &nbsp'+
      '<input type="radio" name="gramasi'+(i+1)+'[]" required id="rad'+(i+1)+'" value="kedua'+(i+1)+'" class="rad"/> 3 Dimensi &nbsp'+
      '<input type="radio" name="gramasi'+(i+1)+'[]" required id="rad'+(i+1)+'" value="ketiga'+(i+1)+'" class="rad"/> 4 Dimensi &nbsp'+
			"<div id='tampil"+(i+1)+"'></div>"+
    "</td>"+
    "<td><input type='number' class='form-control' required name='satuan_uom[]' id='satuan_uom'></td>"+
    "<td>"+
      "<select name='uom[]' id='UOM' class='form-control'>"+datauom+"</select>"+
    "</td>"+
    "<td><input type='number' class='form-control' required name='price[]' id='price'></td>"+
    "<td><input type='number' class='form-control' required name='costumer[]' id='costumer'></td>)"+
    "<td><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a></td>");

      $(function(){
				$(":radio.rad").click(function(){
					if($(this).val() == "pertama"+i){
						document.getElementById('tampil'+i).innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+datauom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td><input name='s_sekunder1[]' id='s_sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
                "<td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}

          if($(this).val() == "kedua"+i){
						document.getElementById('tampil'+i).innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+datauom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder1[]' required>"+datauom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
                "<td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}

          if($(this).val() == "ketiga"+i){
						document.getElementById('tampil'+i).innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+datauom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder1[]' required>"+datauom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder2[]' required>"+datauom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}
				});
			});

    $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    i++;
  });
</script>
<script src="{{ asset('js/asrul.js') }}"></script>
@endsection