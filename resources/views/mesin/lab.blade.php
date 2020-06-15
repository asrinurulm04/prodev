@extends('mesin.tempmesin')

@section('title','Feasibility|inputor')

@section('content')

<div id="RM" class="tab-pane">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
    <div class="card-block">
      <div class="card-header">
        <h2><i class="fa fa-cogs"></i> Data Lab </h2>
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Feasibility Analisa</label>
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
            <li class="nav-item"><a class="nav-link active" href="{{ route('labmesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">LAB</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('standaryield',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">OH LAIN-LAIN</a></li>
          @endforeach
          </ul><br>
          <div id="myTabContent" class="tab-content">

                  <!-- Lab -->
  <div class="panel panel-default">
	  <div class="panel-body">
      <div class="form-group">
      <br>
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">Mikro</label>
        <div class="col-md-10 col-sm-10 col-xs-12">
        <table class="table table-hover table-bordered center">
                    <thead>
                    <tr>
                    <th class="text-center">No Kategori</th>
                    <th class="text-center">Jenis Mikroba</th>
                    <th class="text-center">n</th>
                    <th class="text-center">c</th>
                    <th class="text-center">metode analisa</th>
                  </tr>
                    </thead>
                    @foreach($lab as $lab)
                    <tbody>
                    <tr>
                    <input type="hidden" name="finance" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
                      <input type="hidden" name="kategori[]" value="{{ $lab->no_kategori }}" class="form-control col-md-7 col-xs-12">
                    <th class="text-center">{{ $lab->no_kategori }}</th>
                      <input type="hidden" name="mikroba[]" value="{{ $lab->jenis_mikroba }}" class="form-control col-md-7 col-xs-12">
                    <th>{{ $lab->jenis_mikroba }}</th>
                      <input type="hidden" name="cc[]" value="{{ $lab->c }}" class="form-control col-md-7 col-xs-12">
                    <th class="text-center">{{ $lab->c }}</th>
                      <input type="hidden" name="nn[]" value="{{ $lab->n }}" class="form-control col-md-7 col-xs-12">
                    <th class="text-center">{{ $lab->n }}</th>
                      <input type="hidden" name="analisa[]" value="{{ $lab->metode_analisa }}" class="form-control col-md-7 col-xs-12">
                    <th>{{ $lab->metode_analisa }}</th>
                  </tr>
                    </tbody>
                    @endforeach
                    </table>
        </div>
        </div>
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
			                      {{ csrf_field() }}</center>
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
