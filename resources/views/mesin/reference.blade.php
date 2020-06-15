@extends('mesin.tempmesin')

@section('title', 'feasibility|Inputor')

@section('judulnya', 'List Feasibility')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12 form-panel">

<!-- search reference data -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h2>Search References</h2>
  </div>
  <div>
    <div><br>
    <p ALIGN="center"><a href="{{ route('myFeasibility',$id) }}" class="btn btn-danger fa fa-mail-reply-all" type="button" ata-toggle="tooltip" data-placement="top" title="kembali"> Back</a>
    @foreach($dataF as $dF) <a href="{{ route('datamesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-theme fa fa-hand-o-right" type="button" ata-toggle="tooltip" data-placement="top" title="tambah baru"> Next</a></p>
    @endforeach
    <table id="ex" class="table table-bordered">
        <thead>
          <tr>
            <th>Formula</th>
            <th class="hidden-phone">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($data as $key => $value)
          @if(!empty($data[$key+1]) && $data[$key+1]->id_feasibility == $value->id_feasibility)
            @php
            continue;
            @endphp
          @endif
          @if($value->status_mesin=='selesai')
            <td>{{ $value->nama_produk}}</td>
            <td class="text-center" width="25%">
            <!-- Lihat data -->
              <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal{{$value->id_feasibility}}{{$value->id_data_mesin}}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
              <div class="modal fade" id="exampleModal{{$value->id_feasibility}}{{$value->id_data_mesin}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content text-left ">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button><h3>
                    </div>
                    <div class="modal-body">
                    <!-- list mesin -->
                    <table class="Table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">mesin</th>
                          <th class="text-center">Kategori</th>
                          <th class="text-center">standar sdm</th>
                          <th class="text-center">speed</th>
                          <th class="text-center">Hasil</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php $no = 0;?>
                    <?php $no++ ;?>


                    @foreach($dataMesin as $key => $dataM)
                    @if($value->id_feasibility == $dataM->id_feasibility)
                    <tr>
                      <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                      <input name="mesin_{{ $key }}" value="{{ $dataM->id_data_mesin }}" class="form-control1" type="hidden" id="txtName" disabled/>
                      <input type="hidden" name="cek_mesin" maxlength="45" id="mesinn" required="required" value="{{count($data)}}" class="form-control col-md-7 col-xs-12">
                      <td><input name="mesin_{{ $key }}" value="{{ $dataM->nama_mesin }}" class="form-control1" type="text" id="txtName" disabled/></td>
                      <td><input name="kategori_{{ $key }}" value="{{ $dataM->kategori}}" class="form-control1" type="text" id="txtName" disabled/></td>
                      <td><input name="standar_{{ $key }}" value="{{ $dataM->SDM }}" class="form-control1" type="text" id="txtName" disabled/></td>
                      <td><input name="runtime_{{ $key }}" value="{{ $dataM->runtime }}" class="form-control1" type="text" id="txtName" disabled/></td>
                      <td><input name="hasil_{{ $key }}" value="{{ $dataM->hasil }}" class="form-control1" type="text" id="txtName" disabled/></td>
                      <input name="line_{{ $key }}" value="{{ $dataM->line }}" class="form-control1" type="hidden" id="txtName" disabled/>
                    </tr>
                    @endif
                    @endforeach
                      </tbody>
                    </table>
                    <!-- list mesin selesai -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- lihat data selesai -->
              <!-- pilih reference -->
              {{csrf_field()}}
              <form action="{{route('lihat')}}" method="POST" >
                @foreach($dataMesin as $key => $dataM)
                @if($value->id_feasibility == $dataM->id_feasibility)
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                <input name="mesin_{{ $key }}" value="{{ $dataM->id_data_mesin }}" class="form-control1" type="hidden" id="txtName" disabled/>
                <input type="hidden" name="cek_mesin" maxlength="45" id="mesinn" required="required" value="{{count($data)}}" class="form-control col-md-7 col-xs-12">
                <input value="{{ $dataM->nama_mesin }}" class="form-control1" type="hidden" id="txtName" disabled/>
                <input name="line_{{ $key }}" value="{{ $dataM->line }}" class="form-control1" type="hidden" id="txtName" disabled/>
                <input name="standar_{{ $key }}" value="{{ $dataM->standar_sdm }}" class="form-control1" type="hidden" id="txtName" disabled/>
                <input name="runtime_{{ $key }}" value="{{ $dataM->runtime }}" class="form-control1" type="hidden" id="txtName" disabled/>
                <input name="hasil_{{ $key }}" value="{{ $dataM->hasil }}" class="form-control1" type="hidden" id="txtName" disabled/>
                @endif
                @endforeach
              <button type="submit" class="btn btn-info fa fa-check" data-toggle="tooltip" data-placement="top" title="Pilih"></button>
              {{csrf_field()}}
              </form>
              <!-- pilih reference selesai -->
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
          </div>
      </div>
    </div>
    </div>
  </div>
</div>
<!-- search reference data selesai -->
</div>

@endsection
