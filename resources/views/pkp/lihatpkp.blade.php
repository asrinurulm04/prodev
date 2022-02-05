@extends('layout.tempvv')
@section('title', 'PRODEV|data PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel" >
      <div class="row"  style="margin:20px">
        <div id="exTab2" class="container">
					<div class="col-md-11" align="left">
            @if(auth()->user()->departement->dept === 'REA' || auth()->user()->role->namaRule === 'lab' || auth()->user()->role->namaRule === 'maklon')
            <a class="btn btn-danger btn-sm" href="{{ route('listPkpFs',$pkp->id_project)}}"><i class="fa fa-arrow-left"></i> Back</a>
            @else
            <a class="btn btn-danger btn-sm" href="{{ route('rekappkp',[$pkp->id_project,$pkp->id_pkp])}}"><i class="fa fa-arrow-left"></i> Back</a>
            @endif

            @if(auth()->user()->role->namaRule === 'pv_lokal')
              @if($pkp->status_pkp=="draf")
                @if($pkp->approval=='approve')
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#NW{{$pkp->id_pkp}}{{$pkp->revisi}}{{$pkp->turunan}}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>  
                @elseif($pkp->approval!='approve')
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#approve{{$pkp->id_pkp}}{{$pkp->turunan}}"><i class="fa fa-paper-plane"></i> Request Approval</a></button>
                @endif
                <!-- modal -->
                <div class="modal" id="approve{{$pkp->id_pkp}}{{$pkp->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Request Approval
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></h3></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ url('emailpkp',$pkp->id_project) }}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Email</label>
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">To</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="email" required class="form-control " type="email" name="email" required>
                            <input type="hidden" value="Pengajuan PKP-{{$pkp->project_name}}" name="judul" id="judul">
                            @foreach($picture as $pic)<input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic">@endforeach
                            <label stayle="color:red;">* only allowed one E-mail</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center"></label>
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Cc</label>
                          <div class="col-md-3 col-sm-10 col-xs-12">@if($pkp->perevisi!=NULL)<input type="text" required class="form-control " value="{{$pkp->perevisi2->email}}" name="pengirim2" id="pengirim2">@endif</div>
                          <div class="col-md-3 col-sm-10 col-xs-12"><input type="text" required class="form-control " value="{{auth()->user()->email}}" name="pengirim" id="pengirim"></div>
                          <div class="col-md-3 col-sm-10 col-xs-12"><input type="text" class="form-control" required value="{{$pkp->author1->email}}" name="pengirim1" id="pengirim1"></div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
                <!-- modal -->
                <div class="modal" id="NW{{$pkp->id_pkp}}{{$pkp->revisi}}{{$pkp->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></h3></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('SentPkpToRD',$pkp->id_project)}}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Produk</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="kirim" class="form-control form-control-line" id="kirim">
                            @if($pkp->jenis!='Kemas')
                              @foreach($dept as $deptartemnet)
                              @if($deptartemnet->Divisi=='RND' && $deptartemnet->dept!='RKA')
                                <option value="{{$deptartemnet->id}}"> Manager {{ $deptartemnet->dept }} ({{$deptartemnet->users->name}})</option>
                              @endif
                              @endforeach
                            @else
                              <option value="1">Departement</option>
                            @endif
                            </select>
                            <?php $last = Date('j-F-Y'); ?>
                            <input id="date" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="date" required="required" type="hidden" readonly>
                          </div>
                          <input type="hidden" value="{{$pkp->project_name}}" name="name" id="name">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Kemas</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="rka" class="form-control form-control-line" id="rka">
                              @if($pkp->jenis!='Baku')
                              <option value="1">RKA</option>
                              @endif
                              <option value="0">No Departement Selected</option>
                            </select>
                          </div>
                        </div>
                        @foreach($picture as $pic)<input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic">@endforeach
                        @if($pkp->pkp_number=='') <input type="hidden" value="{{$nopkp}}" name="nopkp" id="nopkp">
                        @elseif($pkp->pkp_number!='') <input type="hidden" value="{{$pkp->pkp_number}}" name="nopkp" id="nopkp">
                        @endif
                        <?php $tanggal = Date("Y"); ?> <input type="hidden" name="tahun" id="tahun" value="{{$tanggal}}">
                        @if($pkp->jenis=='Kemas')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.-.{{ $pkp->revisi_kemas }}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.-.{{ $pkp->revisi_kemas }}" name="ket_no" id="ket_no">
                          @endif
                        @elseif($pkp->jenis=='Baku')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M{{$pkp->info}}_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{$pkp->turunan}}.-" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}{{$pkp->info}}_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{$pkp->turunan}}.-" name="ket_no" id="ket_no">
                          @endif
                        @elseif($pkp->jenis=='Umum')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.{{$pkp->turunan}}.{{$pkp->revisi_kemas}}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.{{$pkp->turunan}}.{{$pkp->revisi_kemas}}" name="ket_no" id="ket_no">
                          @endif
                        @endif
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Project Priority</label>
                          <div class="col-md-1 col-sm-1 col-xs-12">
                            <input type="text" name="prioritas" id="prioritas" class="form-control" value="{{$prioritas}}" readonly>
                          </div>
                          <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">sample deadline</label>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date"></div>
                          <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="{{$tgl2}}" name="waktu" id="waktu" placeholder="end date"></div>
                        </div>
                        <div hidden>
                          <input id="type" value="{{$pkp->type}}">
                          <input id="nama_project" value="{{$pkp->project_name}}"><input id="id_prodev" value="{{$pkp->id_pkp}}">
                          <input id="revisi" value="{{$pkp->revisi}}"><input id="turunan" value="{{$pkp->turunan}}">
                          <input id="brand" value="{{$pkp->id_brand}}"><input id="ket_no" value="{{$pkp->ket_no}}">
                          <input id="id_pkp" value="{{$pkp->pkp_number}}"><input id="priority_project" value="{{$pkp->prioritas}}">
                          <input id="status_freeze" value="{{$pkp->status_freeze}}"><input id="jenis" value="{{$pkp->jenis}}">
                          <input id="nfi_price" value="{{$pkp->price}}"><input id="price" value="{{$pkp->price}}">
                          <input id="UOM" value="{{$pkp->UOM}}"><input id="status_project" value="{{$pkp->status_project}}">
                          @foreach ($datases as $data)<input id="ses" value="{{$data->ses}}">@endforeach
                          @foreach($for as $fore)<input id="forecast" value="{{$fore->forecast}}"><input id="satuan" value="{{$fore->satuan}}">@endforeach
                          <input id="dari_umur" value="{{$pkp->dariumur}}"><input id="sampai_umur" value="{{$pkp->sampaiumur}}">
                          <input id="gender" value="{{$pkp->gender}}"><input id="uniqueness" value="{{$pkp->Uniqueness}}">
                          <input id="estimated" value="{{$pkp->Estimated}}"><input id="reason" value="{{$pkp->reason}}">
                          <input id="launch" value="{{$pkp->launch}}"><input id="years" value="{{$pkp->years}}">
                          <input id="tgl_launch" value="{{$pkp->tgl_launch}}"><input id="aisle" value="{{$pkp->aisle}}">
                          <input id="data_forecast" value="{{$pkp->remarks_forecash}}"><input id="selling_price" value="{{$pkp->selling_price}}">
                          <input id="costumer_price" value="{{$pkp->price}}"><input id="competitor" value="{{$pkp->competitor}}">
                          <input id="competitive" value="{{$pkp->competitive}}"><input id="product_form" value="{{$pkp->product_form}}">
                          <input id="data_form" value="{{$pkp->remarks_product_form}}"><input id="primary" value="{{$pkp->primery}}">
                          <input id="secondary" value="{{$pkp->secondary}}"><input id="tertiary" value="{{$pkp->tertiary}}">
                          @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)<input id="bpom" value="{{$pkp->katpangan->no_kategori}}"><input id="olahan" value="{{$pkp->katpangan->pangan}}">@endif
                          <input id="akg" value="{{$pkp->tarkon->tarkon}}">
                          <input id="prefered_flavour" value="{{$pkp->prefered_flavour}}"><input id="idea" value="{{$pkp->idea}}">
                          <input id="product_benefits" value="{{$pkp->product_benefits}}">
                          @if($pkp->kemas_eksis!=NULL)<input id="configuration" value="{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }} X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}">@endif
                          <input id="kategori_bpom" value="{{$pkp->kategori_bpom}}">
                          <input id="serving_suggestion" value="{{$pkp->serving_suggestion}}"><input id="mandatory_ingredient" value="{{$pkp->mandatory_ingredient}}">
                        </div>
                        <div class="modal-footer">
                          <button type="submit" onclick="loadXMLDoc()" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @elseif($pkp->status_pkp=='revisi')
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#revisi{{$pkp->id_pkp}}{{$pkp->turunan}}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
                <!-- modal -->
                <div class="modal" id="revisi{{$pkp->id_pkp}}{{$pkp->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel" >Sent Data Revision
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></h3></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('sentRevisiPkpRD',$pkp->id_project)}}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Product </label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="kirim" class="form-control form-control-line" id="kirim">
                            @if($pkp->jenis!='Kemas')
                              @if($pkp->tujuankirim!=1)<option readonly value="{{$pkp->tujuankirim}}" selected>{{$pkp->departement->dept}}</option>@endif
                              @foreach($dept as $deptartemnet)
                                @if($deptartemnet->Divisi=='RND' && $deptartemnet->dept!='RKA')
                                <option value="{{$deptartemnet->id}}"> Manager {{ $deptartemnet->dept }} ({{$deptartemnet->users->name}})</option>
                                @endif
                              @endforeach
                            @else 
                              <option readonly value="{{$pkp->tujuankirim}}" selected>{{$pkp->departement->dept}}</option>
                            @endif
                            </select>
                          </div>
                          <?php $last = Date('j-F-Y'); ?>
                          <input id="date" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="date" required="required" type="hidden" readonly>
                          <input type="hidden" value="{{$pkp->project_name}}" name="name" id="name">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Kemas</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="rka" class="form-control form-control-line" id="rka">
                              @if($pkp->jenis!='Baku')
                                <option value="1">RKA</option>
                              @endif
                              <option value="0">No Departement Selected</option>
                            </select>
                          </div>
                        </div>
                        <?php $tanggal = Date("Y"); ?><input type="hidden" value="{{$pkp->pkp_number}}" name="nopkp" id="nopkp">
                        @if($pkp->jenis=='Kemas')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.-.{{ $pkp->revisi_kemas }}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.-.{{ $pkp->revisi_kemas }}" name="ket_no" id="ket_no">
                          @endif
                        @elseif($pkp->jenis=='Baku')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M{{$pkp->info}}_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{$pkp->turunan}}.-" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}{{$pkp->info}}_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{$pkp->turunan}}.-" name="ket_no" id="ket_no">
                          @endif
                        @elseif($pkp->jenis=='Umum')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.{{$pkp->turunan}}.{{$pkp->revisi_kemas}}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}{{$pkp->info}}_{{ $pkp->project_name }}_{{$pkp->no_kemas}}_{{ $pkp->revisi }}.{{$pkp->turunan}}.{{$pkp->revisi_kemas}}" name="ket_no" id="ket_no">
                          @endif
                        @endif
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project Priority</label>
                          <div class="col-md-1 col-sm-1 col-xs-12">
                            <input type="text" name="prioritas" id="prioritas" class="form-control" value="{{$pkp->prioritas}}" readonly>
                          </div>
                          <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">sample deadline</label>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date"></div>
                          <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="{{$tgl2}}" name="waktu" id="waktu" placeholder="end date"></div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Alasan Revisi</label>
                          <div class="col-md-10 col-sm-10 col-xs-12"><textarea name="alasan" id="alasan" class="col-md-12 col-sm-12 col-xs-12" cols="10" required></textarea> </div>
                        </div>
                        <input type="hidden" value="{{$pkp->userpenerima}}" name="userpenerima">
                        <input type="hidden" value="{{$pkp->userpenerima2}}" name="userpenerima2">
                        <div hidden>
                          <input id="type" value="{{$pkp->type}}">
                          <input id="nama_project" value="{{$pkp->project_name}}"><input id="id_prodev" value="{{$pkp->id_pkp}}">
                          <input id="revisi" value="{{$pkp->revisi}}"><input id="turunan" value="{{$pkp->turunan}}">
                          <input id="brand" value="{{$pkp->id_brand}}"><input id="ket_no" value="{{$pkp->ket_no}}">
                          <input id="id_pkp" value="{{$pkp->pkp_number}}"><input id="priority_project" value="{{$pkp->prioritas}}">
                          <input id="status_freeze" value="{{$pkp->status_freeze}}"><input id="note_freeze" value="{{$pkp->note_freeze}}"><input id="jenis" value="{{$pkp->jenis}}">
                          <input id="nfi_price" value="{{$pkp->price}}"><input id="price" value="{{$pkp->price}}">
                          <input id="UOM" value="{{$pkp->UOM}}"><input id="status_project" value="{{$pkp->status_project}}">
                          @foreach ($datases as $data)<input id="ses" value="{{$data->ses}}">@endforeach
                          @foreach($for as $fore)<input id="forecast" value="{{$fore->forecast}}"><input id="satuan" value="{{$fore->satuan}}">@endforeach
                          <input id="dari_umur" value="{{$pkp->dariumur}}"><input id="sampai_umur" value="{{$pkp->sampaiumur}}">
                          <input id="gender" value="{{$pkp->gender}}"><input id="uniqueness" value="{{$pkp->Uniqueness}}">
                          <input id="estimated" value="{{$pkp->Estimated}}"><input id="reason" value="{{$pkp->reason}}">
                          <input id="launch" value="{{$pkp->launch}}"><input id="years" value="{{$pkp->years}}">
                          <input id="tgl_launch" value="{{$pkp->tgl_launch}}"><input id="aisle" value="{{$pkp->aisle}}">
                          <input id="data_forecast" value="{{$pkp->remarks_forecash}}"><input id="selling_price" value="{{$pkp->selling_price}}">
                          <input id="costumer_price" value="{{$pkp->price}}"><input id="competitor" value="{{$pkp->competitor}}">
                          <input id="competitive" value="{{$pkp->competitive}}"><input id="product_form" value="{{$pkp->product_form}}">
                          <input id="data_form" value="{{$pkp->remarks_product_form}}"><input id="primary" value="{{$pkp->primery}}">
                          <input id="secondary" value="{{$pkp->secondary}}"><input id="tertiary" value="{{$pkp->tertiary}}">
                          @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)<input id="bpom" value="{{$pkp->katpangan->no_kategori}}"><input id="olahan" value="{{$pkp->katpangan->pangan}}">@endif
                          <input id="akg" value="{{$pkp->tarkon->tarkon}}">
                          <input id="prefered_flavour" value="{{$pkp->prefered_flavour}}"><input id="idea" value="{{$pkp->idea}}">
                          <input id="product_benefits" value="{{$pkp->product_benefits}}">
                          @if($pkp->kemas_eksis!=NULL)<input id="configuration" value="{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }} X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}">@endif
                          <input id="kategori_bpom" value="{{$pkp->kategori_bpom}}"><input id="revisi_id" value="{{$pkp->revisi}}">
                          <input id="serving_suggestion" value="{{$pkp->serving_suggestion}}"><input id="mandatory_ingredient" value="{{$pkp->mandatory_ingredient}}">
                        </div>
                        <div class="modal-footer">
                          <button type="submit" onclick="revisiloadXMLDoc()" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @elseif($pkp->status_pkp!='draf' && $pkp->status_pkp!='close')
                @if($pkp->status_freeze=='inactive')
                  <a class="btn btn-info btn-sm" onclick="return confirm('Up PKP Version ?')" href="{{Route('naikversipkp',[$pkp->id_project,$pkp->revisi,$pkp->turunan,$pkp->revisi_kemas])}}"><i class="fa fa-arrow-up" onclick="return confirm('Up PKP Version ?')"></i> Edit And Up Version</a>
                @endif
              @endif
            @elseif(auth()->user()->role->namaRule === 'marketing')
              @if($pkp->status_pkp!='draf' && $pkp->status_pkp!='close')
                @if($pkp->status_freeze=='inactive')
                  <a class="btn btn-info btn-sm" onclick="return confirm('Up PKP Version ?')" href="{{Route('naikversipkp',[$pkp->id_pkp,$pkp->revisi, $pkp->turunan,$pkp->revisi_kemas])}}"><i class="fa fa-arrow-up" onclick="return confirm('Up PKP Version ?')"></i> Edit And Up Version</a>
                @endif
              @endif
            @endif
            <a class="btn btn-warning btn-sm" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',$pkp->id_project) }}"><i class="fa fa-print"></i> Download/print PKP</a>
					</div>
          <form class="form-horizontal form-label-left" name="person" method="POST" >
          <div  class="tab-content panel ">
            <div class="tab-pane active" id="1">
              <div class="panel-default">
								<div class="panel-body badan" >
									<label>PT. NUTRIFOOD INDONESIA</label>
										<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2>
  								  <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2><br>
										<h2 style="font-weight: bold;">[ {{ $pkp->id_brand }} ] &reg;</h2> </center>
      							<table class="table table-bordered" style="font-size:12px">
                      <tr><th style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;" class="text-center">{{ $pkp->project_name }}@if($pkp->jenis!='Baku')_{{$pkp->no_kemas}}@endif</th></tr>
                    </table>
                    <div class="row">
                      <div class="col-sm-6">
                        <table ALIGN="left">
                          <tr><th class="text-left">Revision Number</th> <th> : {{$pkp->revisi}}.{{$pkp->turunan}}.{{$pkp->revisi_kemas}}</th></tr>
                          <tr><th class="text-left">PKP Number</th> <th> : {{$pkp->pkp_number}}{{$pkp->ket_no}}</th></tr>
                        </table>
                      </div>
                      <div class="col-sm-6">
                        <table ALIGN="right">
                          <tr><th class="text-right">Author </th><th>: {{$pkp->author1->name}}</th></tr>
                          <tr><th class="text-right">Created date</th> <th>: {{$pkp->created_date}}</th></tr>
                          <tr><th class="text-right">Last Upadate On</th> <th>: {{$pkp->last_update}}</th></tr>
                          <tr><th class="text-right">Last Sent</th> <th>: {{$pkp->tgl_kirim}}</th></tr>
                          <tr><th class="text-right">Revised By</th><th>: @if($pkp->perevisi!=NULL) {{$pkp->perevisi2->name}}@endif</th></tr>
                        </table><br><br>
                      </div>
                    </div>
                    @if($pkp->status_pkp=='draf')
										<table class=" table table-bordered">
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                      <tr>
                        <th width="300px">Idea</th>
                        <td colspan="2">{{$pkp->idea}}</td>
                      </tr>
                      <tr>
                        <th>Target market</th>
                        <td colspan="2">
													<table>
                            <tr><th style="border:none;">Gender </th><td style="border:none;">: {{$pkp->gender}}</td></tr>
                            <tr><th style="border:none;">Age </th><td style="border:none;"> : {{$pkp->dariumur}} to {{$pkp->sampaiumur}}</td></tr>
                            <tr><th style="border:none;">SES </th><td style="border:none;">@foreach ($datases as $data) : {{$data->ses}} <br> @endforeach</td></tr>
                            <tr><th style="border:none;">Remarks SES </th><td style="border:none;"> : @if($pkp->remarks_ses!=NULL) {{$pkp->remarks_ses}} @endif
                          </table>
												</td>
                      </tr>
                      <tr>
                      <th>Uniqueness of idea</th>
                        <td colspan="2"> {{$pkp->Uniqueness}}</td>
                      </tr>
                      <tr>
                        <th>Estimated potential market</th>
                        <td colspan="2">{{$pkp->Estimated}}</td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Reason(s)</th>
                        <td colspan="2">{{$pkp->reason}}</td>
                      </tr>
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th></tr>
                      <tr>
                        <th>Launch Deadline</th>
                        <td colspan="2"> {{$pkp->launch}} {{$pkp->years}} {{$pkp->tgl_launch}}</td>
                      </tr>
                      <tr>
                        <th>Aisle Placement</th>
                        <td colspan="2">{{$pkp->aisle}}</td>
                      </tr>
                      <tr>
                        <th>Sales Forecast</th>
                        <td colspan="2">@foreach($for as $fore){{$fore->satuan}} = <?php $angka_format = number_format($fore->forecast,2,",","."); echo "Rp. ".$angka_format;?> <br>@endforeach <br>
                        @if($pkp->remarks_forecash!='NULL')
                        Remarks forecast: {{$pkp->remarks_forecash}} <br>
                        @endif
                      </tr>
                      <tr>
                        <th>NF Selling Price (Before ppn)</th>
                        <td colspan="2"><?php $angka_format = number_format($pkp->selling_price,2,",","."); echo "Rp. ".$angka_format;?> / {{$pkp->UOM}}</td>
                      </tr>
                        <th>Consumer price target</th>
                        <td colspan="2"><?php $angka_format = number_format($pkp->price,2,",","."); echo "Rp. ".$angka_format;?> / {{$pkp->UOM}}</td>
                      </tr>
                      <tr>
                        <th>UOM</th>
                        <td colspan="2">{{$pkp->UOM}}</td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Main Competitor</td>
                        <td colspan="2">{{$pkp->competitor}}</hd>
                      </tr>
                      <tr class="table-highlight">
                        <th>Competitive Analysis</th>
                        <td colspan="2">{{$pkp->competitive}}</td>
                      </tr>
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th></tr>
                      <tr>
                        <th>Product Form</th>
                        <td colspan="2">{{$pkp->product_form}} <br><br>Remarks : {{$pkp->remarks_product_form}}</td>
                      </tr>
                      <tr>
                    <tr>
                      <th>Product Packaging</th>
                      <td colspan="2">
                        <table>
                          @if($pkp->kemas_eksis!=NULL)(
                            @if($pkp->kemas->tersier!=NULL)
                            {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                            @endif

                            @if($pkp->kemas->sekunder1!=NULL)
                            X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
                            @endif

                            @if($pkp->kemas->sekunder2!=NULL)
                            X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
                            @endif

                            @if($pkp->kemas->primer!=NULL)
                            X{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                            @endif )
                          @endif
                          <br><br>
                          @if($pkp->primery!=NULL)
                          <tr><th width="35%">Primary information</th><th>:</th><td style="border:none;"> {{$pkp->primery}}</td></tr>
                          @endif
                          @if($pkp->secondary!=NULL)
                          <tr><th width="35%">Secondary information</th><th>:</th><td style="border:none;"> {{$pkp->secondary}}</td></tr>
                          @endif
                          @if($pkp->tertiary!=NULL)
                          <tr><th width="35%">Teriery information</th><th>:</th><td style="border:none;"> {{$pkp->tertiary}}</td></tr>
                          @endif
                        </table>
									  	</td>
                    </tr>
                      <tr>
                        <th>Food Category (BPOM)</th>
                        <td colspan="2">@if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)({{$pkp->katpangan->no_kategori}}) {{$pkp->katpangan->pangan}}@endif</td>
                      </tr>
                      <tr>
                        <th>AKG</th>
                        <td>@if($pkp->akg!=NULL) {{$pkp->tarkon->tarkon}} @endif </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Prefered Flavour</th>
                        <td colspan="2">{{$pkp->prefered_flavour}}</td>
                      </tr>
                    <tr>
                      <th>Product Benefits</th>
                      <td colspan="2">{{$pkp->product_benefits}}
                        <table class="table table-bordered" >
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <td class="text-center">Komponen</td>
                              <td class="text-center">Klaim</td>
                              <td class="text-center">Information</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($dataklaim as $data)
                            <tr>
                              <td>{{$data->datakp->komponen}}</td>
                              <td>{{$data->klaim}}</td>
                              <td>{{$data->note}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
											</td>
                    </tr>
                    <tr>
                      <th>Serving Suggestion</th>
                      <td colspan="2">{{$pkp->serving_suggestion}}</td>
                    </tr>
                    <tr>
                      <th>Mandatory Ingredients</th>
                      <td colspan="2">{{$pkp->mandatory_ingredient}}</td>
                    </tr>
                    <tr>
                      <th>Related Picture</th>
                      <td colspan="2">
                        <table class="table table-bordered">
                          <tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
                            <td class="text-center">Filename</td>
                            <td class="text-center">Information</td>
                            <td class="text-center"></td>
                          </tr>
                          @foreach($picture as $pic)
                          <tr>
                            <td>{{$pic->filename}} </td>
                            <td width="40%"> &nbsp{{$pic->informasi}}</td>  
                            <td width="10%" class="text-center"><a href="{{asset('data_file/'.$pic->filename)}}" class="btn btn-warning btn-sm" download="{{$pic->filename}}" title="Download file"><li class="fa fa-download"></li></a></td>
                          </tr>
                          @endforeach
                        </table>
                      </td>
                    </tr>
                  </table>
                  @else
                  <table class=" table table-bordered">
                    <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                    <tr>
                      <th width="300px">Idea</th>
                      <td colspan="2"><?php $ideas = []; foreach ($pkp2 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->idea<br></font></s>"; }if($data->revisi==$pkp->revisi){ echo" $data->idea<br>"; } } ?></td>
                    </tr>
                    <tr>
                      <th>Target market</th>
                      <td colspan="2">
												<table>
                          <tr><th style="border:none;">Gender </th><td>:</td><td style="border:none;"> 
                          <?php $dataG = []; foreach ($pkp2 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->revisi!=$pkp->revisi){
                          echo": <s><font color='#ffa2a2'>$data->gender<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->gender <br>"; } } ?></td></tr>
													
                          <tr><th style="border:none;">Age </th><td>:</td><td style="border:none;"> 
                            <?php $dariumur = []; foreach ($pkp2 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->revisi!=$pkp->revisi){
                          echo"<s><font color='#ffa2a2'> $data->dariumur</font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->dariumur ";} } ?>
                          - <?php $sampaiumur = []; foreach ($pkp2 as $key => $data) If (!$sampaiumur || !in_array($data->sampaiumur, $sampaiumur)) { $sampaiumur += array( $key => $data->sampaiumur ); if($data->revisi!=$pkp->revisi){
                          echo" <s><font color='#ffa2a2'>$data->sampaiumur</font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->sampaiumur ";} } ?> </td></tr>

                          <tr><th style="border:none;">SES </th><td>:</td><td style="border:none;">@foreach ($datases as $data)  {{$data->ses}} <br> @endforeach</td></tr>
                          
                          <tr><th style="border:none;">Remarks SES </th><td>:</td><td style="border:none;"> 
                          <?php $remarks_ses = []; foreach ($pkp2 as $key => $data) If (!$remarks_ses || !in_array($data->remarks_ses, $remarks_ses)) { $remarks_ses += array( $key => $data->remarks_ses ); if($data->revisi!=$pkp->revisi){
                          echo": <s><font color='#ffa2a2'>$data->remarks_ses</br></font></s>";} if($data->revisi==$pkp->revisi){ echo"  $data->remarks_ses </br>";} } ?></td></tr>
                        </table>
											</td>
                    </tr>
                    <tr>
                      <th>Uniqueness of idea</th>
                      <td colspan="2"><?php $Uniqueness = []; foreach ($pkp2 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->Uniqueness <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Uniqueness <br>";} } ?></td>
                    </tr>
                    <tr>
                    <th>Estimated potential market</th>
                      <td colspan="2"><?php $Estimated = []; foreach ($pkp2 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->Estimated <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Estimated <br>"; } } ?></td>
                    </tr>
                    <tr class="table-highlight">
                      <th>Reason(s)</th>
                      <td colspan="2"><?php $reason = []; foreach ($pkp2 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->reason<br></font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->reason <br>"; } } ?></td>
                    </tr>
                    <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th></tr>
                    <tr>
                      <th>Launch Deadline</th>
                      <td colspan="2">
												<table>
                          <tr>
                          <?php $launch = []; foreach ($pkp2 as $key => $data) If (!$launch || !in_array($data->launch, $launch)) { $launch += array( $key => $data->launch ); 
                          if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->launch $data->years<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->launch $data->years<br>"; } } ?>

                          <?php $tgl_launch = []; foreach ($pkp2 as $key => $data) If (!$tgl_launch || !in_array($data->tgl_launch, $tgl_launch)) { $tgl_launch += array( $key => $data->tgl_launch ); 
                          if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->tgl_launch<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->tgl_launch<br>"; } } ?>
                          </tr>
												</table>
											</td>
                    </tr>
                    <tr>
                      <th>Aisle Placement</th>
                      <td colspan="2"><?php $aisle = []; foreach ($pkp2 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->aisle<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->aisle<br>"; } } ?></td>
                    </tr>
                    <tr>
                      <th>Sales Forecast </th>
                      <td colspan="2">@foreach($for as $fore)
                        {{$fore->satuan}} = <?php $angka_format = number_format($fore->forecast,2,",","."); echo "Rp. ".$angka_format;?> <br><input type="hidden" name="satuan" value="{{$fore->satuan}}"><input type="hidden" name="sales_forecast" value="{{$fore->forecast}}">
                        @endforeach
                        <br><br>
                        @if($pkp->remarks_forecash!='NULL')
                        <?php $remarks_forecash = []; foreach ($pkp2 as $key => $data) If (!$remarks_forecash || !in_array($data->remarks_forecash, $remarks_forecash)) { $remarks_forecash += array( $key => $data->remarks_forecash ); 
                        if($data->revisi!=$pkp->revisi){ echo"Remarks forecast: <s><font color='#ffa2a2'>$data->remarks_forecash<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Remarks forecast: $data->remarks_forecash <br>";  } } ?>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>NFI Selling Price (Before ppn)</th>
                      <td colspan="2">
                        <?php $selling_price = []; foreach ($pkp2 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>Rp. ". number_format($data->selling_price, 0, ".", "."). "<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" Rp. ". number_format($data->selling_price, 0, ".", "."). " <br>"; } }  ?>
                      </td>
										</tr>
                    <tr>
                      <th>Consumer price target</th>
                      <td colspan="2">
                        <?php $price = []; foreach ($pkp2 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>Rp. ". number_format($data->price, 0, ".", "."). "<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" Rp. ". number_format($data->price, 0, ".", "."). "<br>"; } } ?>
                      </td>
                    </tr>
                    <tr>
                      <th>UOM</th>
                      <td colspan="2">{{$pkp->UOM}}</td>
                    </tr>
                    <tr class="table-highlight">
                      <th>Main Competitor</th>
                      <td colspan="2"><?php $competitor = []; foreach ($pkp2 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->competitor <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitor <br>"; } }  ?></td>
                    </tr>
                    <tr class="table-highlight">
                      <th>Competitive Analysis</th>
                      <td colspan="2"><?php $competitive = []; foreach ($pkp2 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->competitive <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitive <br>"; } }  ?></td>
                    </tr>
                    <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th></tr>
                    <tr>
                      <th>Product Form</th>
                      <td colspan="2">
                      <?php $product_form = []; foreach ($pkp2 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); 
                      if($data->revisi!=$pkp->revisi){ echo":<s><font color='#ffa2a2'>$data->product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->product_form<br>"; } }  ?>
                      <br><br>
                      <?php $remarks_product_form = []; foreach ($pkp2 as $key => $data) If (!$remarks_product_form || !in_array($data->remarks_product_form, $remarks_product_form)) { $remarks_product_form += array( $key => $data->remarks_product_form  ); 
                      if($data->revisi!=$pkp->revisi){ echo"<s><font color='#ffa2a2'>Remarks : $data->remarks_product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Remarks: $data->remarks_product_form<br>"; } }  ?></td>
                    </tr>
                    <tr>
                      <th>Product Packaging</th>
                      <td colspan="2">
												<table>
                          @if($pkp->kemas_eksis!=NULL)(
                            @if($pkp->kemas->tersier!=NULL)
                            {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }} X
                            @endif

                            @if($pkp->kemas->sekunder1!=NULL)
                            {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X
                            @endif

                            @if($pkp->kemas->sekunder2!=NULL)
                            {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X
                            @endif

                            @if($pkp->kemas->primer!=NULL)
                            {{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                            @endif )
                          @endif
                          <br><br>
                          @if($pkp->primery!=NULL)
													<tr><th width="35%">Primary information</th><th>:</th><td style="border:none;"><?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); 
                            if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->primery<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->primery<br>"; } }  ?></td></tr>
                          @endif
                          @if($pkp->secondary!=NULL)
                          <tr><th width="35%">Secondary information</th><th>:</th><td style="border:none;"><?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); 
                          if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->secondary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->secondary<br>"; } }  ?></td></tr>
                          @endif
                          @if($pkp->tertiary!=NULL)
                            <tr><th width="35%">Teriery information</th><th>:</th><td style="border:none;"><?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); 
                            if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->tertiary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->tertiary<br>"; } }  ?></td></tr>
                          @endif
                        </table>
											</td>
                    </tr>
                    <tr>
                      <th>Food Category (BPOM)</th>
                      <td colspan="2">@if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)({{$pkp->katpangan->no_kategori}}) {{$pkp->katpangan->pangan}}@endif</td>
                    </tr>
                    <tr>
                      <th>AKG</th>
                      <td>@if($pkp->akg!=NULL)
                        <?php $tarkon = []; foreach ($pkp2 as $key => $data) If (!$tarkon || !in_array($data->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon ); 
                        if($data->revisi==$pkp->revisi){ echo"". $data->tarkon->tarkon."<br>"; } }  ?>@endif
                      </td>
                    </tr>
                    <tr class="table-highlight">
                      <th>Prefered Flavour</th>
                      <td colspan="2">
                    <?php $prefered_flavour = []; foreach ($pkp2 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); 
                      if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->prefered_flavour<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->prefered_flavour<br>"; } }  ?></td>
                    </tr>
                    <tr>
                      <th>Product Benefits</th>
                      <td colspan="2">
                        <?php $product_benefits = []; foreach ($pkp2 as $key => $data) If (!$product_benefits || !in_array($data->product_benefits, $product_benefits)) { $product_benefits += array( $key => $data->product_benefits ); 
                        if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->product_benefits<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->product_benefits<br>"; } }  ?><br>
                        <table class="table table-bordered" >
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <td class="text-center">Komponen</td>
                              <td class="text-center">Klaim</td>
                              <td class="text-center">Detail</td>
                              <td class="text-center">Information</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($dataklaim as $data)
                            <tr>
                              <td>{{$data->datakp->komponen}}</td>
                              <td>{{$data->klaim}}</td>
                              <td>@if($data->datadt!=Null){{$data->datadl->detail}}@endif</td>
                              <td>{{$data->note}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <th>Serving Suggestion</th>
                      <td colspan="2"><?php $serving = []; foreach ($pkp2 as $key => $data) If (!$serving || !in_array($data->serving_suggestion, $serving)) { $serving += array( $key => $data->serving_suggestion ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->serving_suggestion<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->serving_suggestion<br>"; } }  ?></td>
                    </tr>
                    <tr>
                      <th>Mandatory Ingredients</th>
                      <td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp2 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->mandatory_ingredient<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->mandatory_ingredient<br>"; } }  ?></td>
                    </tr>
                    <tr>
                      <th>Related Picture</th>
                      <td colspan="2">
                        <table class="table table-bordered">
                          <tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
                            <td class="text-center">Filename</td>
                            <td class="text-center">Information</td>
                            <td class="text-center"></td>
                          </tr>
                          @foreach($picture as $pic)
                          <tr>
                            <td>{{$pic->filename}} </td>
                            <td width="40%"> &nbsp{{$pic->informasi}}</td>  
                            <td width="10%" class="text-center"> <a href="{{asset('data_file/'.$pic->filename)}}" class="btn btn-warning btn-sm" download="{{$pic->filename}}" title="Download file"><li class="fa fa-download"></li></a></td>
                          </tr>
                          @endforeach
                        </table>
                      </td>
                    </tr>
                  </table>
                  @endif
								</div>
							</div>
            </div>
        	</div>
          </form>
				</div>
    	</div>
    </div>
	</div>
</div>
@endsection
@section('s')
<script>
  function loadXMLDoc() {
    var nama_project = document.getElementById("nama_project").value;     var id_prodev = document.getElementById("id_prodev").value;
    var revisi = document.getElementById("revisi").value;                 var turunan = document.getElementById("turunan").value;
    var brand = document.getElementById("brand").value;                   var ket_no = document.getElementById("ket_no").value;
    var id_pkp = document.getElementById("id_pkp").value;                 var priority_project = document.getElementById("priority_project").value;
    var jenis = document.getElementById("jenis").value;                   var mandatory_ingredient = document.getElementById("mandatory_ingredient").value;
    var selling_price = document.getElementById("selling_price").value;   var price = document.getElementById("price").value;
    var uom = document.getElementById("UOM").value;                       var status_project = document.getElementById("status_project").value;
    var ses = document.getElementById("ses").value;                       var dari_umur = document.getElementById("dari_umur").value;
    var sampai_umur = document.getElementById("sampai_umur").value;       var gender = document.getElementById("gender").value;
    var uniqueness = document.getElementById("uniqueness").value;         var estimated = document.getElementById("estimated").value;
    var reason = document.getElementById("reason").value;                 var launch = document.getElementById("launch").value;
    var years = document.getElementById("years").value;                   var tgl_launch = document.getElementById("tgl_launch").value;
    var forecast = document.getElementById("forecast").value;             var satuan = document.getElementById("satuan").value;
    var aisle = document.getElementById("aisle").value;                   var data_forecast = document.getElementById("data_forecast").value;
    var nfi_price = document.getElementById("nfi_price").value;           var costumer_price = document.getElementById("costumer_price").value;
    var competitor = document.getElementById("competitor").value;         var competitive = document.getElementById("competitive").value;
    var product_form = document.getElementById("product_form").value;     var data_form = document.getElementById("data_form").value;
    var primary = document.getElementById("primary").value;               var secondary = document.getElementById("secondary").value;
    var tertiary = document.getElementById("tertiary").value;             var bpom = document.getElementById("bpom").value;
    var akg = document.getElementById("akg").value;                       var prefered_flavour = document.getElementById("prefered_flavour").value;
    var idea = document.getElementById("idea").value;                     var product_benefits = document.getElementById("product_benefits").value;
    var configuration = document.getElementById("configuration").value;   var olahan = document.getElementById("olahan").value;
    var kategori_bpom = document.getElementById("kategori_bpom").value;   var serving_suggestion = document.getElementById("serving_suggestion").value;
    var type = document.getElementById("type").value;

    var formdata = new FormData();
    formdata.append("nama_project",nama_project);               formdata.append("id_prodev",id_prodev);
    formdata.append("revisi",revisi);                           formdata.append("turunan",turunan);
    formdata.append("brand",brand);                             formdata.append("ket_no",ket_no);
    formdata.append("id_pkp",id_pkp);                           formdata.append("priority_project",priority_project);
    formdata.append("jenis",jenis);                             formdata.append("serving_suggestion",serving_suggestion);  
    formdata.append("selling_price",selling_price);             formdata.append("price",price);
    formdata.append("UOM",uom);                                 formdata.append("status_project",status_project);                              
    formdata.append("ses",ses);                                 formdata.append("dari_umur",dari_umur);                     
    formdata.append("sampai_umur",sampai_umur);                 formdata.append("gender",gender);                           
    formdata.append("uniqueness",uniqueness);                   formdata.append("estimated",estimated);                     
    formdata.append("reason",reason);                           formdata.append("mandatory_ingredient",mandatory_ingredient);
    formdata.append("launch",launch);                           formdata.append("years",years);
    formdata.append("tgl_launch",tgl_launch);                   formdata.append("aisle",aisle);
    formdata.append("forecast",forecast);                       formdata.append("satuan",satuan);
    formdata.append("data_forecast",data_forecast);             formdata.append("nfi_price",nfi_price);
    formdata.append("costumer_price",costumer_price);           formdata.append("competitor",competitor);
    formdata.append("competitive",competitive);                 formdata.append("product_form",product_form);
    formdata.append("data_form",data_form);                     formdata.append("primary",primary);
    formdata.append("secondary",secondary);                     formdata.append("tertiary",tertiary);
    formdata.append("bpom",bpom);                               formdata.append("akg",akg);
    formdata.append("prefered_flavour",prefered_flavour);       formdata.append("idea",idea);
    formdata.append("product_benefits",product_benefits);       formdata.append("configuration",configuration);
    formdata.append("olahan",olahan);                           formdata.append("kategori_bpom",kategori_bpom);
    formdata.append("type",type);

    // if(type==1){
    //   let xhr = new XMLHttpRequest();
    //   xhr.open("POST","https://smo.nutrifood.co.id/api/create",true);
    //   xhr.send(formdata);
    //   xhr.onload = () => alert(xhr.response);
    // }
  }

  function revisiloadXMLDoc() {
    var nama_project = document.getElementById("nama_project").value;       var id_prodev = document.getElementById("id_prodev").value;
      var revisi = document.getElementById("revisi").value;                 var turunan = document.getElementById("turunan").value;
      var brand = document.getElementById("brand").value;                   var ket_no = document.getElementById("ket_no").value;
      var id_pkp = document.getElementById("id_pkp").value;                 var priority_project = document.getElementById("priority_project").value;
      var selling_price = document.getElementById("selling_price").value;   var price = document.getElementById("price").value;
      var jenis = document.getElementById("jenis").value;                   var revisi_id = document.getElementById("revisi_id").value;
      var uom = document.getElementById("UOM").value;                       var status_project = document.getElementById("status_project").value;
      var ses = document.getElementById("ses").value;                       var dari_umur = document.getElementById("dari_umur").value;
      var sampai_umur = document.getElementById("sampai_umur").value;       var gender = document.getElementById("gender").value;
      var uniqueness = document.getElementById("uniqueness").value;         var estimated = document.getElementById("estimated").value;
      var reason = document.getElementById("reason").value;                 var launch = document.getElementById("launch").value;
      var years = document.getElementById("years").value;                   var tgl_launch = document.getElementById("tgl_launch").value;
      var forecast = document.getElementById("forecast").value;             var satuan = document.getElementById("satuan").value;
      var aisle = document.getElementById("aisle").value;                   var data_forecast = document.getElementById("data_forecast").value;
      var nfi_price = document.getElementById("nfi_price").value;           var costumer_price = document.getElementById("costumer_price").value;
      var competitor = document.getElementById("competitor").value;         var competitive = document.getElementById("competitive").value;
      var product_form = document.getElementById("product_form").value;     var data_form = document.getElementById("data_form").value;
      var primary = document.getElementById("primary").value;               var secondary = document.getElementById("secondary").value;
      var tertiary = document.getElementById("tertiary").value;             var bpom = document.getElementById("bpom").value;
      var akg = document.getElementById("akg").value;                       var prefered_flavour = document.getElementById("prefered_flavour").value;
      var idea = document.getElementById("idea").value;                     var product_benefits = document.getElementById("product_benefits").value;
      var configuration = document.getElementById("configuration").value;   var olahan = document.getElementById("olahan").value;
      var kategori_bpom = document.getElementById("kategori_bpom").value;   var serving_suggestion = document.getElementById("serving_suggestion").value;
      var type = document.getElementById("type").value;                     var mandatory_ingredient = document.getElementById("mandatory_ingredient").value;

      var formdata = new FormData();
      formdata.append("nama_project",nama_project);               formdata.append("id_prodev",id_prodev);
      formdata.append("revisi",revisi);                           formdata.append("turunan",turunan);
      formdata.append("brand",brand);                             formdata.append("ket_no",ket_no);
      formdata.append("id_pkp",id_pkp);                           formdata.append("priority_project",priority_project);
      formdata.append("selling_price",selling_price);             formdata.append("price",price);
      formdata.append("jenis",jenis);                             formdata.append("serving_suggestion",serving_suggestion);   
      formdata.append("revisi_id",revisi_id);                     formdata.append("kategori_bpom",kategori_bpom);
      formdata.append("UOM",uom);                                 formdata.append("status_project",status_project);                              
      formdata.append("ses",ses);                                 formdata.append("dari_umur",dari_umur);                     
      formdata.append("sampai_umur",sampai_umur);                 formdata.append("gender",gender);                           
      formdata.append("uniqueness",uniqueness);                   formdata.append("estimated",estimated);                     
      formdata.append("reason",reason);                           formdata.append("mandatory_ingredient",mandatory_ingredient);
      formdata.append("launch",launch);                           formdata.append("years",years);
      formdata.append("tgl_launch",tgl_launch);                   formdata.append("aisle",aisle);
      formdata.append("data_forecast",data_forecast);             formdata.append("nfi_price",nfi_price);
      formdata.append("costumer_price",costumer_price);           formdata.append("competitor",competitor);
      formdata.append("competitive",competitive);                 formdata.append("product_form",product_form);
      formdata.append("data_form",data_form);                     formdata.append("primary",primary);
      formdata.append("secondary",secondary);                     formdata.append("tertiary",tertiary);
      formdata.append("bpom",bpom);                               formdata.append("akg",akg);
      formdata.append("prefered_flavour",prefered_flavour);       formdata.append("idea",idea);
      formdata.append("product_benefits",product_benefits);       formdata.append("configuration",configuration);
      formdata.append("olahan",olahan);                           formdata.append("type",type);

      // let xhr = new XMLHttpRequest();
      // xhr.open("POST","https://smo.nutrifood.co.id/api/update",true);
      // xhr.send(formdata);
      // xhr.onload = () => alert(xhr.response);
  }
</script>
@endsection