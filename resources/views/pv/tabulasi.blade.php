@extends('pv.tempvv')
@section('title', 'Tabulasi Project')
@section('judulhalaman','Data PKP')
@section('content')

<div class="x_panel">
  <div class="">
    <div class="container"> 
      <section id="fancyTabWidget" class="tabs t-tabs">
      <ul class="nav nav-tabs fancyTabs" role="tablist">
        <li class="tab fancyTab active col-md-4 col-sm-12 col-xs-12">
          <div style="font-weight: bold;color:white;background-color: #2a3f54;" class="arrow-down"><div class="arrow-down-inner"></div></div>	
            <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" style="font-weight: bold;color:white;background-color: #2a3f54;" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> </span>PKP</a>
        	<div class="whiteBlock"></div>
        </li>
                  
        <li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
          <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
            <a id="tab1" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PDF</span></a>
          <div class="whiteBlock"></div>
        </li>
                  
        <li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
          <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
            <a id="tab2" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP Promo</span></a>
          <div class="whiteBlock"></div>
        </li>
               
      </ul>
      <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
        <!-- PKP -->
        <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0" >
          <div>
            <div class="row"  >
              <div class="col-md-12">
                <form class="form-horizontal form-label-left" method="POST" action="{{route('check')}}" novalidate>
                <a href="{{route('notulenpkp')}}" class="btn btn-info btn-sm"><li class="fa fa-book"></li> create Notulen PKP</a>
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#parampkp"><i class="fa fa-hand-o-right"></i> Custom Tabular</a></button>
                <!-- modal -->
                <div class="modal" id="parampkp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Select Header
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <thead>
                              <p><label><input type="checkbox" checked id="checkAllpkp1"/> Check all</label></p>
                              <input type="hidden" value="{{ Auth::user()->id }}" name="user">
                              <tr><td><input hidden type="checkbox" class="" checked name="par1" value="ya"> Project Name </td>
                              <td><input hidden type="checkbox" class="" checked name="par2" value="ya"> Brand </td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par3" value="ya"> Type</td>
                              <td><input type="checkbox" class="data1" checked name="par4" value="ya"> Idea</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par5" value="ya"> Age</td>
                              <td><input type="checkbox" class="data1" checked name="par6" value="ya"> Gender</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par7" value="ya"> Uniquenes Of Idea</td>
                              <td><input type="checkbox" class="data1" checked name="par8" value="ya"> Potential Market</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par9" value="ya"> Reason</td>
                              <td><input type="checkbox" class="data1" checked name="par10" value="ya"> Aisle Placement</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par11" value="ya"> Selling Price</td>
                              <td><input type="checkbox" class="data1" checked name="par12" value="ya"> Consumer Price</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par13" value="ya"> Main Competitor</td>
                              <td><input type="checkbox" class="data1" checked name="par14" value="ya"> Competitive</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par15" value="ya"> UOM</td>
                              <td><input type="checkbox" class="data1" checked name="par16" value="ya"> Product Form</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par17" value="ya"> AKG</td>
                              <td><input type="checkbox" class="data1" checked name="par18" value="ya"> Prefered Flavour</td></tr>
                              <tr><td><input type="checkbox" class="data1" checked name="par19" value="ya"> product benefits</td>
                              <td><input type="checkbox" class="data1" checked name="par20" value="ya"> mandatory ingredient</td></tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        {{ csrf_field() }}
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
                <table class="Table table-bordered" style="max-height:400px">
                  <thead>
                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                      <td></td>
                      <td class="text-center">No</td>
                      <th class="text-center">Brand</th>
                      <th class="text-center">priority</th>
                      <th class="text-center" width="40%">Idea</th>
                      <th class="text-center">Age</th>
                      <th class="text-center">Gender</th>
                      <th class="text-center">Uniquenes of idea</th>
                      <th class="text-center">Potential market</th>
                      <th class="text-center">Reason</th>
                      <th class="text-center">Aisle placement</th>
                      <th class="text-center">selling price</th>
                      <th class="text-center">Consumer price</th>
                      <th class="text-center">Main Competitor</th>
                      <th class="text-center">Competitive</th>
                      <th class="text-center">UOM</th>
                      <th class="text-center">Product Form</th>
                      <th class="text-center">prefered flavour</th>
                      <th class="text-center">product benefits</th>
                      <th class="text-center">mandatory ingredient</th>
                      <th class="text-center" width="3%">File</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datapkp as $Dpkp)
                    <tr>
                      <td><input type="checkbox" class="cekbox" name="datapkpp[]" id="cekbox" value="{{$Dpkp->id_project}}"></td>
                      <td>{{$Dpkp->pkp_number}}{{$Dpkp->ket_no}}</td>
                      <td>{{$Dpkp->id_brand}}</td>
                      <td class="text-center">
                        @if($Dpkp->prioritas==1)
                        <span class="label label-danger">Priority 1</span>
                        @elseif($Dpkp->prioritas==2)
                        <span class="label label-warning">Priority 2</span>
                        @elseif($Dpkp->prioritas==3)
                        <span class="label label-primary">Priority 3</span>
                        @endif
                      </td>
                      <td width="30%">{{$Dpkp->idea}}</td>
                      <td>{{$Dpkp->dariumur}}-{{$Dpkp->sampaiumur}}</td>
                      <td>{{$Dpkp->gender}}</td>
                      <td>{{$Dpkp->Uniqueness}}</td>
                      <td>{{$Dpkp->Estimated}}</td>
                      <td>{{$Dpkp->reason}}</td>
                      <td>{{$Dpkp->aisle}}</td>
                      <td>{{$Dpkp->price}}</td>
                      <td>{{$Dpkp->selling_price}}</td>
                      <td>{{$Dpkp->datapkp->competitor}}</td>
                      <td>{{$Dpkp->competitive}}</td>
                      <td>{{$Dpkp->uom}}</td>
                      <td>{{$Dpkp->product_form}}</td>
                      <td>{{$Dpkp->prefered_flavour}}</td>
                      <td>{{$Dpkp->product_benefits}}</td>
                      <td>{{$Dpkp->mandatory_ingredient}}</td>
                      <td>
                        <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#pkp{{$Dpkp->id_project}}"><i class="fa fa-folder-open"></i></a></button>
                        <!-- modal -->
                        <div class="modal" id="pkp{{$Dpkp->id_project}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title text-left" id="exampleModalLabel">Data Tambahan PKP
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></h3>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group row">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                        <th class="text-center">Number Project</th>
                                        <th class="text-center">File Name</th>
                                        <th class="text-center">Information</th>
                                        <th width="5%">File</th>
                                      </tr>
                                    </thead>
                                    <tbody>
				                          		@foreach($pic as $file)
                                        @if($file->pkp_id==$Dpkp->id_project)
	  		                          			@if($file->pkp_id!=NULL)
                                        <tr>
				                          				<td>{{$file->pkp->pkp_number}}{{$file->pkp->ket_no}}</td>
                          								<td>{{$file->filename}}</td>
                          								<td>{{$file->informasi}}</td>
                          								<td class="text-center">
                          								<embed src="{{asset('data_file/'.$file->filename)}}" width="55px" height="50" type=""></td>
                          							</tr>
                          							@endif
                                        @endif
                          						@endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal Selesai -->
                        {{-- <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#note{{$Dpkp->id_project}}"><i class="fa fa-edit"></i> Note</a></button> --}}
                        <!-- modal -->
                        {{-- <div class="modal" id="note{{$Dpkp->id_project}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title text-left" id="exampleModalLabel">Edit Note PKP
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></h3>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form class="form-horizontal form-label-left" method="POST" action="{{route('editnotulen')}}" novalidate>
                                <div class=" row">
                                  <table class="table table-bordered" style="overflow-x: scroll;">
                                    <thead>
                                      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                        <td Class="text-center"  width="70%">Note</td>
                                        <td Class="text-center">Date</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($notpkp as $np)
                                      <tr>
                                      @if($np->id_pkp==$Dpkp->id_pkp)
                                      <input type="hidden" value="{{$np->id_notulen}}" name="pkp[{{$loop->index}}][id_pkp]">
                                        <td><textarea class="col-md-12 col-sm-12 col-xs-12 form-control" name="pkp[{{$loop->index}}][note]" id="note" cols="50" rows="3">{{$np->note}}</textarea></td>
                                        <td>{{$np->users->name}}</td>
                                      @endif
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                  {{ csrf_field() }}
                              </div>
                              </form>
                            </div>
                          </div>
                        </div> --}}
                        <!-- Modal Selesai -->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{-- selesai --}}
        <!-- PDF -->
        <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('checkpdf')}}" novalidate>
            <a href="{{route('notulenpdf')}}" class="btn btn-sm btn-info" type="button"><li class="fa fa-book"></li> Create notulen PDF</a>
              <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#parampdf"><i class="fa fa-hand-o-right"></i> Custom Tabular</a></button>
                <!-- modal -->
                <div class="modal" id="parampdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Select Header
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <thead>
                              <p><label><input type="checkbox" checked id="checkAllpdf1"/> Check all</label></p>
                              <input type="hidden" value="{{ Auth::user()->id }}" name="user">
                              <tr><td><input hidden type="checkbox" checked name="par1" value="ya"> Project Name </td>
                              <td><input hidden type="checkbox" checked name="par2" value="ya"> Brand </td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par3" value="ya"> Type</td>
                              <td><input type="checkbox" class="check1" checked name="par4" value="ya"> country</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par5" value="ya"> reference</td>
                              <td><input type="checkbox" class="check1" checked name="par6" value="ya"> Age</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par7" value="ya"> Gender</td>
                              <td><input type="checkbox" class="check1" checked name="par8" value="ya"> Other</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par9" value="ya"> Background / Insight</td>
                              <td><input type="checkbox" class="check1" checked name="par10" value="ya"> Attracttiveness</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par11" value="ya"> Target RTO</td>
                              <td><input type="checkbox" class="check1" checked name="par12" value="ya"> Name Competitor</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par13" value="ya"> retailer price</td>
                              <td><input type="checkbox" class="check1" checked name="par14" value="ya"> wight</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par15" value="ya"> serving</td>
                              <td><input type="checkbox" class="check1" checked name="par16" value="ya"> Target NFI</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par17" value="ya"> claim</td>
                              <td><input type="checkbox" class="check1" checked name="par18" value="ya"> Inggrediend</td></tr>
                              <tr><td><input type="checkbox" class="check1" checked name="par19" value="ya"> What's Special</td><td></td></tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        {{ csrf_field() }}
                      </div>
                    </div>
                  </div>
                </div><!-- Modal Selesai -->
              <table class="Table table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <td></td>
                    <td class="text-center">No</td>
                    <th class="text-center">Brand</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Prioritas</th>
                    <th class="text-center">country</th>
                    <th class="text-center">reference</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Other</th>
                    <th class="text-center">Background / Insight</th>
                    <th class="text-center">Attracttiveness</th>
                    <th class="text-center">Target RTO</th>
                    <th class="text-center">Name Competitor</th>
                    <th class="text-center">Retailer price</th>
                    <th class="text-center">Wight/serving</th>
                    <th class="text-center">Target NFI</th>
                    <th class="text-center">claim</th>
                    <th class="text-center">Inggredients</th>
                    <th class="text-center">What's Special</th>
                    <th class="text-center">Data</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($datapdf as $Dpdf)
                  <tr>
                    <td><input type="checkbox" name="datapdf[]" class="form-control" value="{{$Dpdf->id_project_pdf}}"></td>
                    <td>{{$Dpdf->pdf_number}}{{$Dpdf->ket_no}}</td>
                    <td>{{$Dpdf->project_name}}</td>
                    <td>{{$Dpdf->type->type}}</td>
                    <td>
                      @if($Dpdf->prioritas==1)
                      <span class="label label-danger">Priority 1</span>
                      @elseif($Dpdf->prioritas==2)
                      <span class="label label-warning">Priority 2</span>
                      @elseif($Dpdf->prioritas==3)
                      <span class="label label-primary">Priority 3</span>
                      @endif
                    </td>
                    <td>{{$Dpdf->country}}</td>
                    <td>{{$Dpdf->reference}}</td>
                    <td>{{$Dpdf->dariusia}} - {{$Dpdf->sampaiusia}}</td>
                    <td>{{$Dpdf->gender}}</td>
                    <td>{{$Dpdf->other}}</td>
                    <td>{{$Dpdf->background}}</td>
                    <td>{{$Dpdf->attractiveness}}</td>
                    <td>{{$Dpdf->rto}}</td>
                    <td>{{$Dpdf->name}}</td>
                    <td>{{$Dpdf->retailer_price}}</td>
                    <td>{{$Dpdf->wight}}\{{$Dpdf->serving}}</td>
                    <td>{{$Dpdf->target_price}}</td>
                    <td>{{$Dpdf->claim}}</td>
                    <td>{{$Dpdf->ingredient}}</td>
                    <td>{{$Dpdf->special}}</td>
                    <td><button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#pdf{{$Dpdf->id_project_pdf}}"><i class="fa fa-book"></i> PDF</a></button>
                    <!-- modal -->
                    <div class="modal" id="pdf{{$Dpdf->id_project_pdf}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title text-left" id="exampleModalLabel">Data Tambahan PDF
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></h3>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <table class="table table-bordered">
                                <thead>
                                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                    <th class="text-center">Number Project</th>
                                    <th class="text-center">File Name</th>
                                    <th class="text-center">Information</th>
                                    <th width="5%">File</th>
                                  </tr>
                                </thead>
                                <tbody>
					                    	@foreach($pic as $file)
					                    	  @if($file->pdf_id!=NULL)
                                  <tr>
				  	                  		  <td>{{$file->pdf->pdf_number}}{{$file->pdf->ket_no}}</td>
					                    		  <td>{{$file->filename}}</td>
					                    		  <td>{{$file->informasi}}</td>
					                    		  <td class="text-center"><embed src="{{asset('data_file/'.$file->filename)}}" width="55px" height="50" type=""></td>
					                    	  </tr>
					                    	  @endif
						                    @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Selesai -->
                    {{-- <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#notepdf{{$Dpdf->id_project_pdf}}"><i class="fa fa-edit"></i> Note</a></button> --}}
                    <!-- modal -->
                    {{-- <div class="modal" id="notepdf{{$Dpdf->id_project_pdf}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title text-left" id="exampleModalLabel">Edit Note PDF
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></h3>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal form-label-left" method="POST" action="{{route('editnotulen')}}" novalidate>
                            <div class="row">
                              <table class="table table-bordered" style="overflow-x: scroll;">
                                <thead>
                                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                    <td Class="text-center" width="70%">Note</td>
                                    <td Class="text-center" >Date</td>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($notpdf as $np)
                                    <tr>
                                    @if($np->id_pdf==$Dpdf->id_project_pdf)
                                      <td><textarea class="col-md-12 col-sm-12 col-xs-12 form-control" name="pdf[{{$loop->index}}][note]" id="note" cols="70" rows="3">{{$np->note}}</textarea></td>
                                      <td>{{$np->users->name}}</td>
                                    @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                            {{ csrf_field() }}
                          </div>
                        </form>
                        </div>
                      </div>
                    </div> --}}
                    <!-- Modal Selesai -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </form>
            </div>
          </div>
        </div>
        {{-- selesai --}}
        <!-- Promo -->
        <div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('checkpromo')}}" novalidate>
              <a href="{{route('indexnotulenpromo')}}" class="btn btn-info btn-sm" type="button"><li class="fa fa-book"></li> Create Notulen PROMO</a>
              <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#datapromo"><i class="fa fa-hand-o-right"></i> Custom Tabular</a></button>
                <!-- modal -->
                <div class="modal" id="datapromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Select Header
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <thead>
                              <p><label><input type="checkbox" checked id="checkAllpromo1"/> Check all</label></p>
                              <input type="hidden" value="{{ Auth::user()->id }}" name="user">
                              <tr><td><input hidden type="checkbox" class="" checked name="par1" value="ya"> Project Name </td>
                              <td><input hidden type="checkbox" class="" checked name="par2" value="ya"> Brand </td></tr>
                              <tr><td><input type="checkbox" class="ck1" checked name="par3" value="ya"> Type</td>
                              <td><input type="checkbox" class="ck1" checked name="par4" value="ya"> country</td></tr>
                              <tr><td><input type="checkbox" class="ck1" checked name="par5" value="ya"> Item Promo Type</td>
                              <td><input type="checkbox" class="ck1" checked name="par6" value="ya"> Promo Idea</td></tr>
                              <tr><td><input type="checkbox" class="ck1" checked name="par7" value="ya"> Dimension</td>
                              <td><input type="checkbox" class="ck1" checked name="par8" value="ya"> Application</td></tr>
                              <tr><td><input type="checkbox" class="ck1" checked name="par9" value="ya"> Promo readines</td>
                              <td><input type="checkbox" class="ck1" checked name="par10" value="ya"> RTO</td></tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        {{ csrf_field() }}
                      </div>
                    </div>
                  </div>
                </div><!-- Modal Selesai -->
              <table class="Table table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <td></td>
                    <td class="text-center">No</td>
                    <th class="text-center">Brand</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Prioritas</th>
                    <th class="text-center">country</th>
                    <th class="text-center">Item promo type</th>
                    <th class="text-center">Promo Idea</th>
                    <th class="text-center">Dimension</th>
                    <th class="text-center">Application</th>
                    <th class="text-center">Promo readines</th>
                    <th class="text-center">RTO</th>
                    <th class="text-center">Data</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($datapromo as $Dpromo)
                  <tr>
                    <td><input type="checkbox" name="datapromo[]" class="form-control" value="{{$Dpromo->id_pkp_promo}}"></td>
                    <td>{{$Dpromo->promo_number}}{{$Dpromo->ket_no}}</td>
                    <td>{{$Dpromo->brand}}</td>
                    <td>
                    @if($Dpromo->type==1)
                    Maklon
                    @elseif($Dpromo->type==2)
                    Internal
                    @elseif($Dpromo->type==3)
                    Maklon/Internal
                    @endif
                    </td>
                    <td>
                      @if($Dpromo->prioritas==1)
                      <span class="label label-danger">Priority 1</span>
                      @elseif($Dpromo->prioritas==2)
                      <span class="label label-warning">Priority 2</span>
                      @elseif($Dpromo->prioritas==3)
                      <span class="label label-primary">Priority 3</span>
                      @endif
                    </td>
                    <td>{{$Dpromo->country}}</td>
                    <td>{{$Dpromo->promo_type}}</td>
                    <td>{{$Dpromo->promo_idea}}</td>
                    <td>{{$Dpromo->dimension}}</td>
                    <td>{{$Dpromo->application}}</td>
                    <td>{{$Dpromo->promo_readiness}}</td>
                    <td>{{$Dpromo->rto}}</td>
                    <td><button class="btn btn-info" type="button" data-toggle="modal" data-target="#promo{{$Dpromo->id_pkp_promo}}"><i class="fa fa-book"></i> PROMO</a></button>
                      <!-- modal -->
                      <div class="modal" id="promo{{$Dpromo->id_pkp_promo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title text-left" id="exampleModalLabel">Data Tambahan PROMO
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></h3>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                    <th class="text-center">Number Project</th>
                                    <th class="text-center">File Name</th>
                                    <th class="text-center">Information</th>
                                    <th class="text-center">File</th>
                                    </tr>
                                  </thead>
                                  <tbody>
				                        		@foreach($pic as $file)
				                        		@if($file->promo!=NULL)
                                    <tr>
                                      <td>{{$file->pkppromo->promo_number}}{{$file->pkppromo->ket_no}}</td>
                                      <td>{{$file->filename}}</td>
					                    		    <td>{{$file->informasi}}</td>
		                        					<td class="text-center">
		                        					<embed src="{{asset('data_file/'.$file->filename)}}" width="55px" height="50" type=""></td>
		                        				</tr>
		                        				@endif
		                        				@endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- Modal Selesai -->
                      {{-- <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#notpromo{{$Dpromo->id_pkp_promo}}"><i class="fa fa-edit"></i> Note</a></button> --}}
                      <!-- modal -->
                      {{-- <div class="modal" id="notpromo{{$Dpromo->id_pkp_promo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title text-left" id="exampleModalLabel">Edit Note PROMO
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></h3>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{route('editnotulen')}}" novalidate>
                              <div class="row">
                                <table class="table table-bordered" style="overflow-x: scroll;">
                                  <thead>
                                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                      <td Class="text-center" width="70%">Note</td>
                                      <td Class="text-center" >User</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($notpromo as $nr)
                                    <tr>
                                    @if($nr->id_promo==$Dpromo->id_pkp_promo)
                                      <td><textarea class="col-md-12 col-sm-12 col-xs-12 form-control" name="pdf[{{$loop->index}}][note]" id="note" cols="70" rows="3">{{$np->note}}</textarea></td>
                                      <td>{{$nr->users->name}}</td>
                                    @endif
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                              {{ csrf_field() }}
                            </div>
                          </form>
                          </div>
                        </div>
                      </div> --}}
                      <!-- Modal Selesai -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </form>
            </div>
          </div>
        </div>
        {{-- selesai --}}
      </div>
      </section>
    </div>
  </div>
</div>

@endsection
@section('s')
<script>
  // PKP
  $("#checkAllpkp").change(function () {
    $(".data").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpkp1").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
  });

  // PDF
  $("#checkAllpdf").change(function () {
    $(".check").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpdf1").change(function () {
    $(".check1").prop('checked', $(this).prop("checked"));
  });

  // PROMO
  $("#checkAllpromo").change(function () {
    $(".ck").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpromo1").change(function () {
    $(".ck1").prop('checked', $(this).prop("checked"));
  });
</script>
@endsection