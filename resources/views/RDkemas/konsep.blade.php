@extends('layout.tempvv')
@section('title', 'feasibility|Kemas')
@section('content')
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-list"></li> Kemas </h4></div>
      <div class="col-md-6" align="right">
        <a href="{{ route('workbookfs',$pkp->id_project)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
      </div><hr><hr>
	    <div class="col-md-6 col-sm-6 col-xs-12 content-panel">
  		  <table>
	  		  <tr><th width="15%">Nama Produk </th><th width="45%">: {{ $pkp->project_name}}</th>
		  	  <tr><th width="15%">Tanggal Terima</th><th width="45%">: {{ $pkp->updated_at }}</th>
          <tr><th width="15%">No.PKP</th><th width="45%">: {{ $pkp->pkp_number }}{{$pkp->ketno}}</th>
		    </table>
  	  </div>
      <div class="col-md-6 col-sm-6 col-xs-12 content-panel">
		    <table>
        <tr><th width="10%">Versi Project</th><th width="45%">: {{ $pkp->revisi }}.{{$pkp->turunan}}</th>
		  	  <tr><th width="10%">Idea</th><th width="45%">: {{ $pkp->idea }}</th></tr>
		    </table>
	    </div>
    </div> 

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"> Konsep Kemas</li></h3>
      </div>
      <div>
        <form id="demo-form2"  class="form-horizontal form-label-left" action="" method="post">
          <div class="form-group row">
            <label class=" col-md-1 col-sm-1 col-xs-12">Batch Size</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
            <label class=" col-md-1 col-sm-1 col-xs-12">Batch/Yield</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
            <label class=" col-md-1 col-sm-1 col-xs-12">Jml box/batch</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
          </div>
          <div class="form-group row">
            <label class=" col-md-1 col-sm-1 col-xs-12">Box/palet</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
            <label class=" col-md-1 col-sm-1 col-xs-12">Referensi</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
            <label class=" col-md-1 col-sm-1 col-xs-12">IO</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
          </div>
          <div class="form-group row">
            <label class=" col-md-1 col-sm-1 col-xs-12">Kubikasi/batch</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
          </div><br>
        <table class="table table-bordered">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th class="text-center">Kategori Mesin</th>
              <th class="text-center">Nama Mesin</th>
              <th class="text-center">Runtime</th>
              <th class="text-center">Note</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <select name="" id="" class="form-control">
                  <option value="">--> Select One <--</option>
                </select>
              </td>
              <td>
                <select name="" id="" class="form-control">
                  <option value="">--> Select One <--</option>
                </select>
              </td>
              <td><input type="text" name="" id="" class="form-control" required></td>
              <td><input type="text" name="" id="" class="form-control" required></td>
              <td><button class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li></button></td>
            </tr>
          </tbody>
        </table>
        <div class="form-group row">
          <center>
            <label class=" col-md-2 col-sm-2 col-xs-12">Upload File</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input type="file" name="filename" class="form-control col-md-8 col-sm-8 col-xs-12" id="keterangan" required>
            </div>
            <label class=" col-md-2 col-sm-2 col-xs-12">Format File (.xlsx)</label>
          </center>
        </div><br>
        <div class="ln_solid"></div>
        <div class="form-group"><br>
          <center>
            <button type="submit" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan?? ?')" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection