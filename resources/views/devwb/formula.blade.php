@extends('formula.tempformula')
@section('title', 'Workbook')
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
  @foreach($pkp as $workbooks)
  <div class="x_panel"> 
    <div class="row">
      <div class="col-md-5">
        <h4><i class="fa fa-bell"></i> {{$workbooks->project_name}}</h4>      
      </div>
      <div class="col-md-7" align="right">
        @if($cf == 0)
        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FB"><i class="fa fa-plus"></i> New Formula</a>
        <!-- <a href="{{route('registrasi_formula',$workbooks->id)}}" class="btn btn-primary" type="button">Coba</a> -->
        @endif
        @if($workbooks->status == '')
        <a class="btn btn-success btn-sm" href="{{ route('workbook.selesai',$workbooks->id) }}" onclick="return confirm('Selesaikan Project ?')"><i class="fa fa-check"></i> Finish</a>
        <a class="btn btn-danger btn-sm" href="{{ route('workbook.batal',$workbooks->id) }}" onclick="return confirm('Batalkan Project ?')"><i class="fa fa-times"></i> Cencel</a>
        @endif
        <a class="btn btn-info btn-sm" href="{{ route('lihatpkp',['id'=>$workbooks->id_pkp,'revisi' => $workbooks->revisi,'turunan'=>$workbooks->turunan]) }}"><i class="fa fa-eye"></i> Show PKP</a>
        <a class="btn btn-danger btn-sm" href="{{ route('rekappkp',$workbooks->id_pkp) }}"><i class="fa fa-share"></i> Back</a>
      </div>
    </div>
    <hr style="border-color: #ddd">     
    <div class="row">
      <div class="col-md-5">        
        <table style="font-size: 13px">
          <tr>
            <td width="35%">No.PKP</td><td>&nbsp; : {{ $workbooks->pkp_number }}{{ $workbooks->ket_no }}</td>              
          </tr>
          <tr>
            <td>Brand</td><td>&nbsp; : {{ $workbooks->id_brand }}</td>
          </tr>
          <tr>
            <td>Target Konsumen</td><td>&nbsp; : {{ $workbooks->tarkon->tarkon }}</td>
          </tr>   
          <tr>
            <td>Launch Deadline</td><td>&nbsp; : {{$workbooks->launch}}{{$workbooks->years}}{{$workbooks->tgl_launch}}</td>
          </tr>           
        </table>
      </div>
      <div class="col-md-4">
        <table style="font-size:13px">
          <tr>
            <td style="width:100px">Note Serving</td><td>:</td><td>{{ $workbooks->serving_suggestion }}</td>
          </tr>
          <tr>
            <td>Idea</td><td>:</td><td>{{ $workbooks->idea }}</td>
          </tr>
          <tr>
            <td>PV</td><td>:</td><td>{{ $workbooks->perevisi2->name }}</td>
          </tr>
          <tr>
            <td>Sample Deadline</td><td>:</td><td>{{ $workbooks->jangka }} - {{ $workbooks->waktu }}</td>
          </tr>
        </table>
      </div>
      <div class="col-md-3">
        <div class="row" style="margin-right:20px">
          @if ($workbooks->status == '' )
          <div class="col-md-12" style="background-color:aquamarine">
            Status : Tidak Ada Proses
          </div>
          @endif
          @if ($workbooks->status == 'proses' )
          <div class="col-md-12" style="background-color:#f0ad4e;color:white">
            Status : Proses
          </div>
          @endif 
          @if ($workbooks->status == 'selesai' )
          <div class="col-md-12" style="background-color:chartreuse">
            Status : Selesai
          </div>
          @endif 
          @if ($workbooks->status == 'batal' )
          <div class="col-md-12" style="background-color:red;color:white">
            Status : Batal
          </div>
          @endif             
        </div>
      </div>
    </div>
    <hr style="border-color: #ddd">  
  </div>
  @endforeach

  {{-- LIST FORMULA --}}
  <div class="x_panel"> 
    <div id="" class="container">	
      <div class="x_title">
        <h4><li class="fa fa-star"></li> Product Features</h4>
      </div>
      <div class="tab-content ">
        {{-- List Formula --}}
        <div class="tab-pane active" id="1">
          <table class="table" id="Table">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">     
                <th class="text-center">#</th>                                  
                <th class="text-center">Versi</th>
                <th class="text-center">Category Formula</th>  
                <th class="text-center">Formula</th>
                <th class="text-center">Status Sample</th>
                <th class="text-center">Note RD</th>
                <th class="text-center">Note PV</th>
                <th class="text-center" width="15%">Action</th>
              </tr>
            </thead>                      
            <tbody>
              @foreach ($myformula->groupBy('versi') as $group)
              @foreach ($group->sortBy('turunan') as $formula)
                @if($formula['vv'] == 'final')
                <tr style="background-color:springgreen">
                @elseif($formula['vv'] == 'reject')
                <tr style="background-color:slategray;color:white">
                @else
                <tr>
                @endif               
                <td width="2%" class="text-center">
                  <a href="{{ route('deleteFormula',$formula['id']) }}" onclick="return confirm('Hapus Formula ?')"><i style="font-size:12px;" class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a>
                </td>      
                <td class="text-center" width="5%">{{ $formula['versi']}}.{{ $formula['turunan']}}</td>   
                <td class="text-center" width="10%  ">
                  @if($formula['kategori_formula']!='fg')
                  {{$formula['kategori_formula']}}
                  @elseif($formula['kategori_formula']=='fg')
                  Finished Good
                  @endif
                </td>
                <td width="15%">
                  {{$formula['formula']}}
                </td>
                <td class="text-center" width="10%">
                  @if ($formula['vv'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['vv'] == 'reject')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['vv'] == 'approve')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['vv'] == 'final')
                  <span class="label label-info">Final Approved</span>                        
                  @endif 
                  @if ($formula['vv'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif   
                </td>
                <td class="text-center">
                {{$formula['catatan_rd']}}
                </td>
                <td class="text-center">
                  @if($formula['vv'] == 'reject')
                  {{$formula['catatan_pv']}}    
                  @endif
                </td>
                <td class="text-center">
                  {{csrf_field()}}
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$formula['workbook_id'],$formula['id']]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                  <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#update" data-toggle="tooltip" title="Updata"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i></a>
                  
                  <!-- UpVersion -->
                  <div class="modal fade" id="update" role="dialog" aria-labelledby="hm" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="hm" style="font-weight: bold;color:black;"> Update Data</h4>
                        </div>
                        <div class="modal-body">
                          <a class="btn btn-primary btn-sm" href="{{ route('upversion',$workbooks->id_pkp) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                          <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$formula['id'],$formula['versi']]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                        </div
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($formula['status']!='proses')
                  <a class="btn btn-primary btn-sm" href="{{ route('step1',[$formula['workbook_id'],$formula['id']]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                  <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$formula['workbook_id'],$formula['id']]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                  @elseif($formula['vv'] == 'approve')
                    @if($formula['status_panel']=='proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('panel',[$formula['workbook_id'],$formula['id']]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                    @endif
                    @if($formula['status_storage']=='proses')
                    <a class="btn btn-warning btn-sm" href="{{ route('st',[$formula['workbook_id'],$formula['id']]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
              @endforeach
            </tbody> 
          </table>     
        </div>
      </div>
    </div>         
  </div>             
</div>

<!-- Formula Baru -->
<div class="modal fade" id="FB" role="dialog" aria-labelledby="hm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="hm"> New Formula</h4>
      </div>
      <div class="modal-body">
        <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('addformula') }}">
        <input class="form-control " id="workbook_id" name="workbook_id" type="hidden" value="{{ $workbooks->id_pkp}}"/>                                       
        <div class="form-group">
          <label class="col-lg-3 control-label">Formula</label>
          <div class="col-lg-8">
            <input class="form-control " id="formula" name="formula" type="text" required/>
          </div>
        </div>
        <div class="form-group">
        <?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
          <label class="col-lg-3 control-label">Kategori</label>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6">
                <input type="radio" name="kategori" checked oninput="finis_good()" id="id_finis" value="finish good"> Finished Good &nbsp
                <input type="radio" name="kategori" oninput="wip()" id="id_wip"> WIP
              </div>
              <div class="col-md-6" id="ditampilkan">
                <select name="kategori_formula" id="" disabled class="form-control">
                  <option disabled selected>--> Select One <--</option>
                  <option value="granulasi">Granulasi</option>
                  <option value="premix">Premix</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Target Serving</label>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6"><input class="form-control " id="target_serving" name="target_serving" type="number" required/></div>
              <div class="col-md-6">
                <input type="radio" checked name="satuan" oninput="satuan_gram()" id="id_gram" value="Gram"> Gram
                <input type="radio" name="satuan" oninput="satuan_ml()" id="id_ml" value="Ml"> Ml
              </div>
            </div>
          </div>
        </div>
        <div id="tampilkan" class="form-group">
          <label class="col-lg-3 control-label">Berat Jenis</label>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-12"><input class="form-control" placeholder='Berat Jenis' id="" disabled name="" type="number" required/></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Formula Baru -->
