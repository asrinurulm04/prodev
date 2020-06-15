@extends('devwb.tempwb')
@section('title', 'Formula')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="showback">
    <h4>INFORMASI WORKBOOK</h4><br>
    <table class="table table-hover">
      <tbody>
        <tr>
          <td>NAMA WORKBOOK</td>
          <td>{{ $workbooks->nama_project}}</td>
        </tr>
        <tr>
          <td>MANDATORY REQUIREMENT</td>
          <td>{{ $workbooks->mnrq}}</td>
        </tr>
        <tr>
          <td>TARGET KONSUMEN</td>
          <td>{{ $workbooks->tarkon->tarkon}}</td>
        </tr>
        <tr>
          <td>TOTAL VERSI FORMULA</td>
          <td>{{ $cf }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="showback">
    <button type="button" class="btn btn-primary" disable>STATUS WORKBOOK : {{ $workbooks->status }}{{ ($workbooks->status == null) ? ' --------- ' : '' }}</button>
    <h4>ACTION</h4>
    <button class="btn btn-theme03" data-toggle="modal" data-target="#editwb"><i class="fa fa-edit"></i> Edit Workbooks</button>
    
    @if($cf == 0)
    <button class="btn btn-info" data-toggle="modal" data-target="#FB"><i class="fa fa-plus"></i>Formula Baru</button>
    @elseif($cf>0)
    <a class="btn btn-info" onclick="return confirm('Naik Versi Formula ?')" href="{{ route('upversion',['cf'=>$cf,'id'=>$workbooks->id]) }}"><i class="fa fa-plus"></i> Naik Versi</a>
    @endif

    @if($cs<0)
    <a class="btn btn-warning" href="{{ route('workbook.selesai',$workbooks->id) }}" onclick="return confirm('Selesaikan Project ?')"><i class="fa fa-check"></i> SELESAI</a>
    @endif

    @if(@cp>0)
    <a class="btn btn-danger"><i class="fa fa-times"></i> BATAL</a>
    @endif
    <button class="btn btn-theme04" data-toggle="modal" data-target="#alihkan_wb" ><i class="fa fa-user"></i> Alihkan Project</button>
  </div>
</div>

<!-- FORMULA PROSES -->
@if($cp>0)
<div class="row mt">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="showback"><h4>FORMULA YANG SEDANG DIPROSES</h4>
      <table class="table table-striped table-advance table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Kode Forpros</th>
            <th>Nama Produk</th>
            <th>Revisi</th>
            <th>Versi</th>
            <th>PV</th>
            <th>Feasibility</th>
            <th>Nutfact</th>
            <th>Status</th>
            <th>Action</th>
            <th>Pengajuan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $Forpros->id}}</td>
            <td>{{ $Forpros->kode_formula}}</td>
            <td>{{ $Forpros->nama_produk}}</td>
            <td>{{ $Forpros->revisi}}</td>
            <td>{{ $Forpros->versi}}</td>
            <td>{{ $Forpros->vv}}</td>
            <td>{{ $Forpros->status_fisibility}}</td>
            <td>{{ $Forpros->status_nutfact}}</td>
            <td>{{ $Forpros->status}}</td>
            <td>
              {{csrf_field()}}
              <a class="btn btn-info" href="{{ route('formula.detail',$Forpros->id) }}">Show</a>
              @if($Forpros->status!='proses')
              <a class="btn btn-warning" href="{{ route('step1',$Forpros->id) }}">Edit</a>
              @endif
            </td>
            <td>
            @if($workbooks->status!='proses')
              @if($Forpros->status!='proses')
                @if(empty($Forpros->vv))
                  <a class="btn btn-info" onclick="return confirm('Ajukan Formula Kepada PV ?')" href="{{ route('ajukanvp',$Forpros->id) }}">PV</a>
                @endif
                @if($Forpros->vv=='ok')
                  @empty($Forpros->status_fisibility)
                  <a class="btn btn-info" onclick="return confirm('Ajukan Formula Untuk Proses Feasibility ?')" href="{{ route('ajukanfs',$Forpros->id) }}">Feasibility</a>
                  @endempty
                  @empty($Forpros->status_nutfact)
                  <a class="btn btn-primary" onclick="return confirm('Ajukan Formula untuk Proses Nutfact ?')" href="{{ route('ajukannf',$Forpros->id) }}">Nutfact</a>
                  @endempty
                @endif
              @endif
            @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <a class="btn btn-primary btn-lg btn-block" id="tfl" href="#Table"><i class="fa fa-bars"></i> List Formula</a>     
  </div>
</div>
@endif
        
