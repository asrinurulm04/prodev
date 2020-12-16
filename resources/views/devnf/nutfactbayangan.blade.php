@extends('devwb.tempwb')
@section('judulnya', 'NUTFACT BAYANGAN')
@section('title', 'nutfact bayangan')
@section('content')

<style type="text/css">
	.panel-actions {
		margin-top: -20px;
		margin-bottom: 0;
		text-align: right;
	}

	.panel-actions a {
		color:#333;
	}

	.panel-fullscreen {
		display: block;
		z-index: 9999;
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		right: 0;
		left: 0;
		bottom: 0;
		overflow: auto;
	}
    
	.panel-fullscreen2 {
		display: block;
		z-index: 9999;
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		right: 0;
		left: 0;
		bottom: 0;
		overflow: auto;
	}
    
    @import "compass/css3";

	p {
		margin: 0;
	}

	.performance-facts {
		border: 1px solid black;
		float: left;
		margin-bottom:20px;
		width: 97%;
		padding: 0.5rem;
		table {
			border-collapse: collapse;
		}
	}

	.performance-fact {
		border: 1px solid black;
		background-color:;
		float: left;
		margin-bottom:20px;
		width: 97%;
		padding: 0.5rem;
		table {
			border-collapse: collapse;
		}
	}

	.performance-facts__title {
		font-size: 2rem;
		margin: 0 0 0.25rem 0;
	}

	.performance-facts__titles {
		font-size: 1.5rem;
		margin: 0 0 0.25rem 0;
	}

	.performance-facts__header {
		border-bottom: 10px solid black;
		padding: 0 0 0.25rem 0;
		margin: 0 0 0.5rem 0;
		p {
			margin: 0;
		}
	}

	.performance-facts__table {
		width: 100%;
		thead tr {
			th, td {
				border: 0;
			}
		}
		th, td {
			font-weight: normal;
			text-align: left;
			padding: 0.25rem 0;
			border-top: 1px solid black; 
			white-space: nowrap;
		}
		td {
			&:last-child {
				text-align: right;
			}
		}
		.blank-cell {
			width: 1rem;
			border-top: 0;
		}
		.thick-row {
			th, td {
				border-top-width: 5px;
			}
		}
	}
	.small-info {
		font-size: 1.2rem;
	}

	.performance-facts__table--small {
		@extend .performance-facts__table;
		border-bottom: 1px solid #999;
		margin: 0 0 0.5rem 0;
		thead {
			tr {
				border-bottom: 1px solid black; 
			}
		}
		td {
			&:last-child {
				text-align: left;
			}
		}
		th, td {
			border: 0;
			padding: 0;
		}
	}

	.performance-facts__table--grid {
		@extend .performance-facts__table;
		margin: 0 0 0.5rem 0;
		td {
			&:last-child {
				text-align: left;
				&::before {
					content: "•";
					font-weight: bold;
					margin: 0 0.25rem 0 0;
				}
			}
		}
	}

	.text-center {
		text-align: center;
	}
	.thick-end {
		border-bottom: 10px solid black;
	}
	.thin-end {
		border-bottom: 1px solid black;
	}

	.bg{
		background-color:dodgerblue;
			color:white;
	}
