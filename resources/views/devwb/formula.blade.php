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
        <h4 style="color:#0c8ce0"><i class="fa fa-caret-right"></i> {{$workbooks->project_name}}</h4>      
      </div>
      <div class="col-md-7" align="right">
        @if($cf == 0)
        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FB"><i class="fa fa-plus"></i> Formula Baru</a>
        @elseif($cf>0)
        <a class="btn btn-info btn-sm" onclick="return confirm('Naik Versi Formula ?')" href="{{ route('upversion',['cf'=>$cf,'id'=>$workbooks->id]) }}"><i class="fa fa-plus"></i> Naik Versi</a>
        @endif
        @if($workbooks->status == '')
        <a class="btn btn-warning btn-sm" href="{{ route('workbook.selesai',$workbooks->id) }}" onclick="return confirm('Selesaikan Project ?')"><i class="fa fa-check"></i> SELESAI</a>
        <a class="btn btn-dark btn-sm" href="{{ route('workbook.batal',$workbooks->id) }}" onclick="return confirm('Batalkan Project ?')"><i class="fa fa-times"></i> BATAL</a>
        @endif
        <a class="btn btn-danger btn-sm" href="{{ route('lihatpkp',['id'=>$workbooks->id_pkp,'revisi' => $workbooks->revisi,'turunan'=>$workbooks->turunan]) }}"><i class="fa fa-share"></i>Kembali</a>
      </div>
    </div>
    <hr style="border-color: #ddd">     
    <div class="row">
      <div class="col-md-4">        
        <table style="font-size: 14px">
          <tr>
            <td>No.PKP</td><td>&nbsp; : {{ $workbooks->pkp_number }}{{ $workbooks->ket_no }}</td>              
          </tr>
          <tr>
            <td>Brand</td><td>&nbsp; : {{ $workbooks->id_brand }}</td>
          </tr>
          <tr>
            <td>Target Konsumen</td><td>&nbsp; : {{ $workbooks->tarkon->tarkon }}</td>
          </tr>            
        </table>
      </div>
      <div class="col-md-5">
        <table style="font-size:14px">
          <tr>
            <td style="width:100px">Note Serving</td><td>:</td><td>{{ $workbooks->serving_suggestion }}</td>
          </tr>
          <tr>
            <td>Idea</td><td>:</td><td>{{ $workbooks->idea }}</td>
          </tr>
          <tr>
            <td>Created</td><td>:</td><td>{{ $workbooks->created_date }}</td>
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
    <div id="exTab2" class="container">	
      <ul class="nav nav-tabs  tabs" role="tablist">
        <li class="nav-item">
          <a  href="#1" class="nav-link active" data-toggle="tab"><i class="fa fa-list"></i> List Formula</a>
        </li>
        <li class="nav-item">
          <a href="#2" class="nav-link" data-toggle="tab"><i class="fa fa-star-half-o"></i> Pengajuan PV</a>
        </li>
      </ul><br>
      <div class="tab-content ">
        {{-- List Formula --}}
        <div class="tab-pane active" id="1">
          <table class="table" style="font-size:14px" id="Table">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">                                         
                <th class="text-center">Versi</th>
                <th>Status</th>
                <th>PV</th>
                <th>Feasibility</th>
                <th>Nutfact</th>
                <th>Keterangan</th>
                <th class="text-center">Action</th>
                <th class="text-center">Pengajuan</th>
              </tr>
            </thead>                      
            <tbody>
              @foreach ($myformula->groupBy('versi') as $group)
              @foreach ($group->sortBy('turunan') as $formula)                                                                            
              <tr>                         
                <td class="text-center  ">{{ $formula['versi']}}.{{ $formula['turunan']}}</td>
                <td>
                  @if ($formula['status'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['status'] == 'selesai')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['status'] == 'draft')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif 
                </td>
                <td>
                  @if ($formula['vv'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['vv'] == 'tidak')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['vv'] == 'ok')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['vv'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif   
                </td>
                <td>
                  @if ($formula['finance'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['finance'] == 'not_approved')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['finance'] == 'approved')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['finance'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif  
                </td>
                <td>
                  @if ($formula['nutfact'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['nutfact'] == 'not_approved')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['nutfact'] == 'approved')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['nutfact'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif  
                </td>
                <td>
                  @if ($formula['keterangan'] == '')
                  <span class="label label-primary">Tidak Ada Keterangan</span>                        
                  @else
                  {{ $formula['keterangan'] }}
                  @endif
                </td>
                <td class="text-center">
                  {{csrf_field()}}
                  <a class="btn btn-primary btn-sm" href="{{ route('formula.detail',$formula['workbook_id']) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                  <a class="btn btn-success btn-sm" href="{{ route('upversion2',$formula['workbook_id']) }}" onclick="return confirm('Naik Versi ?')" data-toggle="tooltip" title="Naik Versi"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i></a>
                  @if($formula['status']!='proses')
                  <a class="btn btn-info btn-sm" href="{{ route('step2',$formula['workbook_id']) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Eidt"></i></a>
                  <a class="btn btn-danger btn-sm" href="{{ route('deleteFormula',$formula['workbook_id']) }}"><i style="font-size:12px;" class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a>
                  @endif
                </td>
                <td class="text-center">
                  @if ($formula['status'] != 'proses')
                  <a class="btn btn-theme02 btn-sm" href="{{ route('ajukanvp',$formula['id']) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV">PV</a>
                  @endif
                  @if ($formula['vv'] == 'ok')
                  <label>data sudah di ajukan</label>
                  @endif
                </td>
              </tr>
              @endforeach
              @endforeach
            </tbody> 
          </table>     
        </div>
        {{-- Pengajuan Pv --}}
        <div class="tab-pane" id="2">
          <table class="table table-bordered" style="font-size:12px">
            <thead style="font-weight: bold;color:white;background-color: #2a3f54;">
              <tr>                                                                                                          
                <th>Status</th>
                <th>Versi</th>  
                <th>PV</th>
                <th>Feasibility</th>
                <th>Nutfact</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($vpf as $formula)
              <tr>
                <td>{{ $formula['status']}}</td>
                <td>{{ $formula['versi']}}.{{ $formula['turunan']}}</td>
                <td>
                  @if ($formula['vv'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['vv'] == 'tidak')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['vv'] == 'ok')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['vv'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif   
                </td>
                <td>
                  @if ($formula['finance'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['finance'] == 'not_approved')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['finance'] == 'approved')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['finance'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif  
                </td>
                <td>
                  @if ($formula['nutfact'] == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($formula['nutfact'] == 'not_approved')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($formula['nutfact'] == 'approved')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($formula['nutfact'] == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif  
                </td>
                <td>
                  @if ($formula['keterangan'] == '')
                    <span class="label label-primary">Tidak Ada Keterangan</span>                        
                  @else
                    {{ $formula['keterangan'] }}
                  @endif
                </td>
                <td>
                  {{csrf_field()}}
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',$formula['id']) }}"><i style="font-size:14px;" class="fa fa-eye"></i></a>                                            
                  @if($formula['status']!='proses')                                                
                  <a class="btn btn-danger btn-sm" href="{{ route('deleteFormula',$formula['id']) }}"><i style="font-size:14px;" class="fa fa-trash"></i></a>
                  @endif
                </td>
              </tr>
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
        <h4 class="modal-title" id="hm"> Formula Baru</h4>
      </div>
      <div class="modal-body">
        <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('addformula') }}">
        <input class="form-control " id="workbook_id" name="workbook_id" type="hidden" value="{{ $workbooks->id}}"/>                                       
        <div class="form-group">
          <label class="col-lg-3 control-label">Kode Formula</label>
          <div class="col-lg-8">
            <input class="form-control " id="kode_formula" name="kode_formula" type="text" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Target Serving</label>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6"><input class="form-control " id="target_serving" name="target_serving" type="text" required/></div>
              <div class="col-md-6">Gr</div>
            </div>
          </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-plus"></i> Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Chat --}}
<div class="modal fade" id="myModalChat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope-o"></i> Pesan Baru</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
        {{-- Hidden Input --}}
        <input type="hidden" name="workbook_id" value="{{ $workbooks->id }}">
        <input type="hidden" name="jenis" value="dev">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        {{-- Start--}}
        <div class="row">
          <div class="col-md-6">
            <label class="label label-primary">Kirim Ke :</label><br>                      
            <select name="jenis2" class="form-control">
              <option value="pv">PV(Manager)</option>
              <option value="finance">Tim Finance</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="label label-info">Formula :</label><br>                      
            <select name=formula_id class="form-control">
              <option value="no">Pilih Formula</option>
              @foreach ($vpf->groupBy('versi') as $group)
              @foreach ($group->sortBy('turunan') as $formula)
              <option value="{{ $formula['id'] }}">Versi {{ $formula['versi'] }}.{{ $formula['turunan'] }}</option>
              @endforeach    
              @endforeach
            </select>
          </div>
        </div>
        <div style="margin-top: 15px;height:300px">
          <textarea class="form-control edit" style="min-width: 100%;min-height: 100%" name="pesan"></textarea>                
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- end Modal Chat --}}


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
</script>
@endsection