<div class="row mt" id="FL">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="showback"><h4>FORMULA LIST</h4>
      <table class="table table-striped table-advance table-hover" id="Table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Kode Formula</th>
            <th>Nama Produk</th>
            <th>Revisi</th>
            <th>Versi</th>
            <th>PV</th>
            <th>Feasibility</th>
            <th>Nutfact</th>
            <th>Status</th>
            <th>Action</th>
            <th>Pengajuan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($formulas as $formula)
          <tr>
            <td>{{ $formula->id}}</td>
            <td>{{ $formula->kode_formula}}</td>
            <td>{{ $formula->nama_produk}}</td>
            <td>{{ $formula->revisi}}</td>
            <td>{{ $formula->versi}}</td>
            <td>{{ $formula->vv}}</td>
            <td>{{ $formula->status_fisibility}}</td>
            <td>{{ $formula->status_nutfact}}</td>
            <td>{{ $formula->status}}</td>
            <td>
              {{csrf_field()}}
              <a class="btn btn-info" href="{{ route('formula.detail',$formula->id) }}">Show</a>
              @if($formula->status!='proses')
              <a class="btn btn-warning" href="{{ route('step1',$formula->id) }}">Edit</a>
              @endif
            </td>
            <td>
            @if($workbooks->status!='proses')
              @if($formula->status!='proses')
                @if(empty($formula->vv))
                  <a class="btn btn-info" href="{{ route('ajukanvp',$formula->id) }}">PV</a>
                @endif
                @if($formula->vv=='ok')
                  @empty($formula->status_fisibility)
                  <a class="btn btn-info" href="{{ route('ajukanfs',$formula->id) }}">Feasibility</a>
                  @endempty
                  @empty($formula->status_nutfact)
                  <a class="btn btn-primary" href="{{ route('ajukannf',$formula->id) }}">Nutfact</a>
                  @endempty
                @endif
              @endif
            @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Formula Baru -->
<div class="modal fade" id="FB" tabindex="-1" role="dialog" aria-labelledby="hm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="hm">Formula Baru</h4>
      </div>
      <div class="modal-body">
      <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('addformula') }}">        
      <input class="form-control " id="workbook_id" name="workbook_id" type="hidden" value="{{ $workbooks->id}}"/>   
        <div class="form-group">
          <label class="col-lg-4 control-label">Nama Produk</label>
          <div class="col-lg-8">
            <input class="form-control " id="nama_produk" name="nama_produk" type="text" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-4 control-label">Jenis Formula</label>
            <div class="col-lg-8">
              <select class="form-control" id="jenis" name="jenis">
                <option value="baru">Baru</option>
                <option value="revisi">Revisi</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Revisi</label>
            <div class="col-lg-8">
              <input class="form-control " id="revisi" name="revisi" type="text" required/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Kode Formula</label>
            <div class="col-lg-8">
              <input class="form-control " id="kode_formula" name="kode_formula" type="text" required/>
            </div>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus-plus"></i> Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Workbook -->
<div class="modal fade" id="editwb" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="EWBModalLabel">Edit Workbook</h4>
      </div>
      <form class="cmxform form-horizontal style-form" id="new" method="POST" action="{{ route('updateworkbooks',$workbooks->id) }}">           
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-4 control-label">Nama Project</label>
          <div class="col-lg-8">
            <input class="form-control" id="nama" name="nama" type="text" value="{{ $workbooks->nama_project }}" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-4 control-label">Mandatory Requirement</label>
          <div class="col-lg-8">
            <input class="form-control" id="mnrq" name="mnrq" type="text" value="{{ $workbooks->mnrq }}" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-4 control-label">Target Konsumen</label>
          <div class="col-lg-8">
            <select class="form-control" id="tarkon" name="tarkon" style="width:300px">
              @foreach($tarkons as $tarkon)
              <option value="{{ $tarkon->id }}"{{ ( $tarkon->id == $workbooks->tarkon_id ) ? ' selected' : '' }} >{{ $tarkon->tarkon }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PATCH') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Alihkan Workbook -->
<div class="modal fade" id="alihkan_wb" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="EWBModalLabel">Pengalihan Project</h4>
      </div>
      <form method="POST" action="{{ route('alihkan',$workbooks->id) }}">   
      <div class="modal-body">   
        <table class="table">
          <tbody>
            <tr>
              <td>NAMA PROJECT</td>
              <td>{{ $workbooks->nama_project}}</td>
            </tr>
            <tr>
              <td>MANDATORY REQUIREMENT</td>
              <td>{{ $workbooks->mnrq}}</td>
            </tr>
            <tr>
              <td>TARGET KONSUMEN</td>
              <td>{{ $workbooks->tarkon->tarkon}}</td>
            </tr>
            <tr>
              <td>STATUS PROJECT</td>
              <td>{{ $workbooks->keterangan }}</td>
            </tr>
            <tr>
              <td>TOTAL VERSI FORMULA</td>
              <td>{{ $cf }}</td>
            </tr>
            <tr>
              <td>PILIH PENERIMA PROJECT</td>
              <td>
                <select class="cari form-control" style="width:300px;" id="user" name="user">
                  @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PATCH') }}
      </div>
      <div class="modal-footer">
      <button type="submit" onclick="return confirm('Alihkan Project ?')" class="btn btn-theme03"><i class="fa fa-send"></i> Alihkan</button>
      </form>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      </div>
    </div>
  </div>
</div>              
@endsection

@section('s')
<script type="text/javascript">
  $('.cari').select2();
  $('#tarkon').select2()

  $(document).ready(function(){  
    $("#tfl").click(function(e) {
      e.preventDefault();
      $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
      }, 1000);
    });
  });
</script>
@endsection