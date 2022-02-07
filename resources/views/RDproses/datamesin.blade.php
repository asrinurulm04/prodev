@extends('layout.tempvv')
@section('title', 'feasibility|Mesin')
@section('content')

<div class="x_panel">
  <div class="col-md-12"> <h3><li class="fa fa-cogs"> Workbook</li></h3></div>
  @if($fs->id_project!=NULL)
  <div class="x_panel">
    <div class="col-md-5">
      <table>
        <thead>
          <tr><th>Brand</th><td> : {{$pkp->id_brand}}</td></tr>
          <tr><th width="25%">PKP Number</th><td> : {{$pkp->pkp_number}}{{$pkp->ket_no}}</td></tr>
          <tr><th>Created</th><td> : {{$pkp->created_date}}</td></tr>
        </thead>
      </table>
    </div>
    <div class="col-md-7">
    <table>
      <thead>
        <tr><th>Idea</td> <td> : {{$pkp->idea}}</td></tr>
        <tr><th>Configuration</th><td>: 
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
          </td></tr>
          @if($lokasi != NULL)
          <tr><th>Production Location</th><td> : @foreach($lokasi as $lokasi) {{$lokasi->IO}} , @endforeach</td></tr>
          @endif
        </thead>
      </table>
    </div>
  </div>
  @elseif($fs->id_project_pdf!=NULL)
  <div class="x_panel">
    <div class="col-md-5">
      <table>
        <thead>
          <tr><th>Brand</th><td> : {{$pdf->datapdf->id_brand}}</td></tr>
          <tr><th width="25%">PDF Number</th><td> : {{$pdf->datapdf->pdf_number}}{{$pdf->datapdf->ket_no}}</td></tr>
          <tr><th>PV</th><td> : {{$pdf->perevisi2->name}}</td></tr>
        </thead>
      </table>
    </div>
    <div class="col-md-7">
    <table>
      <thead>
        <tr><th>Background</td> <td> : {{$pdf->background}}</td></tr>
        <tr><th>Configuration</th><td>: 
          @if($pdf->kemas_eksis!=NULL)(
            @if($pdf->kemas->tersier!=NULL)
            {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }}
            @endif

            @if($pdf->kemas->sekunder1!=NULL)
            X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}}
            @endif

            @if($pdf->kemas->sekunder2!=NULL)
            X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }}
            @endif

            @if($pdf->kemas->primer!=NULL)
            X{{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }}
            @endif )
          @endif
        </td></tr>
        @if($lokasi != NULL)
        <tr><th>Production Location</th><td> : @foreach($lokasi as $lokasi) {{$lokasi->IO}} , @endforeach</td></tr>
        @endif
      </thead>
    </table>
    </div>
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-6">
    <!-- filter data -->
    <div class="panel panel-default">
	    <div class="panel-heading">
        <h2><li class="fa fa-filter"></li> Filter Data</h2>
      </div>
      <div>
        <div>
          <form id="clear">
          <div class="col-md-5 pl-1">
            <div class="form-group" id="filter_col3" data-column="3">
              <label>Kategori</label>
              <select name="status" class="form-control column_filter" id="col3_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($kategori as $kategori)
                <option>{{$kategori->kategori}}</option>
                @endforeach
              </select>
            </div>
          </div>  
          <div class="col-md-5 pl-1">
            <div class="form-group" id="filter_col1" data-column="1">
              <label>Workcenter</label>
              <select name="brand" class="form-control column_filter" id="col1_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($wsMesin as $wsMesin)
                <option>{{$wsMesin->workcenter}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-2 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label class="text-center">refresh</label>  <br>  
              <a href="" class="btn btn-info btn-sm"><li class="fa fa-refresh"></li></a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- filter data selesai -->
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data Mesin</li></h3>
      </div>
      <!-- table pilih mesin -->
        <form id="demo-form2" data-parsley-validate class="form" action="{{route('Mdata')}}" method="post">
        <table id="datatable"  class="table table-striped table-bordered ex" style="width:100%" id="ex">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th></th>
              <th>workcenter</th>
              <th class="hidden-phone">IO</th>
              <th class="hidden-phone">Kategori</th>
              <th class="hidden-phone">Nama mesin</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mesins as $mesin)
            <tr>
              <input type="hidden" value="{{$ws}}" name="id_ws" id="id_ws">
              <td width="5%"><input type="checkbox" id="pmesin" name="pmesin[]" value="{{ $mesin->id_data_mesin }}"></td>
              <td>{{ $mesin->workcenter }}</td>
              <td>{{ $mesin->IO }}</td>
              <td>{{ $mesin->kategori }}</td>
              <td>{{ $mesin->nama_mesin }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <center>
        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
        {{ csrf_field() }}
        </form>
        </center>
    </div>
  </div>

<!---------------------------------------------------------------------------------------------------->
  <!-- Data Mesin -->
  <div class="col-md-6"> 
    <div class="x_panel">
      <div class="card-block">
        <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li><b> Use Tempale</b></button>
      </div>
    </div>                                
    <div class="card-block x_panel">
      <div class="x_title">
        <h3><li class="fa fa-folder-o"> Data Terpilih</li></h3>
      </div>
      <div class="form-panel" style="min-height:460px">
      <!-- data yang dipilih -->
      <form id="demo-form2" data-parsley-validate class="form" action="{{route('runtime')}}" method="post">
      @if(auth()->user()->departement_id=='2')
      <div class="form-group row">
        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Rasio</label>
        <div class="col-md-9 col-sm-8 col-xs-12">
          <input type="text" name="rasio" id="rasio" class="form-control col-md-12 col-xs-12">
        </div>
      </div>
      @endif
      @if(auth()->user()->departement_id=='1')
      <table class="table table-hover table-bordered" id="tabledata">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center" width="30%">Manual</th>
            <th class="text-center" width="15%">SDM</th>
            <th class="text-center" width="20%">Runtime (menit/batch)</th>
            <th class="text-center" width="35%">Note</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($Mdata2 as $dM2)
          <tr>
            <td><input value="{{$dM2->manual}}" name="mesin[]" class="form-control"></td>
            <td><input value="{{$dM2->sdm}}" name="sdm[]" class="form-control" type="number"></td>
            <td><input value="{{$dM2->runtime}}" name="runtime[]" class="form-control" type="number"></td>
            <td><textarea value="{{$dM2->note}}"  name="note[]" id="note" rows="3" class="form-control">{{$dM2->note}}</textarea></td>
            <td><a href="{{ route('destroymesin',$dM2->id_mesin) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
          </tr>
          @endforeach
          <tr>
            <input type="hidden" value="{{$id}}" name="idd">
            <input type="hidden" value="{{$ws}}" name="ws">
            <td><input type="text" value="-" name="mesin[]" id='sdm' class="form-control"></td>
            <td><input type="text" value="0" name="sdm[]" id='sdm' class="form-control"></td>
            <td><input type="text" value="0" name="runtime[]" id='runtime' class="form-control"></td>
            <td><textarea name="note[]" value="-" id="note" rows="3" class="form-control"></textarea></td>
						<td><button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button></td>
          </tr>
        </tbody>
      </table>
      @endif
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th></th>
            <th class="text-center" width="30%">Mesin</th>
            @if(auth()->user()->departement_id=='2')
            <th class="text-center" width="15%">Runtime (menit/batch granulasi)</th>
            @elseif(auth()->user()->departement_id=='1')
            <th class="text-center" width="15%">SDM (jika berbeda dengan eksis)</th>
            @endif
            <th class="text-center" width="20%">Runtime (menit/batch)</th>
            <th class="text-center" width="35%">Note</th>
          </tr>
        </thead>
        <tbody>
          @php $nom = 0; @endphp
          @foreach($Mdata as $dM)
          @php ++$nom; @endphp
          <tr id="row{{$dM->id_mesin}}">
            <input type="hidden" value="{{$id}}" name="idd">
            <input type="hidden" value="{{$fs->id}}" name="fs">
            <input type="hidden" value="{{$ws}}" name="ws">
            <input type="hidden" value="{{$dM->id_mesin}}" name="scores[{{$loop->index}}][id]">
            <td><a href="{{ route('destroymesin',$dM->id_mesin) }}" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
            <td>{{ $dM->nama_mesin }}</td>
            <td>
            @if(auth()->user()->departement_id=='2')
              @if($dM->aktifitas_lain=='Granulasi') 
              <input type="text" class="form-control" name="scores[{{$loop->index}}][granul]" value="{{$dM->runtime_granulasi}}"  id='granulasi{{$nom}}'> 
              @elseif($dM->aktifitas_lain==NULL) 
              <input type="hidden" class="form-control" name="scores[{{$loop->index}}][granul]" value="0"> 
              @endif
              <input value="0" type="hidden" name="scores[{{$loop->index}}][sdm]" id='sdm' class="form-control">
            @elseif(auth()->user()->departement_id=='1')
              <input type="hidden" class="form-control" name="scores[{{$loop->index}}][granul]" value="0"> 
              <input value="{{$dM->sdm}}" type="number" name="scores[{{$loop->index}}][sdm]" id='sdm' class="form-control">
            @endif
            </td>
            <td><input value="{{$dM->runtime}}" type="text" name="scores[{{$loop->index}}][runtime]" id='runtime{{$nom}}' class="form-control"></td>
            <td><textarea value="{{$dM->note}}" name="scores[{{$loop->index}}][note]" id="note" rows="2" class="form-control">{{$dM->note}}</textarea></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- data selesai -->
      <div class="col-md-6 col-md-offset-5">
      @if($hitung != '0')
      <button class="btn btn-primary btn-sm" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan??')" type="submit"><li class="fa fa-check"></li> Save And Next</button>
      {{ csrf_field() }}
      @endif
      </div>
      </form>
      </div><br>
    </div>
  </div>
</div>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Template PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <td class="text-center" width="5%">No</td>
              <td class="text-center" width="15%">#</td>
              <td class="text-center" width="15%">Project Number</td>
              <td class="text-center" width="15%">Formula</td>
              <td class="text-center" width="35%">Note</td>
              <td width="5%"></td>
            </tr>
          </thead>
          @php $nol = 0; @endphp
          @foreach($WorkbookFs as $WorkbookFs)
            <tr>
              <th class="text-center">{{ ++$nol }}</th>
              <th>{{ $WorkbookFs->name }}</th>
              @if($WorkbookFs->id_project!='NULL')
              <th>{{ $WorkbookFs->fs->pkp->pkp_number }}{{ $WorkbookFs->fs->pkp->ket_no }}</th>
              @elseif($WorkbookFs->id_project_pdf!='NULL')
              <th>{{ $WorkbookFs->fs->pdf->pdf_number }}{{ $WorkbookFs->fs->pdf->ket_no }}</th>
              @endif
              <th>{{ $WorkbookFs->fs->workbook->formula }}</th>
              <th>{{ $WorkbookFs->note }}</th>
              <th width="21%" class="text-center">
                <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to use this template?')" href="{{route('useMesin',[$WorkbookFs->id,$ws])}}"><i class="fa fa-check"></i></a>
              </th>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#tabledata').on('click', 'tr a', function(e) {
      e.preventDefault();
      var lenRow = $('#tabledata tbody tr').length;
      if (lenRow == 1 || lenRow <= 1) {
        alert("Tidak bisa hapus semua baris!!");
      } else {
        $(this).parents('tr').remove();
      }
    });
  
    var i = 1;
    $("#add_data").click(function() {
      $('#addrow' + i).html(
        "<td><input type='text' name='mesin[]' class='form-control data' /></td>"+
				"<td><input type='text' name='sdm[]' class='form-control data' /></td>"+
				"<td><input type='text' name='runtime[]' class='form-control data' /></td>"+
				"<td><textarea rows='3' type='text' required name='note[]' class='form-control' ></textarea></td>"+
				"<td><a type='button' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
				"</td>");
      $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
      i++;
    });
  });
</script>
<script>
  function filterGlobal () {
    $('.ex').DataTable().search(
      $('#global_filter').val(),
    ).draw();
  }
    
  function filterColumn ( i ) {
    $('.ex').DataTable().column( i ).search(
      $('#col'+i+'_filter').val()
    ).draw();
  }
    
  $(document).ready(function() {
    $('.ex').DataTable();    
    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    });
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('div').attr('data-column') );
    } );
  });
  $('select.column_filter').on('change', function () {
    filterColumn( $(this).parents('div').attr('data-column') );
  } );
</script>
<script type="text/javascript">
  var i = {{ $nom }} ;
  var y;
  $( "#rasio" ).keyup(function() {
    var value = $( "#rasio" ).val();
    for(y=1;y<=i;y++){
      granulasi     = $("#granulasi"+y).val();
      total         = parseFloat(granulasi) / parseFloat(value);
      total  		    = parseFloat(total.toFixed(3));
      $("#runtime"+y).val(total);
    }
  })
</script>
@endsection