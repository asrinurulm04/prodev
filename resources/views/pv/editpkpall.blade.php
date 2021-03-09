<!DOCTYPE html>
<html lang="en">

<head>
  <title> PKP Project</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/dataTables.min.css') }}" rel="stylesheet">
</head>
<body class="nav-md">

<!-- top navigation -->

<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <ul class="nav navbar-left">
        <img src="{{ asset('img/logo.png') }}" style="padding-top:10px" width="50%">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="img/prod.png" alt="">{{ Auth::user()->name }}
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

<!-- page content -->
<div class="col-md-12" >
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#!">Edit PKP Project</a>
    </li>
  </ul>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:496px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Edit Project PKP</h3>
    </div>
    
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

    <div class="x_content">
      <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
        <div class="profile_img">
          <div id="crop-avatar">
            <form class="form-horizontal form-label-left" method="POST" action="{{route('update_pkp')}}" novalidate>
              <table class="Table table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th></th>
                    @foreach($par2 as $pr)
                    @if($pr->form1=='ya')<th class="text-center">Project name</th>@endif
                    @if($pr->form2=='ya')<th class="text-center">Brand</th>@endif
                    @if($pr->form3=='ya')<th class="text-center">Type</th>@endif
                    @if($pr->form4=='ya')<th class="text-center">Idea</th>@endif
                    @if($pr->form5=='ya')<th class="text-center">dari umur</th>@endif
                    @if($pr->form5=='ya')<th class="text-center">sampai umur</th>@endif
                    @if($pr->form6=='ya')<th class="text-center">Gender</th>@endif
                    @if($pr->form7=='ya')<th class="text-center">Uniquenes of idea</th>@endif
                    @if($pr->form8=='ya')<th class="text-center">Potential market</th>@endif
                    @if($pr->form9=='ya')<th class="text-center">Reason</th>@endif
                    @if($pr->form10=='ya')<th class="text-center">Aisle placement</th>@endif
                    @if($pr->form11=='ya')<th class="text-center">selling price</th>@endif
                    @if($pr->form12=='ya')<th class="text-center">Consumer price</th>@endif
                    @if($pr->form13=='ya')<th class="text-center">Main Competitor</th>@endif
                    @if($pr->form14=='ya')<th class="text-center">Competitive</th>@endif
                    @if($pr->form15=='ya')<th class="text-center">UOM</th>@endif
                    @if($pr->form16=='ya')<th class="text-center">Product Form</th>@endif
                    @if($pr->form17=='ya')<th class="text-center">AKG</th>@endif
                    @if($pr->form18=='ya')<th class="text-center">prefered flavour</th>@endif 
                    @if($pr->form19=='ya')<th class="text-center">product benefits</th>@endif 
                    @if($pr->form20=='ya')<th class="text-center">mandatory ingredient</th>@endif 
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach($datapkp as $Dpkp)
                  <tr>
                      <input type="hidden" name="scores[{{$loop->index}}][id_pkp]" value="{{$Dpkp->id_pkp}}">
                      <input type="hidden" name="scores[{{$loop->index}}][turun]" value="{{$Dpkp->turunan}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][rev]" value="{{$Dpkp->revisi}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][revisi]" value="{{$Dpkp->revisi+1}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][status]" value="inactive" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][launch]" value="{{$Dpkp->launch}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][years]" value="{{$Dpkp->years}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][tgl]" value="{{$Dpkp->tgl_launch}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][bpom]" value="{{$Dpkp->bpom}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][katbpom]" value="{{$Dpkp->kategori_bpom}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][olahan]" value="{{$Dpkp->olahan}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][primer]" value="{{$Dpkp->primer}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][primary]" value="{{$Dpkp->primery}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][secondary]" value="{{$Dpkp->secondary}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][tertiary]" value="{{$Dpkp->tertiary}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][eksis]" value="{{$Dpkp->kemas_eksis}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][proses]" value="{{$Dpkp->gambaran_proses}}" class="form-control">
                      <input type="hidden" name="scores[{{$loop->index}}][data]" value="sent" class="form-control">
                      <?php $tanggal = Date("Y"); ?>
                      @if($Dpkp->jenis!='Umum')
                        @if($Dpkp->type=='Maklon')
                        <input type="hidden" value="_{{$tanggal}}/PKP{{$Dpkp->jenis}}-M_{{ $Dpkp->project_name }}_{{ $Dpkp->revisi+1 }}.{{ $Dpkp->turunan }}" name="scores[{{$loop->index}}][ket]" id="ket_no">
                        @elseif($Dpkp->type!='Maklon')
                        <input type="hidden" value="_{{$tanggal}}/PKP{{$Dpkp->jenis}}_{{ $Dpkp->project_name }} _{{ $Dpkp->revisi+1 }}.{{ $Dpkp->turunan }}" name="scores[{{$loop->index}}][ket]" id="ket_no">
                        @endif
                      @elseif($Dpkp->jenis=='Umum')
                        @if($Dpkp->type=='Maklon')
                        <input type="hidden" value="_{{$tanggal}}/PKP-M_{{ $Dpkp->project_name }}_{{ $Dpkp->revisi+1 }}.{{ $Dpkp->turunan }}" name="scores[{{$loop->index}}][ket]" id="ket_no">
                        @elseif($Dpkp->type!='Maklon')
                        <input type="hidden" value="_{{$tanggal}}/PKP_{{ $Dpkp->project_name }} _{{ $Dpkp->revisi+1 }}.{{ $Dpkp->turunan }}" name="scores[{{$loop->index}}][ket]" id="ket_no">
                        @endif
                      @endif
                    <td><a href="{{route('deletepkp1',$Dpkp->id_project)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-trash"></li></a></td>
                    @if($Dpkp->form1=='ya')<td><input type="text" readonly name="scores[{{$loop->index}}][name]" class="form-control" value="{{$Dpkp->project_name}}">
                    @elseif($Dpkp->form1=='')<input type="hidden" name="scores[{{$loop->index}}][name]" class="form-control" value="{{$Dpkp->project_name}}"></td> @endif 
                    @if($Dpkp->form2=='ya')<td>
                      <select name="scores[{{$loop->index}}][brand]" class="form-control">
                        <option value="{{$Dpkp->id_brand}}">{{$Dpkp->id_brand}}</option>
                        @foreach($brand as $br)
                        <option value="{{$br->brand}}">{{$br->brand}}</option>
                        @endforeach
                      </select>
                      @elseif($Dpkp->form2=='')<select style="display:none;" name="scores[{{$loop->index}}][brand]" class="form-control">
                        <option value="{{$Dpkp->id_brand}}">{{$Dpkp->id_brand}}</option>
                        @foreach($brand as $br)
                        <option value="{{$br->brand}}">{{$br->brand}}</option>
                        @endforeach
                      </select>
                    </td>@endif 
                    @if($Dpkp->form3=='ya')<td>
                      <select name="scores[{{$loop->index}}][type]" class="form-control">
                        <option value="{{$Dpkp->type}}" readonly>
                          @if($Dpkp->type==1)
                          Maklon
                          @elseif($Dpkp->type==2)
                          Internal
                          @elseif($Dpkp->type==3)
                          Maklon/Internal
                          @endif
                        </option>
                        <option value="1">Maklon</option>
                        <option value="2">Internal</option>
                        <option value="3">Maklon/Internal</option>
                      </select>
                      @elseif($Dpkp->form3=='')<select name="scores[{{$loop->index}}][type]" style="display:none;" class="form-control">
                        <option value="{{$Dpkp->type}}" readonly>
                          @if($Dpkp->type==1)
                          Maklon
                          @elseif($Dpkp->type==2)
                          Internal
                          @elseif($Dpkp->type==3)
                          Maklon/Internal
                          @endif
                        </option>
                        <option value="1">Maklon</option>
                        <option value="2">Internal</option>
                        <option value="3">Maklon/Internal</option>
                      </select>
                    </td>@endif
                    @if($pr->form4=='ya')<td><input type="text" name="scores[{{$loop->index}}][idea]" class="form-control" value="{{$Dpkp->idea}}"></td>
                    @elseif($pr->form4=='')<input type="hidden" name="scores[{{$loop->index}}][idea]" class="form-control" value="{{$Dpkp->idea}}">@endif
                    @if($pr->form5=='ya')<td><input type="number" name="scores[{{$loop->index}}][dariumur]" class="form-control" value="{{$Dpkp->dariumur}}"></td>
                    @elseif($pr->form5=='')<input type="hidden" name="scores[{{$loop->index}}][dariumur]" class="form-control" value="{{$Dpkp->dariumur}}">@endif
                    @if($pr->form5=='ya')<td><input type="text" name="scores[{{$loop->index}}][sampaiumur]" class="form-control" value="{{$Dpkp->sampaiumur}}"></td>
                    @elseif($pr->form5=='')<input type="hidden" name="scores[{{$loop->index}}][sampaiumur]" class="form-control" value="{{$Dpkp->sampaiumur}}">@endif
                    @if($pr->form6=='ya')<td>
                      <select class="form-control" name="scores[{{$loop->index}}][gender]">
                        <option value="{{$Dpkp->gender}}">{{$Dpkp->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Male & Female">Male & Female</option>
                      </select>
                      @elseif($pr->form6=='')<select style="display:none;" class="form-control" name="scores[{{$loop->index}}][gender]">
                        <option value="{{$Dpkp->gender}}">{{$Dpkp->gendera}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Male & Female">Male & Female</option>
                      </select>
                    </td>@endif
                    @if($pr->form7=='ya')<td><input type="text" value="{{$Dpkp->Uniqueness}}" class="form-control" name="scores[{{$loop->index}}][uniq]"></td>
                    @elseif($pr->form7=='')<input type="hidden" value="{{$Dpkp->Uniqueness}}" class="form-control" name="scores[{{$loop->index}}][uniq]">@endif
                    @if($pr->form8=='ya')<td><input type="text" value="{{$Dpkp->Estimated}}" class="form-control" name="scores[{{$loop->index}}][estimated]"></td>
                    @elseif($pr->form8=='')<input type="hidden" value="{{$Dpkp->Estimated}}" class="form-control" name="scores[{{$loop->index}}][estimated]">@endif
                    @if($pr->form9=='ya')<td><input type="text" value="{{$Dpkp->reason}}" class="form-control" name="scores[{{$loop->index}}][reason]"></td>
                    @elseif($pr->form9=='')<input type="hidden" value="{{$Dpkp->reason}}" class="form-control" name="scores[{{$loop->index}}][reason]">@endif
                    @if($pr->form10=='ya')<td><input type="text" value="{{$Dpkp->aisle}}" class="form-control" name="scores[{{$loop->index}}][aisle]"></td>
                    @elseif($pr->form10=='')<input type="hidden" value="{{$Dpkp->aisle}}" class="form-control" name="scores[{{$loop->index}}][aisle]">@endif
                    @if($pr->form11=='ya')<td><input type="number" value="{{$Dpkp->price}}" class="form-control" name="scores[{{$loop->index}}][price]"></td>
                    @elseif($pr->form11=='')<input type="hidden" value="{{$Dpkp->price}}" class="form-control" name="scores[{{$loop->index}}][price]">@endif
                    @if($pr->form12=='ya')<td><input type="number" value="{{$Dpkp->selling_price}}" class="form-control" name="scores[{{$loop->index}}][selling]"></td>
                    @elseif($pr->form12=='')<input type="hidden" value="{{$Dpkp->selling_price}}" class="form-control" name="scores[{{$loop->index}}][selling]"> @endif
                    @if($pr->form13=='ya')<td><input type="text" value="{{$Dpkp->competitor}}" class="form-control" name="scores[{{$loop->index}}][competitor]"></td>
                    @elseif($pr->form13=='')<input type="hidden" value="{{$Dpkp->competitor}}" class="form-control" name="scores[{{$loop->index}}][competitor]">@endif
                    @if($pr->form14=='ya')<td><input type="text" value="{{$Dpkp->competitive}}" class="form-control" name="scores[{{$loop->index}}][competitive]"></td>
                    @elseif($pr->form14=='')<input type="hidden" value="{{$Dpkp->competitive}}" class="form-control" name="scores[{{$loop->index}}][competitive]">@endif
                    @if($pr->form15=='ya')<td><input type="text" value="{{$Dpkp->UOM}}" class="form-control" name="scores[{{$loop->index}}][uom]">
                    @elseif($pr->form15=='')<input type="hidden" value="{{$Dpkp->UOM}}" class="form-control" name="scores[{{$loop->index}}][uom]"></td>@endif
                    @if($pr->form16=='ya')<td><input type="text" value="{{$Dpkp->product_form}}" class="form-control" name="scores[{{$loop->index}}][form]"></td>
                    @elseif($pr->form16=='')<input type="hidden" value="{{$Dpkp->product_form}}" class="form-control" name="scores[{{$loop->index}}][form]">@endif
                    @if($pr->form17=='ya')<td>
                      <select class="form-control" name="scores[{{$loop->index}}][tarkon]">
                        <option value="{{$Dpkp->datatarkon->id_tarkon}}">{{$Dpkp->datatarkon->tarkon}}</option>
                        @foreach($tarkon as $Dtarkon)
                        <option value="{{$Dtarkon->id_tarkon}}">{{$Dtarkon->tarkon}}</option>
                        @endforeach
                      </select>
                      @elseif($pr->form17=='')<select style="display:none;" class="form-control" name="scores[{{$loop->index}}][tarkon]">
                        <option value="{{$Dpkp->datatarkon->id_tarkon}}">{{$Dpkp->datatarkon->tarkon}}</option>
                        @foreach($tarkon as $Dtarkon)
                        <option value="{{$Dtarkon->id_tarkon}}">{{$Dtarkon->tarkon}}</option>
                        @endforeach
                      </select>
                    </td>@endif 
                    @if($pr->form18=='ya')<td><input type="text" value="{{$Dpkp->prefered_flavour}}" class="form-control" name="scores[{{$loop->index}}][prefered]"></td>
                    @elseif($pr->form18=='')<input type="hidden" value="{{$Dpkp->prefered_flavour}}" class="form-control" name="scores[{{$loop->index}}][prefered]">@endif
                    @if($pr->form19=='ya')<td><input type="text" value="{{$Dpkp->product_benefits}}" class="form-control" name="scores[{{$loop->index}}][benefits]"></td>
                    @elseif($pr->form19=='')<input type="hidden" value="{{$Dpkp->product_benefits}}" class="form-control" name="scores[{{$loop->index}}][benefits]">@endif
                    @if($pr->form20=='ya')<td><input type="text" value="{{$Dpkp->mandatory_ingredient}}" class="form-control" name="scores[{{$loop->index}}][ingredient]"></td>
                    @elseif($pr->form20=='')<input type="hidden" value="{{$Dpkp->mandatory_ingredient}}" class="form-control" name="scores[{{$loop->index}}][ingredient]">@endif
                    <textarea name="scores[{{$loop->index}}][note]" value="" style="display:none;" id="" cols="30" rows="10"></textarea>  
                  </tr>
                    @endforeach
                </tbody>
              </table>
              <button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit</button>
              {{ csrf_field() }}
              <a href="{{route('hapuscheck')}}" class="btn btn-danger btn-sm"><li class="fa fa-ban"></li> Cencel</a>
            </form>
          </div>
        </div>
        <h3 class="text-center"></h3>
        <h6 class="text-center"></h6>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel text-right">
    Created By Asrul :)
  </div>
  <div class="clearfix"></div>
</div>

  <!-- jQuery -->
  <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('js/datatables.min.js')}}"></script>
  <script src="{{ asset('build/js/custom.min.js') }}"></script>
  @yield('s')
  <script 
    type="text/javascript">$('.Table').DataTable({
      "language": {
      "search": "Cari :",
      "lengthMenu": "Tampilkan _MENU_ data",
      "zeroRecords": "Tidak ada data",
      "emptyTable": "Tidak ada data",
      "info": "Menampilkan data _START_  - _END_  dari _TOTAL_ data",
      "infoEmpty": "Tidak ada data",
      "paginate": {
      "first": "Awal",
      "last": "Akhir",
      "next": ">",
      "previous": "<"
      }
    }
    });
  </script>
</body>
</html>