@extends('layout.tempvv')
@section('title', 'PRODEV|Data Lab')
@section('content')

<div class="row">
  @if (session('status'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
  @endif
</div>

<!-- Kategori -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Item Desc</li></h3>
  </div>
  <div class="card-block">
    <div class="dt-responsive table-responsive">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th width="5%" class="text-center">#</th>
            <th class="text-center">Item desc</th>
            <th class="text-center">IO</th>
            <th class="text-center">Lokasi</th>
            <th width="15%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($item as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->item_desc }}</td>
          <td>{{ $item->io }}</td>
          <td>{{ $item->lokasi }}</td>
          <td class="center">
            <button class="btn-warning btn-sm" data-toggle="modal" data-target="#edit_satuan{{ $item->id }}" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></a></button>
            <button class="btn-sm btn-danger" onclick="return confirm('Hapus Kategori ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
            {!! Form::close() !!}
          </td>
        </tr>
        <!-- Edit  -->
        <div class="modal fade" id="edit_satuan{{ $item->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Item Desc
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('editItem',$item->id) }}">
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">IO**</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select name="io" id="io" class="form-control">
                        <option value="{{$item->io}}">{{$item->io}}</option>
                        @foreach($io as $data)
                        <option value="{{$data->io}}">{{$data->io}}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Lokasi**</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input required="required" id="lokasi" required value="{{$item->lokasi}}" class="form-control col-md-12 col-xs-12" type="text" name="lokasi">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Item Desc**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="item_desc" required value="{{$item->item_desc}}" class="form-control col-md-12 col-xs-12" type="text" name="item_desc">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Biaya analisa tahunan**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="biaya_analisa_tahun" required value="{{$item->biaya_analisa_tahun}}" class="form-control col-md-12 col-xs-12" type="text" name="biaya_analisa_tahun">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Biaya mikro analisa BB/batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="mikro_analisa" required value="{{$item->mikro_analisa}}" class="form-control col-md-12 col-xs-12" type="text" name="mikro_analisa">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">para x spl (BB) per batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="spl_batch" required value="{{$item->spl_batch}}" class="form-control col-md-12 col-xs-12" type="text" name="spl_batch">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">biaya analisa swab per batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="analisa_swab" required value="{{$item->analisa_swab}}" class="form-control col-md-12 col-xs-12" type="text" name="analisa_swab">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">para x sampel (swab) per batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="sample_swab" required value="{{$item->sample_swab}}" class="form-control col-md-12 col-xs-12" type="text" name="sample_swab">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">biaya tahanan per batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="biaya_tahanan" required value="{{$item->biaya_tahanan}}" class="form-control col-md-12 col-xs-12" type="text" name="biaya_tahanan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Parameter mikro**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="parameter_mikro" required value="{{$item->parameter_mikro}}" class="form-control col-md-12 col-xs-12" type="text" name="parameter_mikro">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Biaya kimia per batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="kimia_batch" required value="{{$item->kimia_batch}}" class="form-control col-md-12 col-xs-12" type="text" name="kimia_batch">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">para x sampel analisa rutin**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="sample_analisa" required value="{{$item->sample_analisa}}" class="form-control col-md-12 col-xs-12" type="text" name="sample_analisa">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Biaya analisa mikro rutin**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="biaya_analisa" required value="{{$item->biaya_analisa}}" class="form-control col-md-12 col-xs-12" type="text" name="biaya_analisa">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Jumlah sampel mikro/batch**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="jlh_sample_mikro" required value="{{$item->jlh_sample_mikro}}" class="form-control col-md-12 col-xs-12" type="text" name="jlh_sample_mikro">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12"> Jumlah sampel mikro tahunan**</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input required="required" id="jlh_mikro_tahunan" required value="{{$item->jlh_mikro_tahunan}}" class="form-control col-md-12 col-xs-12" type="text" name="jlh_mikro_tahunan">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                {{ csrf_field() }}
                </form>
              </div>   
            </div>
          </div>
        </div>
        <!-- selesai -->
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection