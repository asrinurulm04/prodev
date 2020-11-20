<!DOCTYPE html>
<html lang="en">

<head>
  <title> PDF Project</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> 
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
    <li class="breadcrumb-item" style="padding-left:1000px">
      <a href="{{route('lala')}}"> <i class="fa fa-home"></i> Dasboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('tabulasi')}}"> <i class="fa fa-folder"></i> Project All</a>
    </li>
    <li class="breadcrumb-item"><a href="#!">PDF Project</a>
    </li>
  </ul>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:466px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Create Notulen Project PDF</h3>
    </div>
    <div class="x_content">   
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
      <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
        <div class="profile_img">
          <div id="crop-avatar">
					  <form class="form-horizontal form-label-left" method="POST" action="{{route('notulenpdff')}}" novalidate>
              <table class="Table table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    @foreach($par as $pr)
                    @if($pr->form1=='ya')<td class="text-center">Project Name</td>@endif
                    @if($pr->form2=='ya')<th class="text-center">Brand</th>@endif
                    @if($pr->form3=='ya')<th class="text-center">Type</th>@endif
                    @if($pr->form4=='ya')<th class="text-center">country</th>@endif
                    @if($pr->form5=='ya')<th class="text-center">reference</th>@endif
                    @if($pr->form6=='ya')<th class="text-center">dari umur</th>@endif
                    @if($pr->form6=='ya')<th class="text-center">Sampai usia</th>@endif
                    @if($pr->form7=='ya')<th class="text-center">Gender</th>@endif
                    @if($pr->form8=='ya')<th class="text-center">Other</th>@endif
                    @if($pr->form9=='ya')<th class="text-center">Background / Insight</th>@endif
                    @if($pr->form10=='ya')<th class="text-center">Attracttiveness</th>@endif
                    @if($pr->form11=='ya')<th class="text-center">Target RTO</th>@endif
                    @if($pr->form12=='ya')<th class="text-center">Name Competitor</th>@endif
                    @if($pr->form13=='ya')<th class="text-center">Retailer price</th>@endif
                    @if($pr->form14=='ya')<th class="text-center">Wight</th>@endif
                    @if($pr->form15=='ya')<td class="text-center">Serving</td>@endif
                    @if($pr->form16=='ya')<th class="text-center">Target NFI</th>@endif
                    @if($pr->form17=='ya')<th class="text-center">claim</th>@endif
                    @if($pr->form18=='ya')<th class="text-center">Inggredients</th>@endif 
                    @if($pr->form19=='ya')<th class="text-center">What's Special</th>@endif 
                    <th class="text-center">Note</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach($datapdf as $Dpdf)
                  <tr>
                    <input type="hidden" name="datapdf[{{$loop->index}}][id_pdf]" value="{{$Dpdf->pdf_id}}">
                    <input type="hidden" name="datapdf[{{$loop->index}}][rev]" value="{{$Dpdf->revisi+1}}">
                    <input type="hidden" name="datapdf[{{$loop->index}}][revisi]" value="{{$Dpdf->revisi}}">
                    <input type="hidden" name="datapdf[{{$loop->index}}][turun]" value="{{$Dpdf->turunan}}">
                    <input type="hidden" name="datapdf[{{$loop->index}}][status]" value="inactive" class="form-control">
                    <input type="hidden" name="datapdf[{{$loop->index}}][primer]" value="{{$Dpdf->primer}}" class="form-control">
                    <input type="hidden" name="datapdf[{{$loop->index}}][primary]" value="{{$Dpdf->primery}}" class="form-control">
                    <input type="hidden" name="datapdf[{{$loop->index}}][secondary]" value="{{$Dpdf->secondery}}" class="form-control">
                    <input type="hidden" name="datapdf[{{$loop->index}}][tertiary]" value="{{$Dpdf->Tertiary}}" class="form-control">
                    <input type="hidden" name="datapdf[{{$loop->index}}][eksis]" value="{{$Dpdf->kemas_eksis}}" class="form-control">
                    <?php $tanggal = Date("Y"); ?>
                    <input type="hidden" value="_{{$tanggal}}/{{$Dpdf->product_type}}_{{ $Dpdf->project_name }}_{{ $Dpdf->revisi+1 }}.{{ $Dpdf->turunan }}" name="datapdf[{{$loop->index}}][ket]" id="ket_no">
                    @if($Dpdf->form1=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][name]" class="form-control" value="{{$Dpdf->project_name}}"></td>
                    @elseif($Dpdf->form1=='')<input type="hidden" name="datapdf[{{$loop->index}}][name]" class="form-control" value="{{$Dpdf->project_name}}">@endif
                    @if($Dpdf->form2=='ya')<td>
                      <select name="datapdf[{{$loop->index}}][brand]" class="form-control">
                        <option value="{{$Dpdf->id_brand}}">{{$Dpdf->id_brand}}</option>
                        @foreach($brand as $br)
                        <option value="{{$br->brand}}">{{$br->brand}}</option>
                        @endforeach
                      </select>
                      @elseif($Dpdf->form2=='')<select style="display:none;" name="datapdf[{{$loop->index}}][brand]" class="form-control">
                        <option value="{{$Dpdf->id_brand}}">{{$Dpdf->id_brand}}</option>
                        @foreach($brand as $br)
                        <option value="{{$br->brand}}">{{$br->brand}}</option>
                        @endforeach
                      </select>
                    </td>@endif 
                    @if($Dpdf->form3=='ya')<td>
                      <select name="datapdf[{{$loop->index}}][type]" class="form-control">
                        <option value="{{$Dpdf->type->id}}">{{$Dpdf->type->type}}</option>
                        @foreach ($type as $typ)
                        <option value="{{$typ->id}}">{{$typ->type}}</option>
                        @endforeach
                      </select>
                      @elseif($Dpdf->form3=='')<select style="display:none;" name="datapdf[{{$loop->index}}][type]" class="form-control">
                        <option value="{{$Dpdf->type->id}}">{{$Dpdf->type->type}}</option>
                        @foreach ($type as $typ)
                        <option value="{{$typ->id}}">{{$typ->type}}</option>
                        @endforeach
                      </select>
                    </td>@endif 
                    @if($Dpdf->form4=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][country]" class="form-control" value="{{$Dpdf->country}}"></td>
                    @elseif($Dpdf->form4=='')<input type="hidden" name="datapdf[{{$loop->index}}][country]" class="form-control" value="{{$Dpdf->country}}">@endif
                    @if($Dpdf->form5=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][reference]" class="form-control" value="{{$Dpdf->reference}}"></td>
                    @elseif($Dpdf->form5=='')<input type="hidden" name="datapdf[{{$loop->index}}][reference]" class="form-control" value="{{$Dpdf->reference}}">@endif
                    @if($Dpdf->form6=='ya')<td><input type="number" name="datapdf[{{$loop->index}}][dariusia]" class="form-control" value="{{$Dpdf->dariusia}}"></td>
                    @elseif($Dpdf->form6=='')<input type="hidden" name="datapdf[{{$loop->index}}][dariusia]" class="form-control" value="{{$Dpdf->dariusia}}">@endif
                    @if($Dpdf->form6=='ya')<td><input type="number" name="datapdf[{{$loop->index}}][sampaiusia]" class="form-control" value="{{$Dpdf->sampaiusia}}"></td>
                    @elseif($Dpdf->form6=='')<input type="hidden" name="datapdf[{{$loop->index}}][sampaiusia]" class="form-control" value="{{$Dpdf->sampaiusia}}">@endif
										@if($Dpdf->form7=='ya')<td>
											<select class="form-control" name="datapdf[{{$loop->index}}][gender]">
                        <option value="{{$Dpdf->gender}}">{{$Dpdf->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Male & Female">Male & Female</option>
                      </select>
                      @elseif($Dpdf->form7=='')<select style="display:none;" class="form-control" name="datapdf[{{$loop->index}}][gender]">
                        <option value="{{$Dpdf->gender}}">{{$Dpdf->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Male & Female">Male & Female</option>
                      </select>
										</td>@endif
                    @if($Dpdf->form8=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][other]" class="form-control" value="{{$Dpdf->other}}"></td>
                    @elseif($Dpdf->form8=='')<input type="hidden" name="datapdf[{{$loop->index}}][other]" class="form-control" value="{{$Dpdf->other}}">@endif
                    @if($Dpdf->form9=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][background]" class="form-control" value="{{$Dpdf->background}}"></td>
                    @elseif($Dpdf->form9=='')<input type="hidden" name="datapdf[{{$loop->index}}][background]" class="form-control" value="{{$Dpdf->background}}">@endif
                    @if($Dpdf->form10=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][attractive]" class="form-control" value="{{$Dpdf->attractiveness}}"></td>
                    @elseif($Dpdf->form10=='')<input type="hidden" name="datapdf[{{$loop->index}}][attractive]" class="form-control" value="{{$Dpdf->attractiveness}}">@endif
                    @if($Dpdf->form11=='ya')<td><input type="date" name="datapdf[{{$loop->index}}][rto]" class="form-control" value="{{$Dpdf->rto}}"></td>
                    @elseif($Dpdf->form11=='')<input type="hidden" name="datapdf[{{$loop->index}}][rto]" class="form-control" value="{{$Dpdf->rto}}">@endif
                    @if($Dpdf->form12=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][name2]" class="form-control" value="{{$Dpdf->name}}"></td>
                    @elseif($Dpdf->form12=='')<input type="hidden" name="datapdf[{{$loop->index}}][name2]" class="form-control" value="{{$Dpdf->name}}">@endif
                    @if($Dpdf->form13=='ya')<td><input type="number" name="datapdf[{{$loop->index}}][retailer]" class="form-control" value="{{$Dpdf->retailer_price}}"></td>
                    @elseif($Dpdf->form13=='')<input type="hidden" name="datapdf[{{$loop->index}}][retailer]" class="form-control" value="{{$Dpdf->retailer_price}}">@endif
                    @if($Dpdf->form14=='ya')<td><input type="number" name="datapdf[{{$loop->index}}][wight]" class="form-control" value="{{$Dpdf->wight}}"></td>
                    @elseif($Dpdf->form14=='')<input type="hidden" name="datapdf[{{$loop->index}}][wight]" class="form-control" value="{{$Dpdf->wight}}">@endif
                    @if($Dpdf->form15=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][serving]" class="form-control" value="{{$Dpdf->serving}}"></td>
                    @elseif($Dpdf->form15=='')<input type="hidden" name="datapdf[{{$loop->index}}][serving]" class="form-control" value="{{$Dpdf->serving}}">@endif
                    @if($Dpdf->form16=='ya')<td><input type="number" name="datapdf[{{$loop->index}}][target]" class="form-control" value="{{$Dpdf->target_price}}"></td>
                    @elseif($Dpdf->form16=='')<input type="hidden" name="datapdf[{{$loop->index}}][target]" class="form-control" value="{{$Dpdf->target_price}}">@endif
                    @if($Dpdf->form17=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][claim]" class="form-control" value="{{$Dpdf->claim}}"></td>
                    @elseif($Dpdf->form17=='')<input type="hidden" name="datapdf[{{$loop->index}}][claim]" class="form-control" value="{{$Dpdf->claim}}">@endif
                    @if($Dpdf->form18=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][ingredient]" class="form-control" value="{{$Dpdf->ingredient}}"></td>
                    @elseif($Dpdf->form18=='')<input type="hidden" name="datapdf[{{$loop->index}}][ingredient]" class="form-control" value="{{$Dpdf->ingredient}}">@endif
                    @if($Dpdf->form19=='ya')<td><input type="text" name="datapdf[{{$loop->index}}][special]" class="form-control" value="{{$Dpdf->special}}"></td>
                    @elseif($Dpdf->form19=='')<input type="hidden" name="datapdf[{{$loop->index}}][special]" class="form-control" value="{{$Dpdf->special}}">@endif
                    <td><textarea name="note[{{$loop->index}}][note]" value="{{$Dpdf->pdf_id}}" id="" cols="30" rows="3"></textarea>  </td>
                    <input type="hidden" value="{{$Dpdf->pdf_id}}" name="note[{{$loop->index}}][pdf]">
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @foreach($datapdf as $Dpdf)
                <input type="hidden" name="datapdf1[{{$loop->index}}][id_pdf]" value="{{$Dpdf->pdf_id}}">
                <input type="hidden" name="datapdf1[{{$loop->index}}][rev]" value="{{$Dpdf->revisi+1}}">
                <input type="hidden" name="datapdf1[{{$loop->index}}][revisi]" value="{{$Dpdf->revisi}}">
                <input type="hidden" name="datapdf1[{{$loop->index}}][turun]" value="{{$Dpdf->turunan}}">
                <input type="hidden" name="datapdf1[{{$loop->index}}][status]" value="inactive" class="form-control">
                <input type="hidden" name="datapdf1[{{$loop->index}}][primer]" value="{{$Dpdf->primer}}" class="form-control">
                <input type="hidden" name="datapdf1[{{$loop->index}}][primary]" value="{{$Dpdf->primery}}" class="form-control">
                <input type="hidden" name="datapdf1[{{$loop->index}}][secondary]" value="{{$Dpdf->secondery}}" class="form-control">
                <input type="hidden" name="datapdf1[{{$loop->index}}][tertiary]" value="{{$Dpdf->Tertiary}}" class="form-control">
                <input type="hidden" name="datapdf1[{{$loop->index}}][eksis]" value="{{$Dpdf->kemas_eksis}}" class="form-control">
                <?php $tanggal = Date("Y"); ?>
                <input type="hidden" value="_{{$tanggal}}/{{$Dpdf->product_type}}_{{ $Dpdf->project_name }}_{{ $Dpdf->revisi+1 }}.{{ $Dpdf->turunan }}" name="datapdf1[{{$loop->index}}][ket]" id="ket_no">
                @if($Dpdf->form1=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][name]" class="form-control" value="{{$Dpdf->project_name}}">
                @elseif($Dpdf->form1=='')<input type="hidden" name="datapdf1[{{$loop->index}}][name]" class="form-control" value="{{$Dpdf->project_name}}">@endif
                @if($Dpdf->form2=='ya')
                  <select name="datapdf1[{{$loop->index}}][brand]" style="display:none;" class="form-control">
                    <option value="{{$Dpdf->id_brand}}">{{$Dpdf->id_brand}}</option>
                    @foreach($brand as $br)
                    <option value="{{$br->brand}}">{{$br->brand}}</option>
                    @endforeach
                  </select>
                @elseif($Dpdf->form2=='')
                  <select style="display:none;" name="datapdf1[{{$loop->index}}][brand]" class="form-control">
                    <option value="{{$Dpdf->id_brand}}">{{$Dpdf->id_brand}}</option>
                    @foreach($brand as $br)
                    <option value="{{$br->brand}}">{{$br->brand}}</option>
                    @endforeach
                  </select>
                @endif 
                @if($Dpdf->form3=='ya')
                  <select name="datapdf1[{{$loop->index}}][type]" style="display:none;" class="form-control">
                    <option value="{{$Dpdf->type->id}}">{{$Dpdf->type->type}}</option>
                    @foreach ($type as $typ)
                    <option value="{{$typ->id}}">{{$typ->type}}</option>
                    @endforeach
                  </select>
                @elseif($Dpdf->form3=='')
                  <select style="display:none;" name="datapdf1[{{$loop->index}}][type]" class="form-control">
                    <option value="{{$Dpdf->type->id}}">{{$Dpdf->type->type}}</option>
                    @foreach ($type as $typ)
                    <option value="{{$typ->id}}">{{$typ->type}}</option>
                    @endforeach
                  </select>
                @endif 
                @if($Dpdf->form4=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][country]" class="form-control" value="{{$Dpdf->country}}">
                @elseif($Dpdf->form4=='')<input type="hidden" name="datapdf1[{{$loop->index}}][country]" class="form-control" value="{{$Dpdf->country}}">@endif
                @if($Dpdf->form5=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][reference]" class="form-control" value="{{$Dpdf->reference}}">
                @elseif($Dpdf->form5=='')<input type="hidden" name="datapdf1[{{$loop->index}}][reference]" class="form-control" value="{{$Dpdf->reference}}">@endif
                @if($Dpdf->form6=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][dariusia]" class="form-control" value="{{$Dpdf->dariusia}}">
                @elseif($Dpdf->form6=='')<input type="hidden" name="datapdf1[{{$loop->index}}][dariusia]" class="form-control" value="{{$Dpdf->dariusia}}">@endif
                @if($Dpdf->form6=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][sampaiusia]" class="form-control" value="{{$Dpdf->sampaiusia}}">
                @elseif($Dpdf->form6=='')<input type="hidden" name="datapdf1[{{$loop->index}}][sampaiusia]" class="form-control" value="{{$Dpdf->sampaiusia}}">@endif
								@if($Dpdf->form7=='ya')
									<select class="form-control" style="display:none;" name="datapdf1[{{$loop->index}}][gender]">
                    <option value="{{$Dpdf->gender}}">{{$Dpdf->gender}}</option>
                  </select>
                @elseif($Dpdf->form7=='')
                  <select style="display:none;" class="form-control" name="datapdf1[{{$loop->index}}][gender]">
                    <option value="{{$Dpdf->gender}}">{{$Dpdf->gender}}</option>
                  </select>
								@endif
                @if($Dpdf->form8=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][other]" class="form-control" value="{{$Dpdf->other}}">
                @elseif($Dpdf->form8=='')<input type="hidden" name="datapdf1[{{$loop->index}}][other]" class="form-control" value="{{$Dpdf->other}}">@endif
                @if($Dpdf->form9=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][background]" class="form-control" value="{{$Dpdf->background}}">
                @elseif($Dpdf->form9=='')<input type="hidden" name="datapdf1[{{$loop->index}}][background]" class="form-control" value="{{$Dpdf->background}}">@endif
                @if($Dpdf->form10=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][attractive]" class="form-control" value="{{$Dpdf->attractiveness}}">
                @elseif($Dpdf->form10=='')<input type="hidden" name="datapdf1[{{$loop->index}}][attractive]" class="form-control" value="{{$Dpdf->attractiveness}}">@endif
                @if($Dpdf->form11=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][rto]" class="form-control" value="{{$Dpdf->rto}}">
                @elseif($Dpdf->form11=='')<input type="hidden" name="datapdf1[{{$loop->index}}][rto]" class="form-control" value="{{$Dpdf->rto}}">@endif
                @if($Dpdf->form12=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][name2]" class="form-control" value="{{$Dpdf->name}}">
                @elseif($Dpdf->form12=='')<input type="hidden" name="datapdf1[{{$loop->index}}][name2]" class="form-control" value="{{$Dpdf->name}}">@endif
                @if($Dpdf->form13=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][retailer]" class="form-control" value="{{$Dpdf->retailer_price}}">
                @elseif($Dpdf->form13=='')<input type="hidden" name="datapdf1[{{$loop->index}}][retailer]" class="form-control" value="{{$Dpdf->retailer_price}}">@endif
                @if($Dpdf->form14=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][wight]" class="form-control" value="{{$Dpdf->wight}}">
                @elseif($Dpdf->form14=='')<input type="hidden" name="datapdf1[{{$loop->index}}][wight]" class="form-control" value="{{$Dpdf->wight}}">@endif
                @if($Dpdf->form15=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][serving]" class="form-control" value="{{$Dpdf->serving}}">
                @elseif($Dpdf->form15=='')<input type="hidden" name="datapdf1[{{$loop->index}}][serving]" class="form-control" value="{{$Dpdf->serving}}">@endif
                @if($Dpdf->form16=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][target]" class="form-control" value="{{$Dpdf->target_price}}">
                @elseif($Dpdf->form16=='')<input type="hidden" name="datapdf1[{{$loop->index}}][target]" class="form-control" value="{{$Dpdf->target_price}}">@endif
                @if($Dpdf->form17=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][claim]" class="form-control" value="{{$Dpdf->claim}}">
                @elseif($Dpdf->form17=='')<input type="hidden" name="datapdf1[{{$loop->index}}][claim]" class="form-control" value="{{$Dpdf->claim}}">@endif
                @if($Dpdf->form18=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][ingredient]" class="form-control" value="{{$Dpdf->ingredient}}">
                @elseif($Dpdf->form18=='')<input type="hidden" name="datapdf1[{{$loop->index}}][ingredient]" class="form-control" value="{{$Dpdf->ingredient}}">@endif
                @if($Dpdf->form19=='ya')<input type="hidden" name="datapdf1[{{$loop->index}}][special]" class="form-control" value="{{$Dpdf->special}}">
                @elseif($Dpdf->form19=='')<input type="hidden" name="datapdf1[{{$loop->index}}][special]" class="form-control" value="{{$Dpdf->special}}">@endif
              @endforeach
              <button class="btn btn-primary" type="submit"><li class="fa fa-check"></li> Submit</button>
              {{ csrf_field() }}
              <a href="{{route('hapuscheckpdf')}}" class="btn btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
            </form>
          </div>
        </div>
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
  <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
  <script src="{{ asset('lib/dropzoneJS/dropzone.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
  <script src="{{ asset('js/datatables.min.js')}}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('build/js/custom.min.js') }}"></script>
  <script>
    $(document).ready(function(){
      //ajax setup
      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });
    });
  </script>
  <script src="{{ asset('vendors/validator/validator.js') }}"></script>
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