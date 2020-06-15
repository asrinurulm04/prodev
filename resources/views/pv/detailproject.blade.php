@extends('pv.tempvv')
@section('title', 'Approval Formula')
@section('judulhalaman')
{{$workbooks->nama_project}}
@endsection

@section('halaman')
<ul class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ route('approvalformula') }}"> <i class="fa fa-home"></i> </a></li>
  <li class="breadcrumb-item"><a href="#">Detail Project</a></li>
</ul>
@endsection

@section('content')

<style>
.no-border {
  border: 0;
  box-shadow: none;
  }
</style>

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>  
@endif

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="card-header" align="right">
        <a class="btn btn-out-dashed waves-effect waves-light btn-danger btn-square" href="{{ route('batalkanprojectbypv',$workbooks->id) }}" onclick="return confirm('Batalkan Project ?')"><i class="fa fa-times"></i> Batalkan Project</a>
        <a class="btn btn-out-dashed waves-effect waves-light btn-warning btn-square"  href="{{ route('approvalformula') }}"><i class="fa fa-share"></i>Kembali</a>  
        <div class="clearfix"></div>
        <hr style="border-color: #ddd">     
        <div class="row">
          <div class="col-md-4">        
            <table style="font-size: 14px">
              <tr>
                <td>No.PKP</td><td>&nbsp; : {{ $workbooks->NO_PKP }}</td>              
              </tr>
              <tr>
                <td>Revisi</td><td>&nbsp; : {{ $workbooks->revisi }}</td>
              </tr>
              <tr>
                <td>Brand</td><td>&nbsp; : {{ $workbooks->subbrand->subbrand }}</td>
              </tr>
              <tr>
                <td>Jenis Makanan</td><td>&nbsp; : {{ $workbooks->jenismakanan->jenis_makanan }}</td>
              </tr>
              <tr>
                <td>Target Konsumen</td><td>&nbsp; : {{ $workbooks->tarkon }}</td>
              </tr>            
            </table>
          </div>
          <div class="col-md-4">
            <table style="font-size:14px">
              <tr>
                <td style="width:100px">Target Serving</td><td>:</td><td>{{ $workbooks->target_serving }} Gr</td>
              </tr>
              <tr>
                <td>Requirement</td><td>:</td><td>{{ $workbooks->mnrq }}</td>
              </tr>
              <tr>
                <td>Deskripsi</td><td>:</td><td>{{ $workbooks->deskripsi }}</td>
              </tr>
            </table>
          </div>
          <div class="col-md-3">
            <div class="row" style="margin-right:10px">
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
      <div class="row" style="margin-left:20px;margin-right:20px">
        <div id="exTab2" class="container">	
          <div class="tab-content">
            <div class="tab-pane active" id="1">
              <h4>Formula Yang Diajukan</h4>
              <table class="table table-bordered">
                <thead>
                  <tr style="font-size: 12px;font-weight: bold; color:white;background-color: #6b8ec9;">                                                                  
                    <th width="5%">Versi</th>
                    <th class="text-center">PV</th>
                    <th class="text-center">Feasibility</th>
                    <th class="text-center">Nutfact</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($myformula->groupBy('versi') as $group)
                @foreach ($group->sortBy('turunan') as $formula)
                  <tr>
                    <td>{{ $formula['versi']}}.{{ $formula['turunan']}}</td>                                                    
                    <td class="text-center">
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
                      <td class="text-center">
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
                    <td class="text-center">
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
                    <td class="text-center">
                      @if ($formula['keterangan'] == '')
                      <span class="label label-primary">Tidak Ada Keterangan</span>                        
                      @else
                      {{ $formula['keterangan'] }}
                      @endif
                    </td>
                    <td class="text-center">
                      {{csrf_field()}}
                      <a class="btn waves-effect waves-light btn-info btn-sm" href="{{ route('lihatformulapv',$formula['id']) }}"><i style="font-size:14px;" class="fa fa-eye"></i></a>                                                        
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
  </div>
</div>      

@endsection

@section('s')
<script type="text/javascript">
    
</script>
@endsection

