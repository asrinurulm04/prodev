<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Email Overview</title>
  <link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="pcoded" class="pcoded">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="" >
          <div class="row" style="margin:20px">
            <div class="card-block">
              <div class="dt-responsive table-responsive"><br>
                <table border="1" style="font-size:15px" class="table table-bordered" width="800">
                  <thead>
                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                      <th class="text-center" colspan="2">Project Overview</th>
                    </tr>
                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                      <th class="text-center">Information</th>
                      <th class="text-center">Option</th>
                    </tr>
                  </thead>
                  <tbody class="text-left">
                    @if($fs->id_project!=NULL)
                    <tr>
                      <td width="40%">Target Launching</td>
                      <td>{{$data->launch}} {{$data->years}}</td>
                    </tr>
                    @endif
                    <tr>
                      <td>Project Name</td>
                      <td>
                        @if($fs->id_project!=NULL){{$data->project_name}}
                        @elseif($fs->id_project_pdf!=NULL){{$data->datapdf->project_name}}@endif
                      </td>
                    </tr>
                    <tr>
                      <td>Product Name/Desc</td>
                      <td>
                        @if($fs->id_project!=NULL){{$data->idea}}
                        @elseif($fs->id_project_pdf!=NULL){{$data->background}}@endif
                      </td>
                    </tr>
                    <tr>
                      <td>Formula Code</td>
                      <td>{{$formula->formula}}</td>
                    </tr>
                    @if($fs->id_project!=NULL)
                    <tr>
                      <td>Product type (BPOM Category)</td>
                      <td>({{$data->katpangan->no_kategori}}) {{$data->katpangan->pangan}}</td>
                    </tr>
                    @endif
                    <tr>
                      <td>Packaging configuration</td>
                      <td>
                        @if($data->kemas_eksis!=NULL)(
                          @if($data->kemas->tersier!=NULL)
                          {{ $data->kemas->tersier }}{{ $data->kemas->s_tersier }}
                          @endif

                          @if($data->kemas->sekunder1!=NULL)
                          X {{ $data->kemas->sekunder1 }}{{ $data->kemas->s_sekunder1}}
                          @endif

                          @if($data->kemas->sekunder2!=NULL)
                          X {{ $data->kemas->sekunder2 }}{{ $data->kemas->s_sekunder2 }}
                          @endif

                          @if($data->kemas->primer!=NULL)
                          X{{ $data->kemas->primer }}{{ $data->kemas->s_primer }}
                          @endif )
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Product reference :product characteristic</td>
                      <td>{{$form->product_reference}}</td>
                    </tr>
                    <tr>
                      <td>Product reference :packaging </td>
                      <td>{{$kemas->nama_sku}}</td>
                    </tr>
                    <tr>
                      <td>Forecast (Rp/ month)</td>
                      <td>{{$for}}</td>
                    </tr>
                    <tr>
                      <td>Pricelist (Rp/ UOM)</td>
                      <td>{{$form->Pricelist}}</td>
                    </tr>
                    <tr>
                      <td>UoM</td>
                      <td>{{$data->UOM}}</td>
                    </tr>
                    <tr>
                      <td>UoM per BOX</td>
                      <td>{{ $data->kemas->tersier }}</td>
                    </tr>
                    <tr>
                      <td>Gramasi per UOM (g)</td>
                      <td>{{$form->gramasi_uom}}</td>
                    </tr>
                    <tr>
                      <td>serving size (g)</td>
                      <td>{{$form->serving_size}}</td>
                    </tr>
                    <tr>
                      <td>serving/ UOM</td>
                      <td>{{$form->serving_uom}}</td>
                    </tr>
                    <tr>
                      <td>Batch size (g)</td>
                      <td>{{$form->batch_size}}</td>
                    </tr>
                    <tr>
                      <td>Batch size granulation (kg)</td>
                      <td>{{$form->batch_granulation}}</td>
                    </tr>
                    <tr>
                      <td>Yield (%)</td>
                      <td>{{$form->Yield}}</td>
                    </tr>
                    <tr>
                      <td>BOX per BATCH</td>
                      <td>{{$form->box_batch}}</td>
                    </tr>
                    <tr>
                      <td>UOM / month</td>
                      <td>{{$form->uom_month}}</td>
                    </tr>
                    <tr>
                      <td>Batches/month</td>
                      <td>{{$form->Batch_month}}</td>
                    </tr>
                    <tr>
                      <td>Production Location</td>
                      <td>@foreach($lokasi as $lokasi)* {{$lokasi->IO}} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <td>Fillpack Location</td>
                      <td>@foreach($lokasi2 as $lokasi2)* {{$lokasi2->IO}} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <td>Filling Machine</td>
                      <td>@foreach($mesin as $mesin)* {{$mesin->nama_mesin}} <br>@endforeach</td>
                    </tr>
                    <tr>
                      <td>Cost of Packaging (Rp/UOM)</td>
						          <td>{{$forKemas->cost_uom}}</td>
                    </tr>
                    <tr>
                      <td>Cost of Lab/Analysis (Rp/UOM)</td>
						          <td>{{$analisa}}</td>
                    </tr>
                    <tr>
                      <td>Maklon Fee (Rp/UOM)</td>
                      <td>{{$maklon->biaya_maklon}}</td>
                    </tr>
                    <tr>
                      <td>Transportation Fee (Rp/UOM)</td>
                      <td>{{$maklon->biaya_transport}}</td>
                    </tr>
                    <tr>
                      <td>Allergen information | contain</td>
                      <td>{{$all->allergen_baru}}</td>
                    </tr>
                    <tr>
                      <td>Allergen information | may contain (from the production line)</td>
                      <td>{{$all->my_contain}}</td>
                    </tr>
                    <tr>
                      <td>Allergen impact to production line</td>
                      <td>{{$all->lini_terdampak}}</td>
                    </tr>
                    <tr>
                      <td>New Raw Material?</td>
                      <td>{{$form->new_raw_material}}</td>
                    </tr>
                    <tr>
                      <td>Value of Unprocessed Raw Material per year</td>
						          <td><?php $angka_format = number_format($form->material_per_year,2,",","."); echo "Rp. ".$angka_format;?></td>
                    </tr>
                    <tr>
                      <td>New Packaging Material?</td>
                      <td>{{$form->new_packaging_material}}</td>
                    </tr>
                    <tr>
                      <td>Value of Unprocessed Packaging Material per year</td>
						          <td><?php $angka_format = number_format($form->packaging_per_year,2,",","."); echo "Rp. ".$angka_format;?></td>
                    </tr>
                    <tr>
                      <td>New Machine?</td>
                      <td>{{$form->new_machine}}</td>
                    </tr>
                    <tr>
                      <td>Need Trial before real packaging?</td>
                      <td>{{$form->trial}}</td>
                    </tr>
                    <tr>
                      <td>Reff EKP</td>
                      <td>{{$form->ref_ekp}}</td>
                    </tr>
                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                      <th colspan="2">1. Seluruh runtime yang digunakan mengacu pada standar perhitungan costing, kecuali distate lain. Misal : runtime mixer meliput charging-discharge, tidak hanya mixing</th>
                    </tr>
                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                      <th colspan="2">2. Jumlah SDM  yang digunakan tiap proses mengacu pada standar, kecuali distate lain</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div
          </div>
        </div>
      </div>
    </div>
  </body>
</html>