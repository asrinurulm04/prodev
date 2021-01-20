@extends('pv.tempvv')
@section('title', 'PRODEV|Request PDF')
@section('content')

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

<div class="x_panel">
  <div class="btn-group col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li> Use Tempale</button>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Mandatory Information</td>
        <td>* : Filled by Marketing</td>
        <td>^ : Filled By PV</td>
        <td>** : Filled by Marketing Or PV</td>
      </tr>
    </table>
  </div>
</div>

<div class="row">
<form class="form-horizontal form-label-left" method="POST" action="{{ route('datapdf') }}" novalidate>
  <div class="col-md-6 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"></li> Project</h3>
      </div>
      <div class="card-block">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Project Type**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="product_type" required name="product_type" class="form-control" >
              <option disabled selected>-- Select One --</option>
              <option value="PDF">PDF</option>
              <option value="PDFe">PDFe</option>
              <option value="PDEp">PDFp</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Revision**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input required id="author" value="0.0" class="form-control col-md-12 col-xs-12" type="text" name="" readonly>
            <input required id="author" value="{{ Auth::user()->id }}" class="form-control col-md-12 col-xs-12" type="hidden" name="author" readonly>
          </div>
        </div>
        <?php $date = Date('j-F-Y'); ?>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Date**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input required id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="date" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Type**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required="required" id="type" name="type" class="form-control" >
              <option disabled selected>-- Select One --</option>
              @foreach($type as $type)
              <option value="{{  $type->id }}">{{  $type->type }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="ln_solid"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"> </li> Project</h3>
      </div>
      <div class="card-block">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Project Name**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input required="required" id="project_name" onkeyup="this.value = this.value.toUpperCase()" class="form-control col-md-12 col-xs-12" type="text" name="project_name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Brand**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required="required" id="brand" name="brand" class="form-control" >
              <option disabled selected>-- Select One --</option>
              @foreach($brand as $brand)
              <option value="{{  $brand->brand }}">{{  $brand->brand }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Country**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input required="required" id="country" class="form-control col-md-12 col-xs-12" type="text"  name="country">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Reference**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input required="required" id="reference" class="form-control col-md-12 col-xs-12" type="text" placeholder="Reference Regulation" name="reference">
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>

  <div class="x_panel">
    <div class="col-md-6 col-sm-offset-5 col-md-offset-5">
      <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
      <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
      {{ csrf_field() }}
    </div>
  </div>
</form>
</div>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Template PDF
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <td width="5%">No</td>
              <td>No_pkp</td>
              <td>Brand</td>
              <td>Nama Project</td>
              <td>Author</td>
              <td></td>
            </tr>
          </thead>
         <tbody>
            @php $nol = 0; @endphp
            @foreach ($pdf1 as $pdf)
            <tr>
              <td class="text-center">{{ ++$nol }}</td>
              <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
              <td>{{$pdf->id_brand}}</td>
              <td>{{$pdf->project_name}}</td>
              <td>{{$pdf->author1->name}}</td>
              <td class="text-center">
              <a href="{{route('temppdf',$pdf->id_project_pdf)}}" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to use this template ?')"><i class="fa fa-check"></i></a>
              </td>
            </tr>
            @endforeach
         </tbody>
        </table>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Selesai -->

<script type="text/javascript">
  $(document).ready(function() {
    $(".btn-success").click(function(){
      var html = $(".clone").html();
      $(".increment").after(html);
    });
    $("body").on("click",".btn-danger",function(){
      $(this).parents(".control-group").remove();
    });
  });
</script>
@endsection
