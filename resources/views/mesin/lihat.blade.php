@extends('produksi.tempproduksi')
@section('title','Feasibility|Inputor')
@section('content')

     <div id="RM" class="tab-pane">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-cogs"></i> Data Mesin</h2>
        <h2 style="margin-left : 700px;"><i class="fa fa-cogs"></i> Total Rate = {{$total}} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">GRANULASI</a></li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">MIXING</a></li>
            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">FILLING</a></li>
            <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">PACKING</a></li>
            <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ACTIVITY</a></li>
            <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">OH LAIN-LAIN</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">

          <!-- GRANULASI -->
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <table class="Table table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 0;
                  @endphp
                    @foreach($Mdata as $dM)
                    @php
                      ++$no;
                    @endphp
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                    {!!csrf_field()!!}
                      <tr>
                      @if( $dM->meesin->kategori=='granulasi' )
                        <td> {{ $dM->meesin->nama_mesin }}</td>
                        <td class="text-center">{{ $dM->standar_sdm }} Orang</td>
                        <td class="text-center">{{ $dM->runtime }} Menit</td>
                      <td width="15%"><input type="number" id='hasil{{$no}}' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                    </tr>
                    @endif
                    </form>
                      @endforeach
                </tbody>
              </table>
            </div>

                        <!-- MIXING -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                    </thead>
                    <tbody>
                    @php
                    $nom = 0;
                  @endphp
                    @foreach($Mdata as $dM)
                    @php
                      ++$nom;
                    @endphp
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                      {!!csrf_field()!!}
                      <tr>
                      @if( $dM->meesin->kategori=='mixing' )
                      <td> {{ $dM->meesin->nama_mesin }}</td>
                        <td class="text-center" width="15%"><input disabled type="number" name="runtime" value="{{$dM->standar_sdm}}" name="last-name" required class="form-control1 col-md-7 col-xs-12 text-center"></td>
                          <td class="text-center" width="15%"><input  type="number" name="runtime" value="{{$dM->runtime}}" name="last-name" required class="form-control1 col-md-7 col-xs-12 text-center"></td>
                      <td width="15%"><input type="number" id='hasill{{$nom}}' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                    </tr>
                    @endif
                      </form>
                      @endforeach
                    </tbody>
                    </table>
                        </div>

                        <!-- FILLING -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                    </thead>
                    <tbody>
                    @foreach($Mdata as $dM)
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                      {!!csrf_field()!!}
                      <tr>
                      @if( $dM->meesin->kategori=='filling' )
                      <td> {{ $dM->meesin->nama_mesin }}</td>
                        <td class="text-center" width="15%"><input disabled type="number" name="runtime" value="{{$dM->standar_sdm}}" name="last-name" required class="form-control1 col-md-7 col-xs-12 text-center"></td>
                         <td class="text-center" width="15%"><input  type="number" name="runtime" value="{{$dM->runtime}}" name="last-name" required class="form-control1 col-md-7 col-xs-12 text-center"></td>
                       <td width="15%"><input type="number" id='' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                    </tr>
                    @endif
                      </form>
                      @endforeach
                    </tbody>
                    </table>
                        </div>

                         <!-- PACKING -->
                         <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">Runtime</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                    </thead>
                    <tbody>
                    @foreach($Mdata as $dM)
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                      {!!csrf_field()!!}
                      <tr>
                      @if( $dM->meesin->kategori=='packing' )
                      <td> {{ $dM->meesin->nama_mesin }}</td>
                        <td class="text-center" width="15%"><input disabled type="number" name="runtime" value="{{$dM->standar_sdm}}" name="last-name" required class="form-control1 col-md-7 col-xs-12 text-center"></td>
                        <td class="text-center" width="15%"><input  type="number" name="runtime" value="{{$dM->runtime}}" name="last-name" required class="form-control1 col-md-7 col-xs-12 text-center"></td>
                        <td width="15%"><input type="number" id='' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                    </tr>
                    @endif
                      </form>
                      @endforeach
                    </tbody>
                    </table>
                        </div>

                        <!-- aktifitas -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                        <table class="table table-hover  table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Aktifitas</th>
                      <th class="text-center">runtime</th>
                      <th class="text-center">Standar SDM</th>
                      <th class="text-center">SDM</th>
                      <th class="text-center">hasil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    @php
                    $nol = 0;
                  @endphp
                    @foreach($dataO as $dO)
                    @php
                      ++$nol;
                    @endphp
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('/updateoh')}}/{{$dO->id_oh}}" method="post">
                    {!!csrf_field()!!}
                      <td>{{ $dO->dataoh->direct_activity }}</td>
                      <td class="text-center">{{ $dO->runtime }} Menit</td>
                      <td class="text-center">{{ $dO->standar_sdm }} Orang </td>
                      <td class="text-center">{{ $dO->SDM }} Orang</td>
                      <td width="15%"><input type="number" id='hasil{{$no}}' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dO->hasil }}" disabled> </td>
                      </tr>
                            </form>
                          @endforeach
                        </tbody>
                        </table>
                        </div>

                        <!-- STD produksi -->
                  <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
                  <div class="x_panel">
    <h3 class="text-center">OH Lain-lain</h3>
      <div class="x_content">
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/stdd" method="post">
          <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="status" maxlength="45" required="required" value="selesai" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
        
          <div class="form-group">
              @foreach($lihat as $l)
            <label class="control-label col-md-2 col-sm-3 col-xs-12">kode item</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="number" name="acid" value="{{$l->kode_item}}" maxlength="75" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Item</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="text" name="nama" value="{{$l->nama_item}}" maxlength="125" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">yield</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="number" name="lye" value="{{$l->yield}}" maxlength="50" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">keterangan</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="text" name="lye" value="{{$l->catatan}}" maxlength="50" class="form-control2" readonly>
              </div>
          </div>
          @endforeach
          </div>  
        </form>
      </div>
    </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">                        
                      <a href="{{ route('myFeasibility',$id) }}" class="btn btn-danger" type="button">Kembali</a>
                      </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
@endsection