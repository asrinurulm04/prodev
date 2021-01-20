@extends('pv.tempvv')
@section('title', 'PRODEV|Data Bahan Baku Eksis')
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
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <table class="Table table-bordered" style="font-size:12px" id="Table">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Nama_Sederhana</th>
            <th>Nama_Bahan </th>
            <th>Kode_Oracle</th>
            <th>Kode_Komputer</th>
            <th>Supplier</th>
            <th>Principle</th>
            <th>no_HEIPBR</th>
            <th>Harga Satuan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bahans as $bahan)
            <tr>
              <td>{{ $bahan->id }}</td>
              <td>{{ $bahan->nama_sederhana }}</td>
              <td>{{ $bahan->nama_bahan }}</td>
              <td>{{ $bahan->kode_oracle }}</td>
              <td>{{ $bahan->kode_komputer }}</td>
              <td>{{ $bahan->supplier }}</td>
              <td>{{ $bahan->principle }}</td>
              <td>{{ $bahan->no_HEIPBR }}</td>
              <td><?php $angka_format = number_format($bahan->harga_satuan,2,",","."); echo "Rp. ".$angka_format;?></td>
              <td width="10%" class="text-center">
                <a href="{{route('edit_bahan',$bahan->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit"></li></a>
                @if($bahan->status == 'active')
                <a class="btn btn-danger btn-sm" onclick="return confirm('NonAktif BahanBaku ?')" href="{{ route('nonactivebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="NonActive"><i class="fa fa-minus"></i></a>
                @elseif($bahan->status == 'inactive')
                <a class="btn btn-info btn-sm" onclick="return confirm('Aktifkan BahanBaku ?')" href="{{ route('activebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></a>
                @endif
              </td>
            </tr>
            <!-- Edit Ingredient -->
            <div class="modal fade" id="edit_bahan{{$bahan->id}}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-edit"></i> Edit Bahan Baku</h4>
                  </div>
                  <form method="POST" action="{{ route('storeupdatebahan',$bahan->id) }}">
                  <div class="modal-body"> 
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="nama_sederhana" class="control-label">Nama Sederhana</label>
                        <input class="form-control" id="nama_sederhana" name="nama_sederhana"  type="text" value="{{ $bahan->nama_sederhana }}" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="nama_bahan" class="control-label">Nama Bahan</label>
                        <input class="form-control" id="nama_bahan" name="nama_bahan"  type="text" value="{{ $bahan->nama_bahan }}" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="kode_oracle" class="control-label">Kode_Oracle</label>
                        <input class="form-control" id="kode_oracle" name="kode_oracle"  type="text" value="{{ $bahan->kode_oracle }}" required />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="kode_komputer" class="control-label">Kode_Komputer</label>
                        <input class="form-control" id="kode_komputer" name="kode_komputer"  type="text" value="{{ $bahan->kode_komputer }}" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="supplier" class="control-label">Supplier</label>
                        <input class="form-control" id="supplier" name="supplier"  type="text" value="{{ $bahan->supplier }}" required />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="principle" class="control-label">Principle</label>
                        <input class="form-control" id="principle" name="principle"  type="text" value="{{ $bahan->principle }}" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="no_HEIPBR" class="control-label">No HEIPBR</label>
                        <input class="form-control" id="no_HEIPBR" name="no_HEIPBR"  type="text" value="{{ $bahan->no_HEIPBR }}" required />
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="PIC" class="control-label">PIC</label>
                        <input class="form-control" id="PIC" name="PIC"  type="text" value="{{ $bahan->PIC }}" required />
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="cek_halal" class="control-label">Cek Halal</label>
                        <input class="form-control" id="cek_halal" name="cek_halal"  type="text" value="{{ $bahan->cek_halal }}" required />
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="" class="control-label">Kategori</label><br>
                        <select id="subkategori" name="subkategori" class="form-control">
                          @foreach($subkategoris as $subkategori) 
                          <option value="{{  $subkategori->id }}" {{ $bahan->subkategori_id == $subkategori->id ? 'selected' : '' }}>{{ $subkategori->subkategori }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="berat" class="control-label">Berat</label>
                        <input type="number" step="any" class="form-control" id="berat" name="berat" value="{{ $bahan->berat }}" required />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="" class="control-label">Satuan</label><br>
                        <select id="satuan" name="satuan" class="form-control">
                          @foreach($satuans as $satuan) 
                          <option value="{{  $satuan->id }}" {{ $bahan->satuan_id == $satuan->id ? 'selected' : '' }} >{{ $satuan->satuan }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="harga_satuan" class="control-label">Harga Satuan</label>
                        <input type="number" step="any" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ $bahan->harga_satuan }}" required />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="" class="control-label">Currency</label><br>
                        <select id="curren" name="curren" class="form-control">
                          @foreach($currens as $curren) 
                          <option value="{{  $curren->id }}" {{ $bahan->curren_id == $curren->id ? 'selected' : '' }}>{{ $curren->currency }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="user" value="{{ Auth::id() }}">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Submit</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Selesai -->
          @endforeach
        </tbody>
	    </table>   
    </div>
  </div>
</div>
@endsection