@extends('formula.tempformula')
@section('title', 'Data Panel')
@section('judul', 'Data Panel')
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

<div class="col-md-12 col-sm-12 col-xs-12 content-panel">
  <div class="panel panel-default"><br>
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <li role="presentation" class="active"><a href="{{ route('panel',[ $idfor, $idf]) }}">DATA PANEL</a></li>
      <li role="presentation" class=""><a href="{{ route('st',[ $idfor, $idf]) }}">DATA STOREGE</a></li>
    </ul>
	  <div class="panel-body">
      <div class="form-group">
        @if($cek_panel=='null')
        <div class="col-md-12 col-sm-12 col-xs-12">
          <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilpanel') }}" novalidate>
            <span class="section">Form Panel</span>
            <input type='hidden' name='idf' maxlength='45' value='{{$fo->id}}' class='form-control col-md-7 col-xs-12'>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Panel</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" id="date" name="date" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pilih Panel</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="panel" id="panel">
                  <option value="">---</option>
                  @foreach ($panel as $keys => $value)
                  <option value="{{$value->id}}">{{$value->panel}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Formula</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="formula" id="formula" required="required" value="{{ $myFormula->nama_produk}}" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nilai</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nilai" name="nilai" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hasil</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="hasil" name="hasil" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rata-rata</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="rata" name="rata" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Panelis</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="panelis" name="panelis" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Serving</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="serving" name="serving" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">HUS</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="hus" type="text" name="hus" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Komentar</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="komentar" required="required" name="komentar" class="form-control col-md-7 col-xs-12"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Kesimpulan</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="kesimpulan" required="required" name="kesimpulan" class="form-control col-md-7 col-xs-12"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
              </div>
            </div>
          </form>
        </div>
        @elseif($cek_panel!=0)
        <button class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#panel"> Tambah Data Panel ?</button>
        {{-- Modal --}}
        <div class="modal fade" id="panel" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="NWModalLabel">Data Panel Baru </h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('hasilpanel') }}" novalidate>
                  <input type='hidden' name='idf' maxlength='45' value='{{$fo->id}}' class='form-control col-md-7 col-xs-12'>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Panel</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="date" id="date" name="date" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pilih Panel</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <select class="form-control" name="panel" id="panel">
                        <option value="">---</option>
                        @foreach ($panel as $keys => $value)
                        <option value="{{$value->id}}">{{$value->panel}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Formula</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" id="formula" name="formula" value="{{ $myFormula->nama_produk}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nilai</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" id="nilai" name="nilai" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hasil</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" id="hasil" name="hasil" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rata-rata</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" id="rata" name="rata" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Panelis</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" id="panelis" name="panelis" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Serving</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" id="serving" name="serving" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">HUS</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input id="hus" type="text" name="hus" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Komentar</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea id="komentar" required="required" name="komentar" class="form-control col-md-7 col-xs-12"></textarea>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Kesimpulan</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea id="kesimpulan" required="required" name="kesimpulan" class="form-control col-md-7 col-xs-12"></textarea>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <button type="reset" class="btn btn-danger">Reset</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                      {{ csrf_field() }}
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div><br><br>
        {{-- Modal Selesai --}}
        <table id="myTable" class="table table-hover table-bordered">
          <tr style="background-color:#d8d0d2;">
            <th class="text-center">No</th>
            <th class="text-center">Tanggal Panel</th>
            <th class="text-center">Jenis Panel</th>
            <th class="text-center">Formula</th>
            <th class="text-center">Panelis</th>
            <th class="text-center">Serving</th>
            <th class="text-center">HUS</th>
            <th class="text-center">kesimpulan</th>
            <th></th>
          </tr>
          @php $no = 0; @endphp
          @foreach($pn as $pn)
          <tr>
            <td>{{ ++$no}}</td>
            <td width="10%" class="text-center">{{ $pn->tgl_panel }}</td>
            <td width="14%">{{ $pn->panel }}</td>
            <td width="20%">{{ $pn->formula }}</td>
            <td>{{ $pn->panelis }}</td>
            <td>{{ $pn->serving }}</td>
            <td>{{ $pn->hus }}</td>		
            <td>{{ $pn->kesimpulan }}</td>
            <td width="14%" class="text-center">
              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ayo{{$pn->id}}" title="Show"><li class=" fa fa-eye"></li></button>
              <!-- modal -->
              <div class="modal fade" id="ayo{{ $pn->id }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="NWModalLabel">Info Detail </h4>
                    </div>
                    <div class="modal-body" style="overflow-x: scroll;">
                      <table id="myTable" class="table table-hover table-bordered">
                        <tr style="background-color:#d8d0d2;">
                          <th class="text-center">Tanggal Panel</th>
                          <th class="text-center">Jenis Panel</th>
                          <th class="text-center">Formula</th>
                          <th class="text-center">Nilai</th>
                          <th class="text-center">Hasil</th>
                          <th class="text-center">Rata-rata</th>
                          <th class="text-center">Panelis</th>
                          <th class="text-center">Serving</th>
                          <th class="text-center">HUS</th>
                          <th class="text-center">Komentrar</th>
                          <th class="text-center">kesimpulan</th>
                        </tr>
                        <tr>
                          <td width="10%" class="text-center">{{ $pn->tgl_panel }}</td>
                          <td width="14%">{{ $pn->panel }}</td>
                          <td width="20%">{{ $pn->formula }}</td>
                          <td>{{ $pn->nilai }}</td>
                          <td>{{ $pn->hasil }}</td>
                          <td>{{ $pn->rata_rata }}</td>
                          <td>{{ $pn->panelis }}</td>
                          <td>{{ $pn->serving }}</td>
                          <td>{{ $pn->hus }}</td>		
                          <td>{{ $pn->komentar }}</td>
                          <td>{{ $pn->kesimpulan }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{$pn->id}}" title="Edit"><li class=" fa fa-edit"></li></button>
              <!-- modal -->
              <div class="modal fade" id="edit{{ $pn->id }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body" style="overflow-x: scroll;">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ route('editpanel',$pn->id) }}" novalidate>
                        <span class="section">Edit Panel</span>
                        <input type='hidden' name='idf' maxlength='45' value='{{$fo->id}}' class='form-control col-md-7 col-xs-12'>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Panel</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="date" value="{{$pn->tgl_panel}}" id="date" name="date" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pilih Panel</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control" name="panel" id="panel">
                              <option value="{{$pn->panel}}">{{$pn->panel}}</option>
                              @foreach ($panel as $keys => $value)
                              <option value="{{$value->id}}">{{$value->panel}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Formula</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="formula" id="formula" readonly required="required" value="{{ $myFormula->workbook->datapkpp->project_name}}" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nilai</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="nilai" name="nilai" value="{{$pn->nilai}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hasil</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="hasil" name="hasil" value="{{$pn->hasil}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rata-rata</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="rata" name="rata" value="{{$pn->rata_rata}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Panelis</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="panelis" name="panelis" value="{{$pn->panelis}}" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Serving</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="serving" name="serving" value="{{$pn->serving}}" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">HUS</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="hus" type="text" name="hus" value="{{$pn->hus}}" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Komentar</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea id="komentar" required="required" value="{{$pn->komentar}}" name="komentar" class="form-control col-md-7 col-xs-12">{{$pn->komentar}}</textarea>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Kesimpulan</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea id="kesimpulan" required="required" value="{{$pn->kesimpulan}}" name="kesimpulan" class="form-control col-md-7 col-xs-12">{{$pn->kesimpulan}}</textarea>
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            {{ csrf_field() }}
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <a href="{{route('deletepanel',$pn->id)}}" class="btn btn-sm btn-danger" title="Delete"><li class="fa fa-trash"></li></a>
            </td>	
          </tr>
          @endforeach	
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

@section ('s')
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
<script>
  $(document).ready(function(){
	  // console.log(analisis[1][1])
  })
  $('#btnAdd').click(function(e) {
		var panels = []
		<?php foreach($panel as $key => $value) { ?>
			if(!panels){
				panels += [
					{
						'<?php echo $key; ?>' : '<?php echo $value->panel; ?>',
					}
				];
			} else {
				panels.push({
					'<?php echo $key; ?>' : '<?php echo $value->panel; ?>',
				})
			}
		<?php } ?>

	var panel = [];
	var pilihan = '';
	for(var i = 0; i < Object.keys(panels).length; i++){
		pilihan += '<option value="'+panels[i][i]+'">'+panels[i][i]+'</option>';
	}

  $('#myTable tr:last').after(
      '<tr><td><select name="panel_'+$("tr:last")[0].rowIndex+'" class="form-control" id="panel' + $("tr:last")[0].rowIndex + '" >'+pilihan+'</select></td><td><input type="text" name="no_'+$("tr:last")[0].rowIndex+'" class="form-control" id="no' + $("tr:last")[0].rowIndex + '" /></td><td><input type="date" name="date_'+$("tr:last")[0].rowIndex+'" class="form-control" id="date' + $("tr:last")[0].rowIndex + '" /></td><td><input type="text" name="hasil_'+$("tr:last")[0].rowIndex+'" class="form-control" id="date' + $("tr:last")[0].rowIndex + '" /></td></tr>'
		);
  $('#lab').val($('tr:last')[0].rowIndex);
  });

</script>

@endsection