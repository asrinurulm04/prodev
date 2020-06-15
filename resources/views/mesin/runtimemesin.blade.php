@extends('mesin.tempmesin')

@section('title','Feasibility|inputor')

@section('content')

<div id="RM" class="tab-pane">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
    <div class="card-block">
      <div class="card-header">
        <h2><i class="fa fa-cogs"></i> Data Mesin </h2>
        <div class="clearfix"></div>
      </div>
      <br>
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul class="nav nav-tabs  tabs" role="tablist">
          @foreach($dataF as $dF)
            <li class="nav-item"><a class="nav-link active" href="{{ route('runtimemesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">GRANULASI</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">MIXING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesinfilling',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">FILLING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesinpacking',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">PACKING</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('activitymesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">ACTIVITY</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('labmesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">LAB</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('standaryield',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">OH LAIN-LAIN</a></li>
          @endforeach
          </ul><br>
          <div id="myTabContent" class="tab-content">

                        <!-- MIXING -->
                        <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">Speed</th>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                    </thead>
                    <tbody>
                    @php
                    $nom = 0;
                  @endphp
                    @foreach($Mdata as $dM)
                    @php
                      ++$nom;
                    @endphp

                      {!!csrf_field()!!}
                      <tr id="row{{$dM->id_mesin}}">
                      @if( $dM->meesin->kategori=='granulasi' )
                      <td> {{ $dM->meesin->nama_mesin }}</td>
                        <td class="text-center" width="15%">{{$dM->standar_sdm}} Orang</td>
                          @if($dM->runtime==NULL)
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                        <td><input oninput="hitung();" name="runtime" class="date-picker form-control col-md-7 col-xs-12" type="number" required></td>
                        {{ csrf_field() }}
                        <input type="hidden" value="put" name="_method">
                        <td class="text-center"><button type="submit" class="btn btn-primary fa fa-check" data-toggle="tooltip" data-placement="top" title="Submit"></button></td>
                        @else
                        <td class="text-center" width="15%">{{$dM->runtime}} Menit</td>
                        <td class="text-center" width="15%"><button type="button" class="btn btn-warning fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                  <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content text-left ">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit Data
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button><h3>
                        </div>
                        <div class="modal-body">
                        <form id="edit{{ $dM->id_mesin }}">
              <div class="form-group">
                <input type="hidden" name="id" value="{{ $dM->id_mesin }}">
                <label for="recipient-name" class="col-form-label">Runtime Mesin:</label>
                <input id="runtime" value="{{$dM->runtime}}" name="runtime" class="date-picker form-control" type="text">
              </div></div>
              <div class="modal-footer">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="deleteData{{ $dM->id_mesin }}"></div>
                      </td>
                      <td width="15%"><input type="number" id='hasill{{$dM->id_mesin}}' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                    @endif
                    </tr>
                    @endif
                      </form>
                      @endforeach
                    </tbody>
                    </table>
                        </div>
                                      @foreach($dataF as $dF)
                        <a href="{{ route('dataoh',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-success fa fa-plus" type="button"> Add Activity</a>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('statusM',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
                        <input class="form-control1 " type="hidden" name="statusM" class="text-center col-md-7 col-xs-12" value="sending">
                        <center>
                        <a href="{{ route('datamesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger" type="button">Kembali</a>
      <button type="submit" class="btn btn-primary">Selesai</button>
			                      {{ csrf_field() }}
                            </center><br>
    </div>
    </form>@endforeach
                    </div>

                  </div>
                </div>
              </div>

@endsection

@section('s')
<script type="text/javascript">
  $(document).ready(function(){
      var i = {{ $nom }} ;
      var y;
      var total=0;
      for(y=1;y<=i;y++){
        var hasill = parseFloat($('#hasill'+y).val());
        total = total + hasill;
      }
      $('#totalnya').val(total);
  });
</script>

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
