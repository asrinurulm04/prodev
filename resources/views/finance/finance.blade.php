@extends('finance.tempfinance')
@section('title', 'feasibility|Finance')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content6" id="profile-tab" role="tab" data-toggle="tab" aria-expanded="true">Mesin dan SDM</a></li>
          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Lab</a></li>
          <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Kemasan</a></li>
          <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Harga Bahan Baku</a></li>
          <li role="presentation" class=""><a href="#tab_content10" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Approve Data</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">

          <!-- Mesin dan SDM -->
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content6" aria-labelledby="profile-tab">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-cogs"></i> Data Mesin </h2>
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
                    </ul>
                    <div id="myTabContent" class="tab-content">

                      <!-- GRANULASI -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">No</th>
                              <th class="text-center">mesin</th>
                              <th class="text-center">standar sdm</th>
                              <th class="text-center">SDM</th>
                              <th class="text-center">Runtime</th>
                              <th class="text-center">aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 0;?>
                            @foreach($Mdata as $dM)
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
                            {!!csrf_field()!!}
                            <?php ++$no ;?>
                              <tr>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                  <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                                </div>
                                @if( $dM->meesin->kategori=='granulasi' )
                                <td  class="text-center">{{$no}}</td>
                                <td>{{ $dM->meesin->nama_mesin }}</td>
                                <td class="text-center">{{ $dM->standar_sdm }} orang</td>
                                <td class="text-center">{{ $dM->SDM }} orang</td>
                                <td class="text-center">{{ $dM->runtime }} Menit</td>
                                <td class="text-center">

                                  <!-- Lihat data -->
                                  <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
                                  <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <table>
                                            <tr><th width="20%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th></tr>
                                            <tr><th width="20%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th></tr>
                                            <tr><th width="20%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th></tr>
                                            <tr><th width="20%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th></tr>
                                            <tr><th width="20%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th></tr>
                                            <tr><th width="20%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th></tr>
                                            <tr><th width="20%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th></tr>
                                            <tr><th width="20%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th></tr>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- lihat data selesai -->

                                  <!-- edit data -->
                                  <button type="button" class="btn btn-primary fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                                  <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Edit Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <form name="ubah" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" methode="POST">
                                          {{ csrf_field() }}
                                          <div class="form-group">
                                            <label class="col-form-label text-center">Runtime mesin:
                                              <input id="runtime" value="{{$dM->runtime}}" name="runtime" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Jumlah SDM:
                                              <input id="jumlah" value="{{$dM->SDM}}" name="jlh_sdm" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Standar SDM :
                                              <input id="std" value="{{$dM->standar_sdm}}" name="std_sdm" class="form-control text-center col-md-5 col-sm-5 col-xs-12" type="number"></label>
                                            <label class="col-form-label text-center">Harga Mesin :
                                              <input id="harga" value="{{$dM->rate_mesin}}" name="hargaM" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number"></label>
                                          </div>
                                          <input type="checkbox" name="standar" value="true"> Ubah standar data product (perubahan per project)
                                          <br>
                                          <input type="checkbox" name="data" value="true"> Ubah data utama (perubahan akan merubah data utapa pada database)
                                          <input type="hidden" name="_method" value="PUT">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- edit selesai -->

                                </td>
                                @endif
                              </tr>
                            </form>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <!-- MIXING -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">No</th>
                              <th class="text-center">mesin</th>
                              <th class="text-center">standar sdm</th>
                              <th class="text-center">SDM</th>
                              <th class="text-center">Runtime</th>
                              <th class="text-center">aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 0;?>
                            @foreach($Mdata as $dM)
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
                              {!!csrf_field()!!}
                              <?php ++$no ;?>
                              <tr>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                  <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                                </div>
                                @if( $dM->meesin->kategori=='mixing' )
                                <td  class="text-center">{{$no}}</td>
                                <td>{{ $dM->meesin->nama_mesin }}</td>
                                <td class="text-center">{{ $dM->standar_sdm }} orang</td>
                                <td class="text-center">{{ $dM->SDM }} orang</td>
                                <td class="text-center">{{ $dM->runtime }} Menit</td>
                                <td class="text-center">

                                  <!-- Lihat data -->
                                  <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
                                  <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <table>
                                            <tr><th width="10%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th></tr>
                                            <tr><th width="10%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th></tr>
                                            <tr><th width="10%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th></tr>
                                            <tr><th width="10%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th></tr>
                                            <tr><th width="10%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th></tr>
                                            <tr><th width="10%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th></tr>
                                            <tr><th width="10%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th></tr>
                                            <tr><th width="10%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th></tr>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- lihat data selesai -->

                                  <!-- edit data -->
                                  <button type="button" class="btn btn-primary fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                                  <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Edit Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <form name="ubah" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" methode="POST">
                                          {{ csrf_field() }}
                                          <div class="form-group">
                                            <label class="col-form-label text-center">Runtime mesin:
                                              <input id="runtime" value="{{$dM->runtime}}" name="runtime" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Jumlah SDM:
                                              <input id="jumlah" value="{{$dM->SDM}}" name="jlh_sdm" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Standar SDM :
                                              <input id="std" value="{{$dM->standar_sdm}}" name="std_sdm" class="form-control text-center col-md-5 col-sm-5 col-xs-12" type="number"></label>
                                            <label class="col-form-label text-center">Harga Mesin :
                                              <input id="harga" value="{{$dM->rate_mesin}}" name="hargaM" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number"></label>
                                          </div>
                                          <input type="checkbox" name="standar" value="true"> Ubah standar data product (perubahan per project)
                                          <br>
                                          <input type="checkbox" name="data" value="true"> Ubah data utama (perubahan akan merubah data utapa pada database)
                                          <input type="hidden" name="_method" value="PUT">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- edit selesai -->

                                </td>
                                @endif
                              </tr>
                            </form>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <!-- FILLING -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">No</th>
                              <th class="text-center">mesin</th>
                              <th class="text-center">standar sdm</th>
                              <th class="text-center">SDM</th>
                              <th class="text-center">Runtime</th>
                              <th class="text-center">aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 0;?>
                            @foreach($Mdata as $dM)
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
                            {!!csrf_field()!!}
                            <?php ++$no ;?>
                              <tr>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                  <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                                </div>
                                @if( $dM->meesin->kategori=='filling' )
                                <td  class="text-center">{{$no}}</td>
                                <td>{{ $dM->meesin->nama_mesin }}</td>
                                <td class="text-center">{{ $dM->standar_sdm }} orang</td>
                                <td class="text-center">{{ $dM->SDM }} orang</td>
                                <td class="text-center">{{ $dM->runtime }} Menit</td>
                                <td class="text-center">

                                  <!-- Lihat data -->
                                  <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
                                  <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <table>
                                            <tr><th width="20%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th></tr>
                                            <tr><th width="20%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th></tr>
                                            <tr><th width="20%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th></tr>
                                            <tr><th width="20%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th></tr>
                                            <tr><th width="20%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th></tr>
                                            <tr><th width="20%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th></tr>
                                            <tr><th width="20%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th></tr>
                                            <tr><th width="20%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th></tr>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- lihat data selesai -->

                                  <!-- edit data -->
                                  <button type="button" class="btn btn-primary fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                                  <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Edit Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <form name="ubah" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" methode="POST">
                                          {{ csrf_field() }}
                                          <div class="form-group">
                                            <label class="col-form-label text-center">Runtime mesin:
                                              <input id="runtime" value="{{$dM->runtime}}" name="runtime" class="form-control text-center col-md-6 col-sm-5 col-xs-12" type="number" disabled></label>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-form-label text-center">Jumlah SDM:
                                              <input id="jumlah" value="{{$dM->SDM}}" name="jlh_sdm" class="form-control text-center col-md-6 col-sm-5 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Standar SDM :
                                              <input id="std" value="{{$dM->standar_sdm}}" name="std_sdm" class="form-control text-center col-md-6 col-sm-5 col-xs-12" type="number"></label>
                                            <label class="col-form-label text-center">Harga Mesin :
                                              <input id="harga" value="{{$dM->rate_mesin}}" name="hargaM" class="form-control text-center col-md-6 col-sm-5 col-xs-12" type="number"></label>
                                          </div>
                                          <input type="checkbox" name="standar" value="true"> Ubah standar data product (perubahan per project)
                                          <br>
                                          <input type="checkbox" name="data" value="true"> Ubah data utama (perubahan akan merubah data utapa pada database)
                                          <input type="hidden" name="_method" value="PUT">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- edit selesai -->

                                </td>
                                @endif
                              </tr>
                            </form>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <!-- packing -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">No</th>
                              <th class="text-center">mesin</th>
                              <th class="text-center">standar sdm</th>
                              <th class="text-center">SDM</th>
                              <th class="text-center">Runtime</th>
                              <th class="text-center">aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 0;?>
                            @foreach($Mdata as $dM)
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" method="post">
                            {!!csrf_field()!!}
                            <?php ++$no ;?>
                              <tr>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                  <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                                </div>
                                @if( $dM->meesin->kategori=='packing' )
                                <td  class="text-center">{{$no}}</td>
                                <td>{{ $dM->meesin->nama_mesin }}</td>
                                <td class="text-center">{{ $dM->standar_sdm }} orang</td>
                                <td class="text-center">{{ $dM->SDM }} orang</td>
                                <td class="text-center">{{ $dM->runtime }} Menit</td>
                                <td class="text-center">

                                  <!-- Lihat data -->
                                  <button type="button" class="btn btn-warning fa fa-eye" data-toggle="modal" data-target="#exampleModal1{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Lihat"></button>
                                  <div class="modal fade" id="exampleModal1{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Lihat Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <table>
                                            <tr><th width="10%">Nama Mesin </th><th width="45%">: {{ $dM->meesin->nama_mesin }}</th></tr>
                                            <tr><th width="10%">Workcenter</th><th width="45%">: {{ $dM->meesin->workcenter }}</th></tr>
                                            <tr><th width="10%">Kategori Mesin</th><th width="45%">: {{ $dM->meesin->kategori }}</th></tr>
                                            <tr><th width="10%">Standar SDM</th><th width="45%">: {{ $dM->standar_sdm }} Orang</th></tr>
                                            <tr><th width="10%">SDM</th><th width="45%">: {{ $dM->SDM }} Orang</th></tr>
                                            <tr><th width="10%">Runtime</th><th width="45%">: {{ $dM->runtime}} Menit = {{ $dM->runtime/60}} Jam</th></tr>
                                            <tr><th width="10%">Rate Mesin</th><th width="45%">: {{ $dM->rate_mesin }} Ribu</th></tr>
                                            <tr><th width="10%">Total Hasil</th><th width="45%">: {{ $dM->hasil }} Ribu</th></tr>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- lihat data selesai -->

                                  <!-- edit data -->
                                  <button type="button" class="btn btn-primary fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                                  <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content text-left ">
                                        <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Edit Data
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button><h3>
                                        </div>
                                        <div class="modal-body">
                                          <form name="ubah" action="{{ route('updateM', ['id_mesin' => $dM->id_mesin, 'id_datamesin' => $dM->id_data_mesin]) }}" methode="POST">
                                          {{ csrf_field() }}
                                          <div class="form-group">
                                            <label class="col-form-label text-center">Runtime mesin:
                                              <input id="runtime" value="{{$dM->runtime}}" name="runtime" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Jumlah SDM:
                                              <input id="jumlah" value="{{$dM->SDM}}" name="jlh_sdm" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number" disabled></label>
                                            <label class="col-form-label text-center">Standar SDM :
                                              <input id="std" value="{{$dM->standar_sdm}}" name="std_sdm" class="form-control text-center col-md-5 col-sm-5 col-xs-12" type="number"></label>
                                            <label class="col-form-label text-center">Harga Mesin :
                                              <input id="harga" value="{{$dM->rate_mesin}}" name="hargaM" class="form-control text-center col-md-6 col-sm-6 col-xs-12" type="number"></label>
                                          </div>
                                          <input type="checkbox" name="standar" value="true"> Ubah standar data product (perubahan per project)
                                          <br>
                                          <input type="checkbox" name="data" value="true"> Ubah data utama (perubahan akan merubah data utapa pada database)
                                          <input type="hidden" name="_method" value="PUT">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- edit selesai -->

                                </td>
                                @endif
                              </tr>
                            </form>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <!-- aktifitas -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                        <table class="table table-hover  table-bordered">
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">Aktifitas</th>
                              <th class="text-center">runtime</th>
                              <th class="text-center">Standar SDM</th>
                              <th class="text-center">SDM</th>
                              <th class="text-center">hasil</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            @php $nol = 0; @endphp
                            @foreach($dataO as $dO)
                            @php ++$nol; @endphp
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
                      <!-- aktifitas selesai -->

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- mesin dan sdm selesai -->

          <!-- LAB -->
          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
            <div class="panel-heading">
              <h2>Feasibility Analisa</h2>
              <h2><i class="fa fa-clipboard"></i style="margin-left : 700px;"> Total Rate = {{$jlab}} </h2>
            </div>
            <table id="myTable" class="table table-hover table-bordered">
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">Jenis Mikroba</th>
                <th class="text-center" width="10%">Tahunan</th>
                <th class="text-center" width="10%">Harian</th>
                <th class="text-center">Input kode</th>
                <th class="text-center">rate</th>
              </tr>
              @foreach($dataL as $dL)
              <tr>
                <div class="col-md-1 col-sm-1 col-xs-12">
                  <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                </div>
                <td><input class="form-control1" type="text" id="txtName" value="{{ $dL->jenis_mikroba }}" readonly /></td>
                <td><input type="text" id="txtGender" checked class="form-control1 text-center" value="{{ $dL->tahunan }}" readonly /></td>
                <td><input type="text" id="txt" checked class="form-control1 text-center" value="{{ $dL->harian }}" readonly /></td>
                <td><input id="kode" class="form-control" type="text" id="txtAge" value="{{ $dL->kode_analisa }}" readonly  /></td>
                <td><input class="form-control" type="number" id="txtOccupation" value="{{ $dL->rate }}" readonly /></td>
              </tr>
              @endforeach
            </table>
          </div>
          <!-- LAB selesai -->

          <!-- Kemas -->
          <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab2">
            <div class="col-md-12 col-sm-12 col-xs-8 ">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2>Data Kemas</h2>
                </div>
                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                        <td class="text-center">Keterangan</td>
                        <td class="text-center">Konfigurasi</td>
                        <td class="text-center">Konsep</td>
                        <td class="text-center">Batch</td>
                        <td class="text-center">Palet/batch</td>
                        <td class="text-center">Box/palet</td>
                        <td class="text-center">Box/layer</td>
                        <td class="text-center">Kubikasi</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($konsep as $konsep)
                      <tr>
                        <td>{{$konsep->keterangan}}</td>
                        <td class="text-center">
                          @if($konsep->primer!=NULL)
                          {{$konsep->primer}}{{$konsep->s_primer}}
                          @endif
                          @if($konsep->tersier!=NULL)
                          X{{$konsep->tersier}}{{$konsep->s_tersier}}
                          @endif	
                          @if($konsep->tersier!=NULL)
                          X{{$konsep->tersier2}}{{$konsep->s_tersier2}}
                          @endif	
                          @if($konsep->sekunder!=NULL)
                          X{{$konsep->sekunder}}{{$konsep->s_sekunder}}
                          @endif	
                        </td>
                        <td class="text-center">{{$konsep->konsep}}</td>
                        <td class="text-right">{{$konsep->batch}}</td>
                        <td class="text-right">{{$konsep->palet_batch}}</td>
                        <td class="text-right">{{$konsep->box_palet}}</td>
                        <td class="text-right">{{$konsep->box_layer}}</td>
                        <td class="text-right">{{$konsep->kubikasi}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table><br>
                  <table class="table table-responsive table-bordered">
                    <thead>
                      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                        <th rowspan="2" class="text-center">Min Order</th>
                        <th rowspan="2" class="text-center">harga/UoM</th>
                        <th rowspan="2" class="text-center">Cost Kemas</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($kemas as $kem)
                        <td class="text-center">{{ $kem->min_order }}</td>
                        <td class="text-center">{{ $kem->harga_uom }}</td>
                        <td class="text-center">{{ $kem->cost }}</td>
                      </tr>
                      @endforeach
                      @foreach($kemas as $kem)
                        @if($kem->cost_box != '')<th colspan="2" class="text-right">Cost Kemas/Box <th>: {{ $kem->cost_box }}</th></tr>
                        @endif
                        @if($kem->cost_dus != '')<th colspan="2" class="text-right">Cost Kemas/Dus <th>: {{ $kem->cost_dus }}</th></tr>
                        @endif
                        @if($kem->cost_sachet != '')<th colspan="2" class="text-right">Cost Kemas/Sachet <th>: {{ $kem->cost_sachet }}</th></tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                
                  @foreach($dataF as $dF)
                    <a href="{{ route('kemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info fa fa-eye" type="submit">  Lihat Data</a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- kemas selesai -->

          <!-- BB -->
          <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="profile-tab">
            <div id="exTab2" class="container">	
              <div class="tab-content ">  
                @php $no = 0; @endphp
                <div class="row">
                  <div class="col-md-5">
                    <table class="table table-bordered" style="font-size:12px">
                      <thead>
                        <th colspan="4" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Bahan Baku</center></th>
                      </thead>
                      <thead>
                        <th>No</th>
                        <th>Kode Item</th>
                        <th>Nama Bahan</th>
                        <th>Harga PerGram</th>
                      </thead>
                      <tbody>
                      @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                        <tr>
                          <td>{{ ++$no }}</td>
                          <td>{{ $fortail['kode_komputer'] }}</td>
                          <td>{{ $fortail['nama_sederhana'] }}</td>
                          <td>Rp.{{ $fortail['hpg'] }}</td>
                        </tr>
                        @endforeach
                        <tr colspan="4" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
                          <td colspan="3">Jumlah</td>
                          <td>Rp.{{ $total_harga['total_harga_per_gram'] }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-2">
                    <table class="table table-bordered" style="font-size:12px">
                      <thead>
                        <th colspan="3" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Serving</center></th>                                                                                                                
                      </thead>
                      <thead>
                        <th>Berat</th>
                        <th>%</th>
                        <th>Harga</th>
                      </thead>
                      <tbody>
                        @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                        <tr>
                          <td>{{ $fortail['per_serving'] }}</td>
                          <td>{{ $fortail['persen'] }}</td>
                          <td>Rp.{{ $fortail['harga_per_serving'] }}</td>
                        </tr>
                        @endforeach
                        <tr colspan="4" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
                          <td>{{ $total_harga['total_berat_per_serving'] }}</td>
                          <td>{{ $total_harga['total_persen'] }}</td>
                          <td>Rp.{{ $total_harga['total_harga_per_serving'] }}</td>
                        </tr>                                                        
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-3">
                    <table class="table table-bordered" style="font-size:12px">
                      <thead>
                        <th colspan="2" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Batch</center></th>
                      </thead>
                      <thead>
                        <th>Berat</th>
                        <th>Harga</th>
                      </thead>
                      <tbody>
                        @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                        <tr>
                          <td>{{ $fortail['per_batch'] }}</td>
                          <td>Rp.{{ $fortail['harga_per_batch'] }}</td>
                        </tr>
                        @endforeach
                        <tr colspan="4" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
                          <td>{{ $total_harga['total_berat_per_batch'] }}</td>
                          <td>Rp.{{ $total_harga['total_harga_per_batch'] }}</td>                                                        
                        </tr> 
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-2">
                    <table class="table table-bordered" style="font-size:12px">
                      <thead>
                        <th colspan="2" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Kg</center></th>
                      </thead>
                      <thead>
                        <th>Berat</th>
                        <th>Harga</th>
                      </thead>
                      <tbody>
                        @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                        <tr>
                          <td>{{ $fortail['per_kg'] }}</td>
                          <td>Rp.{{ $fortail['harga_per_kg'] }}</td>
                        </tr>
                        @endforeach
                        <tr colspan="4" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
                          {{-- <td>{{ $total_harga['total_berat_per_kg'] }}</td> --}}
                          <td>1000</td>
                          <td>Rp.{{ $total_harga['total_harga_per_kg'] }}</td>
                        </tr> 
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>
          </div>
          <!-- BB selesai -->

          <!-- approve data -->
          <div role="tabpanel" class="tab-pane fade" id="tab_content10" aria-labelledby="profile-tab">
            <table class="table table-responsive table-bordered " ALIGN="center">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <td width="5%" class="text-center">No</td>
                  <td>User</td>
                  <td>Pengirim</td>
                  <td>Data</td>
                  <td>Tanggal Masuk</td>
                  <td width="40%" class="text-center">Action</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Evaluator</td>
                  <td>{{ $u->user1 }}</td>
                  <td>Data Mesin</td>
                  <td>{{ $u->updated_at }}</td>
                  <td class="text-center">
                  @foreach($dataF as $dF)
                  @if($dF->status_mesin!="selesai")
                    @if($dF->status_mesin!="belum selesai")
                    <a href="{{ route('komentar',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger fa fa-times" type="button" data-toggle="tooltip" title="Tolak"></a>
                    @endif
                  <a href="{{route('mesinselesai',$dF->id_feasibility)}}" class="btn btn-primary fa fa-check" data-toggle="tooltip" title="Terima"></a>
                  @else
                  selesai
                  @endif
                  @endforeach
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Kemas</td>
                  <td>{{ $ko->user }}</td>
                  <td>Data Kemas</td>
                  <td>{{ $ko->updated_at }}</td>
                  <td class="text-center">
                  @foreach($dataF as $dF)
                  @if($dF->status_kemas!="selesai")
                  @if($dF->status_kemas!="belum selesai")
                  <a href="{{ route('Kkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger fa fa-times" type="button" data-toggle="tooltip" title="Tolak"></a>
                  @endif
                  <a href="{{route('kemasselesai',$dF->id_feasibility)}}" class="btn btn-primary fa fa-check" data-toggle="tooltip" title="Terima"></a>
                  @else
                  selesai
                  @endif
                  @endforeach
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- approve data selesai -->

          @foreach($dataF as $dF)
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('status',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
            <input class="form-control1 hidden" name="statusF" class="text-center col-md-7 col-xs-12" value="selesai">
            {{-- <input class="form-control1 hidden" name="statusM" class="text-center col-md-7 col-xs-12" value="selesai">
            <input class="form-control1 hidden" name="statusS" class="text-center col-md-7 col-xs-12" value="selesai">
            <input class="form-control1 hidden" name="statusK" class="text-center col-md-7 col-xs-12" value="selesai"> --}}
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              
            <button type="submit" class="btn btn-info btn-sm"> Finish</button>
            {{csrf_field()}}
            </div>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@endsection