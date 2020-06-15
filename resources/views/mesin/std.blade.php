@extends('mesin.tempmesin')

@section('title','Feasibility|inputor')

@section('content')
  
<div id="RM" class="tab-pane">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
    <div class="card-block">
      <div class="card-header">
        <h2><i class="fa fa-cogs"></i> OH Lain-lain </h2>
        <div class="clearfix"></div>
      </div>
      <br>
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul class="nav nav-tabs  tabs" role="tablist">
          @foreach($dataF as $dF)
            <li class="nav-item"><a class="nav-link" href="{{ route('runtimemesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">GRANULASI</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">MIXING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesinfilling',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">FILLING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesinpacking',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">PACKING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('activitymesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">ACTIVITY</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('labmesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">LAB</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('standaryield',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">OH LAIN-LAIN</a></li>
          @endforeach
          </ul><br>
          <div id="myTabContent" class="tab-content">

                       <!-- STD produksi -->
                  <div class="x_panel">
      <div class="x_content">
      
      @if($stdd == 0)
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/stdd" method="post">
          <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="status" maxlength="45" required="required" value="selesai" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">kode item</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
              @foreach($yieldd as $k)
              @if($k->kode != '')
                <input type="number" name="acid" value="{{$k->kode}}" maxlength="75" class="form-control2" readonly>
              @endif
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Item</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="text" name="nama" value="{{$k->nama_item}}" maxlength="125" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">yield</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="number" name="lye" value="{{$k->yield}}" maxlength="50" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Keterangan</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <textarea name="keterangan" maxlength="125" class="form-control"></textarea>
              </div>
          </div>
          @endforeach
            <div class="form-group">
          <center>
                  <button class="btn btn-warning" type="reset">Reset</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Submit</button>
                    <div class="modal" id="myModal2">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <h4>Yakin Dengan Data Yang Anda Masukan??</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
			                      {{ csrf_field() }}
                          </div>
                        </div>
                      </div>
                    </div>
                    </center>
              </div>
            </div>
          </div>  
        </form>
        @elseif( $stdd !=0)
        @foreach($standar as $std)
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">kode item</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="number" name="acid" value="{{$std->kode_item}}" maxlength="75" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Item</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="text" name="nama" value="{{$std->nama_item}}" maxlength="125" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">yield</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="number" name="lye" value="{{$std->yield}}" maxlength="50" class="form-control2" readonly>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <input name="keterangan" value="{{$std->catatan}}" maxlength="125" class="form-control2" readonly>
              </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
                                      </div>
                                      @foreach($dataF as $dF)  
                        <a href="{{ route('dataoh',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-success fa fa-plus" type="button"> Add Activity</a>

                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('statusM',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
                        <input class="form-control1" type="hidden" name="statusM" class="text-center col-md-7 col-xs-12" value="sending">
                        <center>
                        <a href="{{ route('datamesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger" type="button">Kembali</a>                    
      <button type="submit" class="btn btn-primary">Selesai</button>
			                      {{ csrf_field() }}
    </center>
    </form>@endforeach
                    </div>

                  </div>
                </div>
              </div>

@endsection

@section('s')

<script type="text/javascript">
  $(document).ready(function(){
      
      $.ajax({
        url: '/api/runtime/' + '{{ $id_feasibility }}',
        method: 'GET',
        type: 'JSON',
        success : function(data){
          console.log(data);
          var formDelete = '';
          for(var i = 0; i < Object.keys(data).length; i++){
            // console.log(i)
            formDelete = '<form id="'+data[i].id_mesin+'" type="POST">' +
                            '{{ csrf_field() }}' +
                            '<button type="submit" class="btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></button> ' +
                            '<input type="hidden" name="_method" value="DELETE">' +
                          '</form>';
            $('#deleteData'+data[i].id_mesin).html(formDelete);

            $('#'+data[i].id_mesin).submit(function(e) {
              e.preventDefault();
              var id = $(this).attr('id');
              $.ajax({
                method: 'POST',
                data: {
                  '_method' : 'DELETE'
                },
                url: window.location.origin + '/deletedata/' + id,
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res){
                  console.log('Berhasil')
                  $('#row'+id).html('');
                },
                error: function(error){
                  console.log('error')
                  console.log(error)
                }
              })
            })
            $('#edit'+data[i].id_mesin).submit(function(e){
              e.preventDefault();
              var data = $(this).serializeArray();
              var id = data[0].value;
              var runtime = data[1].value;
              $.ajax({
                url: window.location.origin + '/updatemss/' + id,
                method: 'POST',
                data: {
                  '_method' : 'PUT',
                  'runtime' : runtime
                },
                headers: {
                  'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                success: function(res){
                  console.log('Success')
                  $('#runtime'+id).html(runtime)
                  $.ajax({
                    url: window.location.origin + '/api/update/' + id,
                    method: 'GET',
                    type: 'JSON',
                    success: function(data){
                      console.log(data.runtime)
                      $('#runtimes'+id).val(data.runtime);
                      $('#hasill'+id).val(data.hasil);
                    }, 
                    error: function(error){
                      console.log('Gagal update view')
                    }
                  })
                },
                error: function(error){
                  console.log('error')
                  console.log(error)
                }
              })
            })
          }
        },
        error :function(error){
          console.log('error')
          console.log(error)
        }
      })
      
      $('document').on('submit', function(e){
        e.preventdefault();
        console.log($(this).serializeArray());
      })
  });
</script>
@endsection