</style>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading bg">
        <div class="row">
          <a href="{{asset('datapn')}}" class="col-md-1 btn btn-danger" style="margin-left:1%;">KEMBALI</a>
          <b class="col-md-3 col-md-offset-4"><h3>NUTFACT BAYANGAN</h3></b>
        </div>
      </div>
      <div class="panel-body">    
        <!-- DATA FORMULA YANG DIPILIH -->
        @foreach($data as $datas)
        <dl class="row">
          <dt class="col-sm-2"><h4><b>Workbook</b></h4> </dt>
          <dd class="col-sm-2"><h4><b>:</b> {{$datas->Workbook->nama_project}}</h4></dd>
          <dt class="col-sm-2"><h4><b>Formula</b></h4> </dt>
          <dd class="col-sm-2"><h4><b>:</b> {{$datas->nama_produk}}</h4></dd>
          <dt class="col-sm-2"><h4><b>Kode Formula</b></h4> </dt>
          <dd class="col-sm-2"><h4><b>:</b> {{$datas->kode_formula}}</h4></dd>
          <dt class="col-sm-2"><h4><b>Revisi</b></h4> </dt>
          <dd class="col-sm-2"><h4><b>:</b> {{$datas->revisi}}</h4></dd>
          <dt class="col-sm-2"><h4><b>Versi</b></h4> </dt>
          <dd class="col-sm-2"><h4><b>:</b> {{$datas->versi}}.0   </h4></dd>
          <dt class="col-sm-2"><h4><b>Tanggal Masuk</b></h4> </dt>
          <dd class="col-sm-2"><h4><b>:</b> {{$datas->updated_at}}</h4></dd><br><br><br><br> 
        </dl>
        @endforeach
      	<div class="accordion" id="accordionExample">
          <!-- LIST INGREDIENT -->
          <div class="panel panel-info">
            <div class="panel-heading" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
                  <b>LIST INGREDIENT</b>
                </button>
                <ul class="list-inline panel-actions">
                  <li><a href="#" id="panel-fullscreen" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
                </ul>
              </h5>
            </div>
            <div aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="panel-body" style="overflow-x: scroll;">
                <table class="table table-advanced">
                  <thead>
                    <tr>
                      <th rowspan="2"  class="text-center" style="width: 5%; background-color:#d8d0d2;">No</th>
                      <th rowspan="2"  class="text-center" style="background-color:#d8d0d2;">Nama Sederhana</th>
                      <th colspan="2"  class="text-center" style="background-color:#d8d0d2;">BTP Carry Over</th>
                      <th rowspan="2"  class="text-center" style="background-color:#d8d0d2;">Dosis</th>
                      <th rowspan="2"  class="text-center" style="background-color:#d8d0d2;">%</th>
                      <th colspan="39" class="text-center" style="background-color:#54ff54;">Nutrition Data</th>
                    </tr>
                    <tr>
                      <th class="text-center" style="background-color:#d8d0d2;">All Carry Over</th>
                      <th class="text-center" style="background-color:#d8d0d2;">Carry Over dicantumkan dalam penulisan ing list</th>
                      <th class="text-center" style="background-color:#54ffba;">Lemak</th>
                      <th class="text-center" style="background-color:#54ffba;">SFA</th>
                      <th class="text-center" style="background-color:#54ffba;">Karbohidrat</th>
                      <th class="text-center" style="background-color:#54ffba;">Gula</th>
                      <th class="text-center" style="background-color:#54ffba;">Laktosa</th>
                      <th class="text-center" style="background-color:#54ffba;">Sukrosa</th>
                      <th class="text-center" style="background-color:#54ffba;">Serat</th>
                      <th class="text-center" style="background-color:#54ffba;">Serat Larut</th>
                      <th class="text-center" style="background-color:#54ffba;">Protein</th>
                      <th class="text-center" style="background-color:#54ffba;">Kalori</th>
                      <th class="text-center" style="background-color:#54ffba;">Na (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">K (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Ca (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Mg (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">P (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Beta Glucan</th>  
                      <th class="text-center" style="background-color:#54ffba;">Cr(mcg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Vit C (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Vit E (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Vit D (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Carnitin (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">CLA (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Sterol Ester (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Chondroitin (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Omega 3</th>
                      <th class="text-center" style="background-color:#54ffba;">DHA</th>
                      <th class="text-center" style="background-color:#54ffba;">EPA</th>
                      <th class="text-center" style="background-color:#54ffba;">Creatine</th>
                      <th class="text-center" style="background-color:#54ffba;">Lysine</th>
                      <th class="text-center" style="background-color:#54ffba;">Glucosamine (mg)</th>
                      <th class="text-center" style="background-color:#54ffba;">Kolin </th>
                      <th class="text-center" style="background-color:#54ffba;">MUFA</th>
                      <th class="text-center" style="background-color:#54ffba;">Linoleic Acid (Omega 6)</th>
                      <th class="text-center" style="background-color:#54ffba;">Linolenic Acid</th>
                      <th class="text-center" style="background-color:#54ffba;">Sorbitol</th>
                      <th class="text-center" style="background-color:#54ffba;">Maltitol</th>
                      <th class="text-center" style="background-color:#54ffba;">Kafein</th>
                      <th class="text-center" style="background-color:#54ffba;">Kolestrol</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ing as $i)
                    <tr>
                      <td class="text-center">1</td>
                      <td class="text-center">{{$i->get_bahan->nama_sederhana}}</td>
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center">{{$i->Lemak}}</td>
                      <td class="text-center">{{$i->SFA}}</td>
                      <td class="text-center">{{$i->karbohidrat}}</td>
                      <td class="text-center">{{$i->gula_total}}</td>
                      <td class="text-center">{{$i->laktosa}}</td>
                      <td class="text-center">{{$i->sukrosa}}</td>
                      <td class="text-center">{{$i->serat}}</td>
                      <td class="text-center">{{$i->serat_larut}}</td>
                      <td class="text-center">{{$i->protein}}</td>
                      <td class="text-center">{{$i->kalori}}</td>
                      <td class="text-center">{{$i->na}}</td>
                      <td class="text-center">{{$i->k}}</td>
                      <td class="text-center">{{$i->ca}}</td>
                      <td class="text-center">{{$i->mg}}</td>
                      <td class="text-center">{{$i->p}}</td>
                      <td class="text-center">{{$i->beta_glucan}}</td>
                      <td class="text-center">{{$i->cr}}</td>
                      <td class="text-center">{{$i->vit_c}}</td>
                      <td class="text-center">{{$i->vit_e}}</td>
                      <td class="text-center">{{$i->vit_d}}</td>
                      <td class="text-center">{{$i->carnitin}}</td>
                      <td class="text-center">{{$i->cla}}</td>
                      <td class="text-center">{{$i->sterol_ester}}</td>
                      <td class="text-center">{{$i->chondroitin}}</td>
                      <td class="text-center">{{$i->omega_3}}</td>
                      <td class="text-center">{{$i->dha}}</td>
                      <td class="text-center">{{$i->epa}}</td>
                      <td class="text-center">{{$i->creatine}}</td>
                      <td class="text-center">{{$i->lysine}}</td>
                      <td class="text-center">{{$i->glucosamine}}</td>
                      <td class="text-center">{{$i->kolin}}</td>
                      <td class="text-center">{{$i->mufa}}</td>
                      <td class="text-center">{{$i->linoleic_acido6}}</td>
                      <td class="text-center">{{$i->linoleic_acid}}</td>
                      <td class="text-center">{{$i->oleic_acid}}</td>
                      <td class="text-center">{{$i->sorbitol}}</td>
                      <td class="text-center">{{$i->maltitol}}</td>
                      <td class="text-center">{{$i->kafein}}</td>
                      <td class="text-center">{{$i->kolestrol}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr style="background-color:#fff651;">
                      <td colspan="4" class="text-center"></td>
                      <td class="text-center"><h5><b></b></h5></td>
                      <td class="text-center"><h5><b></b></h5></td>
                      <td class="text-center"><h5><b>{{$i->sum('Lemak')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('SFA')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('karbohidrat')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('gula_total')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('laktosa')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('sukrosa')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('serat')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('serat_larut')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('protein')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('kalori')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('na')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('k')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('ca')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('mg')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('p')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('beta_glucan')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('cr')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('vit_c')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('vit_e')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('vit_d')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('carnitin')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('cla')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('sterol_ester')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('chondroitin')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('omega_3')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('dha')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('epa')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('creatine')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('lysine')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('glucosamine')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('kolin')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('mufa')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('linoleic_acido6')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('linoleic_acid')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('oleic_acid')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('sorbitol')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('maltitol')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('kafein')}}</h5></b></td>
                      <td class="text-center"><h5><b>{{$i->sum('kolestrol')}}</h5></b></td>                                        
                      <!-- <td class="text-center"><a href="url('nutrition')}}" class="btn btn-info btn-lg">Input Nutrition</a></td> -->
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div> 

          <!-- CCT FORMAT & NUTFACT BAYANGAN -->
          <div class="panel panel-info">
            <div class="panel-heading" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <b>CCT FORMAT & NUTFACT</b>
                </button>
                <ul class="list-inline panel-actions">
                  <li><a href="#" id="panel-fullscreen2" role="button" title="Toggle fullscreen"><i class="pull-right glyphicon glyphicon-resize-full"></i></a></li>
                </ul>
              </h5>
            </div>
            <div aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="panel-body">
                <div class="col-md-6">
                  <table style="background-color:lightblue;" class="table table-hover table-condensed table-bordered">
                    <thead>
                      <tr style="background-color: black;color: white;">
                        <th class="text-center">Parameter</th>
                        <th class="text-center">Gramasi</th>
                        <th class="text-center">unit</th>
                        <th class="text-center">%AKG</th>
                        <th class="text-center">AKG</th>
                        <th class="text-center">unit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="" style=" color: black;">
                        <td>Energi Total</td>
                        <td class="text-right">{{number_format($i->sum('kalori'),3)}}</td>
                        <td class="text-center">kkal</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">kkal</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Energi Dari Lemak</td>
                        <td class="text-right">{{number_format($i->sum('Lemak')*9,3)}}</td>
                        <td class="text-center">kkal</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">kkal</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Energi Dari Lemak Jenuh</td>
                        <td class="text-right">{{number_format($i->sum('SFA')*9,3)}}</td>
                        <td class="text-center">kkal</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">kkal</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Karbohidrat Total</td>
                        <td class="text-right">{{number_format($i->sum('karbohidrat'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right">325</td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Protein</td>
                        <td class="text-right">{{number_format($i->sum('protein'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right">60</td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Lemak Total</td>
                        <td class="text-right">{{number_format($i->sum('Lemak'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right">67</td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Lemak Trans</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Lemak Jenuh</td>
                        <td class="text-right">{{number_format($i->sum('SFA'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right">{{number_format($i->sum('SFA')*100/20,3)}}</td>
                        <td class="text-right">20</td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Lemak Tidak Jenuh Tunggal</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Lemak Tidak Jenuh Ganda</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Kolestrol</td>
                        <td class="text-right">{{number_format($i->sum('kolestrol'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">300</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Gula</td>
                        <td class="text-right">{{number_format($i->sum('gula_total'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Serat Pangan</td>
                        <td class="text-right">{{number_format($i->sum('serat'),3)}}</td>
                        <td class="text-center">g</td>
                            <td class="text-right"></td>
                        <td class="text-right">30</td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Serat Pangan Larut</td>
                        <td class="text-right">{{number_format($i->sum('serat_larut'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Serat Pangan Tidak Larut</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center"></td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Sukrosa</td>
                        <td class="text-right">{{number_format($i->sum('sukrosa'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Laktosa</td>
                        <td class="text-right">{{number_format($i->sum('laktosa'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Gula Alkohol</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Natrium</td>
                        <td class="text-right">{{number_format($i->sum('na'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right">{{number_format($i->sum('na')*100/1500,3)}}</td>
                        <td class="text-right">1500</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Kalium</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">4700</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Kalsium</td>
                        <td class="text-right">{{number_format($i->sum('ca'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right">{{number_format($i->sum('ca')*100/1100,3)}}</td>
                        <td class="text-right">1100</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Zat Besi</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">22</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Fosfor</td>
                        <td class="text-right">{{number_format($i->sum('p'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right">{{number_format($i->sum('p')*100/700,3)}}</td>
                        <td class="text-right">700</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Magnesium</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">350</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Seng</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>    
                        <td class="text-right">13</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Selenium</td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                        <td class="text-right"></td>
                        <td class="text-right">30</td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Lodium</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">150</td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Mangan</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">2000</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Flour</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">2.5</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Tembaga</td>
                        <td class="text-right"></td>
                        <td class="text-center"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center"></td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin A</td>
                        <td class="text-right"></td>
                        <td class="text-center">IU</td>
                        <td class="text-right"></td>
                        <td class="text-right">1980</td>
                        <td class="text-center">IU</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin B1</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">1.4</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin B2</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">1.6</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin B3</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">15</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin B5</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">5</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin B6</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">1.3</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin B12</td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                        <td class="text-right"></td>
                        <td class="text-right">2.4</td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin C</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">90</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin D3</td>
                        <td class="text-right"></td>
                        <td class="text-center">IU</td>
                        <td class="text-right"></td>
                        <td class="text-right">400</td>
                        <td class="text-center">IU</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Vitamin E</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right">15</td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Asam Folat</td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                        <td class="text-right"></td>
                        <td class="text-right">400</td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Magnesium Aspartat</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Kolin</td>
                        <td class="text-right">{{number_format($i->sum('kolin'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Biotin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Inositol</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Molibdenum</td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Kromium</td>
                        <td class="text-right">{{number_format($i->sum('cr'),3)}}</td>
                        <td class="text-center">mcg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mcg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>EPA</td>
                        <td class="text-right">{{number_format($i->sum('EPA'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>DHA</td>
  	                    <td class="text-right">{{number_format($i->sum('DHA'),3)}}</td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>Glukosamin</td>
  	                    <td class="text-right">{{number_format($i->sum('glucosamine'),3)}}</td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>Kondroitin</td>
  	                    <td class="text-right">{{number_format($i->sum('chondroitin'),3)}}</td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>Kolagen</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>EGCG</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>Kreatina</td>
  	                    <td class="text-right">{{number_format($i->sum('creatine'),3)}}</td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>MCT</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">g</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">g</td>
  	                  </tr>
  	                  <tr class="" style=" color: black;">
  	                    <td>CLA</td>
  	                    <td class="text-right">{{number_format($i->sum('CLA'),3)}}</td>
  	                    <td class="text-center">mg</td>
  	                    <td class="text-right"></td>
  	                    <td class="text-right"></td>
  	                    <td class="text-center">mg</td>
  	                  </tr>
                      <tr class="" style=" color: black;">
                        <td>Omega 3</td>
                        <td class="text-right">{{number_format($i->sum('omega_3'),3)}}</td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Omega 6</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Omega 9</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Klorida</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Asam Linoleat</td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">g</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Energi dari Asam Linoleat</td>
                        <td class="text-right"></td>
                        <td class="text-center">kkal</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">kkal</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Energi dari Protein</td>
                        <td class="text-right">{{number_format($i->sum('protein')*4,3)}}</td>
                        <td class="text-center">kkal</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">kkal</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>L-Karnitin</td>
                        <td class="text-right">{{number_format($i->sum('carnitin'),3)}}</td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>L-Glutamin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Thereonin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Methionin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Phenilalanin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Histidin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Lisin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**BCAA</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Valin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Isoleusin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>**Leusin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Alanin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Asam Aspartat</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
    									<tr class="" style=" color: black;">
                        <td>Asam Glutamat</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Sistein</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Serin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Glisin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Tyrosin</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Proline</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Arginine</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                      <tr class="" style=" color: black;">
                        <td>Gluten</td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-center">mg</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <section class="performance-facts">
                    <header class="performance-facts__header">
                      <h1 class="performance-facts__title" align="center">INFORMASI NILAI GIZI</h1>
                      <h1 class="performance-facts__title" align="center">(NUTRITION FACT)</h1><br><br>
                      <p>Takaran Saji (Serving Size) {{$datas->sum('id')}}</p>
                    </header>
                    <table class="performance-facts__table">
                      <thead>
                        <tr>
                          <th colspan="4" class="performance-facts__titles" align="center">
                            <p align="center">JUMLAH PER SAJIAN (AMOUNT PER SERVING)</p>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th><b>Energi Total (Total Calories)</b></th>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('kalori'))}} kkal</td>
                        </tr>
                        <tr class="thin-end">
                          <th><b>Energi Dari Lemak (Calories from Fat)</b></th>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('Lemak')*9)}} kkal</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="performance-facts__table">
                      <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>% AKG</td>
                        </tr>
                        <tr>
                          <td>Lemak Total (Total Fat)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('Lemak'))}} g</td>
                          <td>{{round($i->sum('Lemak')*100/67)}} %</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>SFA</td>
                          <td></td>
                          <td>{{round($i->sum('SFA'))}} g</td>
                          <td>{{round($i->sum('SFA')*100/20)}} %</td>
                        </tr>
                        <tr>    
                          <td>Protein</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('protein'))}} g</td>
                          <td>{{round($i->sum('protein')*100/60)}} %</td>
                        </tr>
                        <tr>
                          <td>Karbohidrat Total (Total Carbohydrate)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('karbohidrat'))}} g</td>
                          <td>{{round($i->sum('karbohidrat')*100/325)}} %</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Gula (Sugars)</td>
                          <td></td>
                          <td>{{round($i->sum('gula_total'))}} g</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Laktosa (Lactose)</td>
                          <td></td>
                          <td>{{round($i->sum('laktosa'))}} g</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Sukrosa</td>
                          <td></td>
                          <td>{{$i->sum('sukrosa')}} g</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Natrium (Sodium)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('na'))}} mg</td>
                          <td>{{round($i->sum('na')*100/1500)}} %</td>
                        </tr>
                        <tr class="thin-end">
                          <td>Kalium</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('na'))}} mg</td>
                          <td>{{round($i->sum('na')*100/1500)}} %</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="performance-facts__table">
                      <tbody>
                        <tr>
                          <td>Vitamin A</td>
                          <td></td>
                          <td></td>
                          <td>{{round($vit_a->sum('target')*5)}} IU</td>
                          <td>{{round($vit_a->sum('target')*5*100/1980)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin B1 (Thiamin)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($thi->sum('target'))}} mg</td>
                          <td>{{round($thi->sum('target')*100/1.4)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin B2 (Ribofvlavin)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($rib->sum('target'))}} mg</td>
                          <td>{{round($rib->sum('target')*100/1.6)}} %</td>
                        </tr>
                        <tr>
                          <td>Vitamin B3 (Niacin)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($nia->sum('target'))}} mg</td>
                          <td>{{round($nia->sum('target')*100/15)}} %</td>                               
                        </tr>
                        <tr>
                          <td >Vitamin B5</td>
                          <td></td>
                          <td></td>
                          <td>{{round($b5->sum('target'))}} mg</td>
                          <td>{{round($b5->sum('target')*100/5)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin B6 (Pyridoxine)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($pyr->sum('target'))}} mg</td>
                          <td>{{round($pyr->sum('target')*100/1.3)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin B7 (Biotin)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($b7->sum('target'))}} mg</td>
                          <td>{{round($b7->sum('target')*100/30)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin B12 (Cyanocobalamine)</td>
                          <td></td>
                          <td></td>
                          <td>{{round($b12->sum('target'))}} mg</td>
                          <td>{{round($b12->sum('target')*100/2.4)}} %</td>
                        </tr>
                        <tr>
                          <td >Asam Folat</td>
                          <td></td>
                          <td></td>
                          <td>{{round($asam->sum('target'))}} mg</td>
                          <td>{{round($asam->sum('target')*100/400)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin C</td>
                          <td></td>
                          <td></td>
                          <td>{{round($vit_c->sum('target'))}} mg</td>
                          <td>{{round($vit_c->sum('target')*100/90)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin D</td>
                          <td></td>
                          <td></td>
                          <td>{{round($vit_d->sum('target'))}} mg</td>
                          <td>{{round($vit_d->sum('target')*100/600)}} %</td>
                        </tr>
                        <tr>
                          <td >Vitamin E</td>
                          <td></td>
                          <td></td>
                          <td>{{round($vit_e->sum('target'))}} mg</td>
                          <td>{{round($vit_e->sum('target')*100/15)}} %</td>
                        </tr>
                        <tr>
                          <td >Calcium</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('ca'))}} mg</td>
                          <td>{{round($i->sum('ca')*100/1100)}} %</td>
                        </tr>
                        <tr>
                          <td >Magnesium</td>
                          <td></td>
                          <td></td>
                          <td>{{round($mag->sum('target'))}} mg</td>
                          <td>{{round($mag->sum('target')*100/350)}} %</td>
                        </tr>
                        <tr>
                          <td >Phosphor</td>
                          <td></td>
                          <td></td>
                          <td>{{round($i->sum('p'))}} mg</td>
                          <td>{{round($i->sum('p')*100/700)}} %</td>
                        </tr>
                        <tr>
                          <td >Mangan</td>
                          <td></td>
                          <td></td>
                          <td>{{round($man->sum('target'))}} mg</td>
                          <td>{{round($man->sum('target')*100/2)}} %</td>
                        </tr>
                        <tr>
                          <td >Zinc</td>
                          <td></td>
                          <td></td>
                          <td>{{round($zin->sum('target'))}} mg</td>
                          <td>{{round($zin->sum('target')*100/13)}} %</td>
                        </tr>
                        <tr>
                          <td >Lodine</td>
                          <td></td>
                          <td></td>
                          <td>{{round($lod->sum('target'))}} mg</td>
                          <td>{{round($lod->sum('target')*100/150)}} %</td>
                        </tr>
                        <tr>
                          <td >Zat Besi</td>
                          <td></td>
                          <td></td>
                          <td>{{round($zat->sum('target'))}} mg</td>
                          <td>{{round($zat->sum('target')*100/22)}} %</td>
                        </tr>
                        <tr class="thin-end">
                          <td >Selenium</td>
                          <td></td>
                          <td></td>
                          <td>{{round($sel->sum('target'))}} mg</td>
                          <td>{{round($sel->sum('target')*100/30)}} %</td>    
                        </tr>
                      </tbody>
                    </table>
                    <p class="small-info">* Persen AKG berdasarkan kebutuhan energi 2150 kkal. Kebutuhan energi Anda </p>
                    <p class="small-info">&nbsp&nbsp  mungkin lebih tinggi atau lebih rendah. </p>
                    <p class="small-info">* Percent Daily Value are based on 2150 calorie diet. Your daily values may be higher  </p>
                    <p class="small-info">&nbsp&nbsp  or lower depending on your calorie needs </p>
									</section>
									<section class="performance-fact">
										<table class="performance-facts__table">
											<tbody>
												<tr>
													<td>Molybdenum</td>
													<td></td>
													<td></td>
													<td>{{round($mol->sum('target'))}} mcg</td>
													<td></td>
												</tr>
												<tr>
													<td>Inositol</td>
													<td></td>
													<td></td>
													<td>{{round($ino->sum('target'))}} mcg</td>
													<td></td>
												</tr>
												<tr>
													<td>Kolin</td>
													<td></td>
												<td></td>
												<td>{{round($i->sum('kolin'))}} mcg</td>
												<td>0 %</td>
											</tr>
										</tbody>
										</table>
									</section>
									<section class="performance-fact">
										<table class="performance-facts__table">
											<tbody>
												<tr>
														<td>L-Glutamin</td>
														<td></td>
														<td></td>
														<td>{{round($i->sum('na'))}} mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Threonin</td>
														<td></td>
														<td></td>
														<td>{{round($i->sum('na'))}} mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Methionin</td>
														<td></td>
														<td></td>
														<td>{{round($i->sum('na'))}} mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Phenilalanin</td>
														<td></td>
														<td></td>
														<td>{{round($i->sum('na'))}} mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Histidin</td>
														<td></td>
														<td></td>
														<td>{{round($i->sum('na'))}} mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Lisin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**BCAA</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Valin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Isoleusin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>**Leusin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>Alanin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>Asam Aspartat</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>Asam Glutamat</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>Sistein</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>Serin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
													</tr>
													<tr>
														<td>Glisin</td>
														<td></td>
														<td></td>
														<td>0 mg</td>
														<td></td>
												</tr>
												<tr>
													<td>Tyrosin</td>
													<td></td>
													<td></td>
													<td>0 mg</td>
													<td></td>
												</tr>
												<tr>
												<td>Proline</td>
													<td></td>
													<td></td>
													<td>0 mg</td>
													<td></td>
												</tr>
												<tr>
													<td>Arginine</td>
													<td></td>
													<td></td>
													<td>0 mg</td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</section>
    						</div>
              </div>
            </div>
        	</div>
  			</div>
      </div>
    </div>
  </div>
</div>
@endsection