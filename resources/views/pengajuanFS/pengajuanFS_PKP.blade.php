@extends('layout.tempvv')
@section('title', 'Form Pengajuan FS')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
  		<div class="x_title">
    		<h2><li class="fa fa-star"></li> Form Pengajuan Feasibility</h2>
    		<div class="clearfix"></div>
  		</div>
  		<div class="x_content">
        <form class="form-horizontal form-label-left" method="POST" action="{{ route('ajukanPKP',[$pkp->id_project,$for->id]) }}">
          <div class="field item form-group">
            <?php $last = Date('j-F-Y'); ?>
            <input id="create" value="{{ $last }}"type="hidden" name="create">
            <label class="col-form-label col-md-2 col-sm-2  label-align">Project Name</label>
            <div class="col-md-8 col-sm-8">
              <input class="form-control" value="{{$pkp->project_name}}" name="name" required="required" readonly/>
            </div>
          </div>
          <div class="field item form-group">
            <label class="col-form-label col-md-2 col-sm-2  label-align">Nama Formula</label>
            <div class="col-md-3 col-sm-3"><input class="form-control" value="{{$for->formula}}" type="text" readonly/></div>
            <label class="col-form-label col-md-2 col-sm-2  label-align">Target Launch</label>
            <div class="col-md-3 col-sm-3"><input class="form-control" value="{{$pkp->launch}} {{$pkp->years}}" type="text" readonly/></div>
          </div>
          <div class="field item form-group">
            <label class="col-form-label col-md-2 col-sm-2  label-align">Product Desc<span class="required">*</span></label>
            <div class="col-md-8 col-sm-8"><input class="form-control" value="{{$pkp->idea}}" name="idea" required="required" type="text" /></div>
          </div>
          <div class="field item form-group">
            <label class="col-form-label col-md-2 col-sm-2  label-align">BPOM<span class="required">*</span></label>
            <div class="col-md-2 col-sm-2"><input readonly class="form-control" type="text" name="bpom" value="{{$pkp->katpangan->no_kategori}}" required='required' /></div>
            <label class="col-form-label col-md-1 col-sm-1  label-align">Category<span class="required">*</span></label>
            <div class="col-md-5 col-sm-5"><input readonly class="form-control" type="text" name="category" value="{{$pkp->katpangan->pangan}}" required='required' /></div>
          </div><hr>
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
                          <td><input name='tersier' value="{{$pkp->kemas->tersier}}" id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>
                          <td>
                            <select class='form-control' name='s_tersier' required>
                            <option value="{{$pkp->kemas->s_tersier}}">{{$pkp->kemas->s_tersier}}</option>
                            @foreach($uom as $data)
                            <option value="{{$data->kode}}">{{$data->kode}}</option>
                            @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><input name='sekunder1' value="{{$pkp->kemas->sekunder1}}" id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                          <td>
                            <select class='form-control' name='s_sekunder1'>
                              <option value="{{$pkp->kemas->s_sekunder1}}">{{$pkp->kemas->s_sekunder1}}</option>
                              @foreach($uom as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><input name='sekunder2' id='sekunder2' value="{{$pkp->kemas->sekunder2}}" class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>
                          <td>
                            <select class='form-control' name='s_sekunder2'>
                              <option value="{{$pkp->kemas->s_sekunder2}}">{{$pkp->kemas->s_sekunder2}}</option>
                              @foreach($uom as $data)
                              <option value="{{$data->kode}}">{{$data->kode}}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><input name='primer' id='primer' value="{{$pkp->kemas->primer}}" class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>
                          <td>
                            <select class='form-control' name='s_primer'>
                              <option value="{{$pkp->kemas->s_primer}}">{{$pkp->kemas->s_primer}}</option>
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
                        <tr><th>Primary</th><td> <input name='primary' id='primary' class='form-control col-md-12 col-xs-12' value="{{$pkp->primery}}" type='text' required></td></tr>
                        <tr><th>Secondary</th><td> <input name='secondary' id='secondary' class='form-control col-md-12 col-xs-12' value="{{$pkp->secondary}}" type='text' required></td></tr>
                        <tr><th>Tertiary</th><td> <input name='tertiary' id='tertiary' class='form-control col-md-12 col-xs-12' value="{{$pkp->tertiary}}" type='text' required></td></tr>
                      </table>
                    </td>
                    <td><input type="text" value="{{$pkp->UOM}}" required class="form-control" name="uom" id="uom"></td>
                    <td><input type="number" value="{{$pkp->selling_price}}" required class="form-control" name="selling" id="selling"></td>
                    <td><input type="number" value="{{$pkp->price}}" required class="form-control" name="price" id="price"></td>
                  </tr>
        					<tr id='addrow1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
        	<div class="col-md-6 col-md-offset-5">
            <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
            @if($for->status_feasibility=='' || $for->status_feasibility=='reject')
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-paper-plane"></li> Ajukan FS</button>
            {{ csrf_field() }}
            @elseif($for->status_feasibility!='' || $for->status_feasibility!='reject')
            <a href="{{route('BatalAjukanFS',[$pkp->id_project,$for->id])}}" type="button" class="btn btn-danger btn-sm"><li class="fa fa-times"></li> Batalkan Pengajuan</a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection