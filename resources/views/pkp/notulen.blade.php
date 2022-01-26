<!DOCTYPE html>
<html lang="en">

<head>
  <title> PKP Project</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="nav-md">

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <ul class="nav navbar-left">
        <img src="{{ asset('img/logo.png') }}" style="padding-top:20px" width="50%">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/prod.png') }}" alt="">{{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ route('MyProfile') }}"> Profile</a></li>
            <li><a href="{{ route('signout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<!-- page content -->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:618px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Create Notulen Project PKP</h3>
    </div>
    <div class="x_content">
      <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
        <div class="profile_img">
          <div id="crop-avatar">
            <form class="form-horizontal form-label-left" method="POST" action="{{route('notulenpkpp')}}" novalidate>
            <?php $last = Date('Y'); ?>
            <div class="form-group row">
              <div class="col-md-1 col-sm-1 col-xs-6">
                <label for="">Tanggal Meeting</label>
              </div>
              <div class="col-md-5 col-sm-5 col-xs-6">
                : <label for=""><input type="text" class="form-control" readonly name="date" value="{{ $tgl }}-{{ $bln }}-{{ $last }}"></label>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-1 col-sm-1 col-xs-6">
                <label for="">Konfirmasi</label>
              </div>
              <div class="col-md-5 col-sm-5 col-xs-6">
                : <label for="">
                @if($info=='1')PV & RD
                @elseif($info=='2')PV & Marketing
                @endif
                </label>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label text-left col-md-1 col-sm-1 col-xs-12">Info Meeting &nbsp &nbsp &nbsp &nbsp  </label>
              <div class="col-md-5 col-sm-5 col-xs-6">
                <input id="catatan" class="form-control col-md-12 col-xs-12" velue="-" maxlength="100" placeholder="max 100 character" name="catatan" required="required" type="text">
              </div>
            </div>
			      <div class="" style="overflow-x: scroll;">
              <table  id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th class="text-center">Action</th>
                    <th class="text-center" style="min-width:150px">Project name</th>
                    <th class="text-center" style="min-width:70px">Brand</th>
                    <th class="text-center" style="min-width:200px">Idea</th>
                    <th class="text-center" style="min-width:180px">Project Priority</th>
                    <th class="text-center" style="min-width:220px">Launch Deadline</th>
                    <th class="text-center" style="min-width:230px">Forecast</th>
                    <th class="text-center" style="min-width:230px">Note</th>
                    <th class="text-center" style="min-width:230px"><input type="text" id="note1" readonly class="hilang text-center" style="min-width:200px">
                  </tr>
                </thead>
                <tbody class="sortable-list">
                  @foreach($datapkp as $Dpkp)
                  <tr >
                    <input type="hidden" name="note[{{$loop->index}}][pkp]" value="{{$Dpkp->id_project}}"> <?php $date = Date('Y'); ?>
                    <input type="hidden" disabled name="scores[{{$loop->index}}][type]" class="form-control" value="{{$Dpkp->type}}">
                    <td>
                      @if($Dpkp->status_freeze=='inactive')
                      <button title="freeze" type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $Dpkp->id_project  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
                      @elseif($Dpkp->status_freeze=='active')
                      <button title="unfreeze" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $Dpkp->id_project }}" data-toggle="tooltip" ><i class="fa fa-dropbox"></i></a></button>
                      @endif
                    </td>
                    <td>{{$Dpkp->project_name}}</td>
                    <td class="text-center">{{$Dpkp->id_brand}}</td>
                    <td>{{$Dpkp->idea}}</td>
                    <td>
                      <table class="table" id="persondatatable">
                        <form action="" method="POST">
                        <td >
                          <input type='number' name="scores[{{$loop->index}}][prioritas]" style="max-width:80px" value='{{$Dpkp->prioritas}}' class="form-control" id='name_{{$Dpkp->id_project}}'>
                        </td>
                          <td align='center'><input type='button' value='Edit' class='update' data-id='{{$Dpkp->id_project}}' >
                        </form>
                      </table>
                    </td>
                    <td>
                      <table>
                        <tr>
                          <td>
                            <select class="form-control" name="note[{{$loop->index}}][launch]">
                              @if($Dpkp->launch!=NULL)
                                <option value="{{$Dpkp->launch}}" selected>{{$Dpkp->launch}}</option>
                              @endif
                              <?php
                                $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $jlh_bln=count($bulan);
                                for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$bulan[$c]> $bulan[$c] </option>"; }
                              ?>
                            </select>
                          </td>
                          <td>
                            <input type='hidden' name="note[{{$loop->index}}][prio]" value='{{$Dpkp->prioritas}}'>
                            <input style="max-width:90px" maxlength="4" minlength="4" type="number" name="note[{{$loop->index}}][years]" class="form-control" placeholder="Years" id="tahun" value="{{$Dpkp->years}}">
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td>
                      @foreach($for as $forcast)
                        @if($forcast->id_project==$Dpkp->id_project && $forcast->id_pkp==$Dpkp->id_pkp && $forcast->revisi==$Dpkp->revisi && $forcast->turunan==$Dpkp->turunan && $forcast->revisi_kemas==$Dpkp->revisi_kemas)
                        <table class=""> 
                          <tr>
                            <input type="hidden" name="for[{{$loop->index}}][id]" value="{{$Dpkp->id_project}}">
                            <input type="hidden" name="for[{{$loop->index}}][up]" value="{{$date}}">
                            <input type="hidden" name="for[{{$loop->index}}][pr]" value="{{$forcast->id}}">
                            <td><input style="max-width:125px" type="number" name="for[{{$loop->index}}][for]" class="form-control text-right" value="{{$forcast->forecast}}"></td>
                            <td><input style="max-width:90px" type="text" name="for[{{$loop->index}}][satuan]" class="form-control" value="{{$forcast->satuan}}"></td>
                          </tr>
                        </table>
                        @endif
                      @endforeach
                    </td>
                    <?php $M =  date('F', strtotime(date('j-F-Y') . '- 1 month')); ?>
                    <?php $d =  date('j-F-Y'); ?>
                    <?php $T =  date('Y'); ?>
                    <input type="hidden" value="{{$M}}">
                    <input type="hidden" name="bulan" id="bulan" value="{{$bln}}">
                    <input type="hidden" name="tahun" id="tahun" value="{{$T}}">
                    <input type="hidden" name="info" id="info" value="{{$info}}">
                    <td><textarea cols="30" name="note[{{$loop->index}}][note]" class="col-md-12 col-sm-12 col-xs-12" rows="4">
                      @foreach($notulen as $not)
                        @if($not->id_pkp==$Dpkp->id_project)
                          @if($not->note_pv_marketing!=NULL && $not->Bulan==$bln && $info==2) {{$not->note_pv_marketing}}
                          @elseif($not->note_rd_pv!=NULL && $not->Bulan==$bln && $info==1) {{$not->note_rd_pv}}
                          @endif
                        @endif
                      @endforeach
                    </textarea></td>
                    <!-- info note Sebelumnya -->
                    <td>
                      @foreach($notulen as $not)
                        @if($not->id_pkp==$Dpkp->id_project)
                          @if($not->note_pv_marketing!=NULL && $not->Bulan==$bln && $info==1)
                          <textarea cols="30"disabled value="{{$not->note_pv_marketing}}" class="col-md-12 col-sm-12 col-xs-12" rows="4"> {{$not->note_pv_marketing}}</textarea>
                          <input type="hidden" id="awal" value="PV & Marketing = {{$not->created}}">
                          @elseif($not->note_rd_pv!=NULL && $not->Bulan==$bln && $info==2)
                          <textarea cols="30"disabled value="{{$not->note_rd_pv}}" class="col-md-12 col-sm-12 col-xs-12" rows="4"> {{$not->note_rd_pv}}</textarea>
                          <input type="hidden" id="awal" value="PV & RD = {{$not->created}}">
                          @endif
                        @endif
                      @endforeach
                    </td>
                    <!-- Selesai -->
                  </tr>
                  
                      <!-- Modal -->
                      <div class="modal" id="freezedata{{ $Dpkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title text-center" id="exampleModalLabel" > {{$Dpkp->project_name}} 
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{route('freeze',$Dpkp->id_project)}}">
                              <div class="row x_panel">
                                <label for="" style="color:red;">Note *required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure you deactivated this project ?')"><i class="fa fa-cubes"></i> Freeze</button>
                                {{ csrf_field() }}
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Selesai -->
                      <!-- Modal unfreeze-->
                      <div class="modal" id="freeze{{ $Dpkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">Note Freeze = {{$Dpkp->project_name}}
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{ Route('activepkp',$Dpkp->id_project)}}" novalidate>
                              <div class="row x_panel"><textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$Dpkp->note_freeze}}</textarea>
                                <label class="text-center">Timeline sending sample : {{$Dpkp->jangka}} To {{$Dpkp->waktu}}
                                <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                                <input type="hidden" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date">
                                <input type="hidden" class="form-control" value="{{$tgl2}}" name="waktu" id="waktu" placeholder="end date">
                                <input type="hidden" value="{{$Dpkp->id_project}}" name="pkp" id="pkp">
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"> Active</li></button>
                                {{ csrf_field() }}
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Selesai -->
                  @endforeach
                </tbody>
              </table>
            </div><br>
            <button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- jQuery -->
  <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('build/js/custom.min.js') }}"></script>
  <script src="{{ asset('js/datatables.min.js')}}"></script>
  <script>
    var satu = document.getElementById('awal').value;
    document.getElementById('note1').value = satu;
  </script>
  <script type='text/javascript'>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // Update record
    $(document).on("click", ".update" , function() {
      var edit_id = $(this).data('id');
      var name = $('#name_'+edit_id).val();
      if(name != ''){
        $.ajax({
          headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
          },
          url: window.location.origin + '/updateUser',
          type: 'post',
          data: {_token: CSRF_TOKEN,editid: edit_id,name: name},
          success: function(data){
            alert(data);
            table.ajax.reload();
          }
        });
      }else{
        alert('gagal');
      }
    });
  </script>
</body>
</html>