<div class="modal fade" id="up" role="dialog" aria-labelledby="hm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="hm">Up Version</h4>
      </div>
      <div class="modal-body">
        <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('tambahformula',$workbooks->id_pkp) }}">
        <input class="form-control " id="workbook_id" name="workbook_id" type="hidden" value="{{ $workbooks->id_pkp}}"/>                                       
        <div class="form-group">
          <label class="col-lg-3 control-label">Sample</label>
          <div class="col-lg-8">
            <input class="form-control " id="formula" name="formula" type="text" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Target Serving</label>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6"><input class="form-control " id="target_serving" name="target_serving" type="number" required/></div>
              <div class="col-md-6">Gram</div>
            </div>
          </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('s')
<script type="text/javascript">
  $('.cari').select2();
  $('#brand').select2();
  $('#subbrand').select2();
  $('#jm').select2();

  $(document).ready(function(){  
    $("#tfl").click(function(e) {
      e.preventDefault();
      $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
      }, 1000);
    });

    // Get Subbrand
    $('#brand').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getSubbrand')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },

          success:function(data){
            $('#subbrand').empty();
            $.each(data, function(key, value){
              $('#subbrand').append('<option value="'+ key +'">' + value + '</option>');
            });                                
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }
      else{
        $('#subbrand').empty();
      }           
    });
  });

  function satuan_ml(){
    var satuan_ml = document.getElementById('id_ml')

    if(satuan_ml.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{

      document.getElementById('tampilkan').innerHTML =
            "<div class='form-group row'>"+
            "  <label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
            "  <div class='col-md-8 col-sm-9 col-xs-12'>"+
            "    <input type='number' placeholder='Berat Jenis' name='berat_jenis' id='berat_jenis' class='form-control col-md-12 col-xs-12' required>"+
            "  </div>"+
            "</div>"
    }
  }

  function satuan_gram(){
    var satuan_gram = document.getElementById('id_gram')

    if(satuan_gram.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{

      document.getElementById('tampilkan').innerHTML =
            "<div class='form-group row'>"+
            "  <label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
            "  <div class='col-md-8 col-sm-9 col-xs-12'>"+
            "    <input type='number' placeholder='Berat Jenis' disabled name='' id='' class='form-control col-md-12 col-xs-12'>"+
            "  </div>"+
            "</div>"
    }
  }

  function finis_good(){
    var finis_good = document.getElementById('id_finis')

    if(finis_good.checked != true){
      document.getElementById('ditampilkan').innerHTML = "";
    }else{

      document.getElementById('ditampilkan').innerHTML =
        "<select name='' disabled id='' class='form-control'>"+
        "  <option disabled selected>--> Select One <--</option>"+
        "  <option value='granulasi'>Granulasi</option>"+
        "  <option value='premix'>Premix</option>"+
        "</select>"
    }
  }

  function wip(){
    var wip = document.getElementById('id_wip')

    if(wip.checked != true){
      document.getElementById('ditampilkan').innerHTML = "";
    }else{

      document.getElementById('ditampilkan').innerHTML =
        "<select name='kategori_formula' id='' class='form-control' required>"+
        "  <option disabled selected>--> Select One <--</option>"+
        "  <option value='granulasi'>Granulasi</option>"+
        "  <option value='premix'>Premix</option>"+
        "</select>"
    }
  }
</script>
@endsection