@extends('feasibility.tempfeasibility')
@section('title', 'PRODEV|feasibility')
@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Feasibility</li></h3><hr>
      <table>
        <tr><th width="10%">Nama Produk </th><th width="45%">: {{ $myFormula->datapkpp->project_name}}</th>
        <tr><th width="10%">Tanggal Terima</th><th width="45%">: {{ $myFormula->updated_at }}</th>
        <tr><th width="10%">No.PKP</th><th width="45%">: {{ $myFormula->datapkpp->pkp_number }}{{$myFormula->datapkpp->ket_no}}</th>
        <tr><th width="10%">Idea</th><th width="45%">: {{ $myFormula->idea }}</th></tr>
        <tr><th width="10%">Action</th><th>: 
        @if(auth()->user()->role->namaRule === 'evaluator')
        <a class="btn btn-success btn-sm fa fa-plus" data-toggle="tooltip" data-placement="top" title="tambah Data" href="{{ route('upFeasibility',$myFormula->id) }}"> Add Option</a>
        @endif
        @if(auth()->user()->role->namaRule === 'kemas')
        <a class="btn btn-danger btn-sm fa fa-sign-out" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('rekappkp',$myFormula->id) }}"> Kembali</a></th></tr>
        @elseif(auth()->user()->role->namaRule != 'kemas')
          @if(auth()->user()->role->namaRule != 'pv_global' && auth()->user()->role->namaRule != 'pv_lokal')
          <a class="btn btn-danger btn-sm fa fa-sign-out" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('formula.feasibility') }}"> Kembali</a></th></tr>
          @elseif(auth()->user()->role->namaRule == 'pv_global' || auth()->user()->role->namaRule == 'pv_lokal')
          <a class="btn btn-danger btn-sm fa fa-sign-out" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('rekappkp',$myFormula->id) }}"> Kembali</a></th></tr>
          @endif
        @endif
      </table>
    </div>
    <div class="card-block">
      <div class="dt-responsive table-responsive"><br>
        <table id="multi-colum-dt" class="Table table-striped table-bordered nowrap">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th class="text-center" width="10%">Option</th>
              <th class="text-center">Status Kemas</th>
              <th class="text-center">Status Evaluator</th>
              <th class="text-center">Status Produksi</th>
              <th class="text-center">Status Lab</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
          @foreach($dataF as $dF)
          <tr>
            <td class="text-center">{{ $dF->kemungkinan }}</td>

            @if($dF->status_kemas =='belum selesai')
            <td class="text-center"><span class="labell label-danger " style="color:#ffff">{{ $dF->status_kemas }}</span></td>
            @elseif($dF->status_kemas=='selesai')
            <td class="text-center"><span class="labell label-info " style="color:#ffff">{{ $dF->status_kemas }}</span></td>
            @elseif($dF->status_kemas=='sending')
            <td class="text-center"><span class="labell label-success " style="color:#ffff">{{ $dF->status_kemas }}</span></td>
            @endif

            @if($dF->status_mesin =='belum selesai')
            <td class="text-center"><span class="labell label-danger " style="color:#ffff">{{ $dF->status_mesin }}</span></td>
            @elseif($dF->status_mesin=='selesai')
            <td class="text-center"><span class="labell label-info " style="color:#ffff">{{ $dF->status_mesin }}</span></td>
            @elseif($dF->status_mesin=='sending')
            <td class="text-center"><span class="labell label-success " style="color:#ffff">{{ $dF->status_mesin }}</span></td>
            @endif

            @if($dF->status_sdm =='belum selesai')
            <td class="text-center"><span class="labell label-danger " style="color:#ffff">{{ $dF->status_sdm }}</span></td>
            @elseif($dF->status_sdm =='selesai')
            <td class="text-center"><span class="labell label-info " style="color:#ffff">{{ $dF->status_sdm }}</span></td>
            @elseif($dF->status_sdm=='sending')
            <td class="text-center"><span class="labell label-success " style="color:#ffff">{{ $dF->status_sdm }}</span></td>
            @endif

            @if($dF->status_lab =='belum selesai')
            <td class="text-center"><span class="labell label-danger " style="color:#ffff">{{ $dF->status_lab }}</span></td>
            @elseif($dF->status_lab=='selesai')
            <td class="text-center"><span class="labell label-info " style="color:#ffff">{{ $dF->status_lab }}</span></td>
            @endif
            <td class="text-center">

            <!-- link -->
            @if(auth()->user()->role->namaRule === 'evaluator')
            @if($dF->status_kemas =='belum selesai')
            <a type="submit" class="btn btn-info fa fa-edit" data-toggle="tooltip" data-placement="top" title="Data kemas belum terisi!" disabled></a>
            @elseif($dF->status_mesin=='belum selesai')
            <a href="{{ route('reference',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="buat data"></a>
            @elseif($dF->status_mesin=='sending')
            <a href="{{ route('datamesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-paste" data-toggle="tooltip" data-placement="top" title="Edit Data"></a>
            @endif

            @elseif(auth()->user()->role->namaRule === 'kemas')
            @if($dF->status_kemas=='belum selesai')
            <a href="{{ route('konsepkemas', ['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></a>
            @elseif($dF->status_kemas!='belum selesai')
            <a href="{{ url('lihat',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
            @endif

            @elseif(auth()->user()->role->namaRule === 'lab')
            @if($dF->status_mesin =='belum selesai')
            <a type="submit" class="btn btn-info fa fa-edit" data-toggle="tooltip" data-placement="top" title="Data mesin belum terisi!" disabled></a>
            @elseif($dF->status_lab =='belum selesai')
            <a href="{{ route('datalab',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></a>
            @elseif($dF->status_lab =='selesai')
            <a href="{{ route('datalab',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="Edit"></a>
            @endif

            @elseif(auth()->user()->role->namaRule === 'produksi')
            @if($dF->status_mesin =='belum selesai')
            <a type="submit" class="btn btn-info fa fa-edit" data-toggle="tooltip" data-placement="top" title="Data mesin belum terisi!" disabled></a>
            @elseif($dF->status_sdm =='belum selesai')
            <a href="{{ route('produksi',$dF->id_feasibility) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></a>
            @elseif($dF->status_sdm !='belum selesai')
            <a href="{{ route('data',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
            @endif

            @elseif(auth()->user()->role->namaRule === 'finance')
              @if($dF->status_feasibility =='belum selesai')
                @if($dF->status_finance =='belum selesai')
                <a href="{{ route('finance',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></a>
                @elseif($dF->status_finance !='belum selesai')
                <a href="{{ route('summary',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
                <a href="{{ route('akhirfs',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-success fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="sent to PV"></a>
                @endif
              @elseif($dF->status_feasibility =='selesai')
              <a href="{{ route('summary',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
              @endif
            @endif
            @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'pv_global')
              <a href="{{ route('summary',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
            @endif
              @if(auth()->user()->role->namaRule === 'evaluator')
            <a href="{{ route('deletefs', $id) }}" class="btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></a>
            </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
@section('fs')

@if(auth()->user()->role->namaRule === 'finance')
  @if($dF->status_finance =='selesai')
    @if($dF->ststus_feasibility !='selesai')
      @foreach($dataF as $dF)
      <form id="demo-form2" action="{{route('kirimWB',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
      @endforeach
      <div class="showback">
        <div class="row">
          <div class="col-md-2"><h5><i class="fa fa-list"></i> Option Yang Akan Dikirim</h5> </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <input class="form-control1 hidden" name="status" class="text-center col-md-7 col-xs-12" value="selesai">
              <input class="form-control1 hidden" name="statusF" class="text-center col-md-7 col-xs-12" value="approved">
              <select class="form-control" name="dropdown">
                @foreach($kirim as $item)
                <option name="option" value="{{ $item->kemungkinan }}">{{ $item->kemungkinan}}</option>
                @endforeach
              </select>
            </div>
          <button class="btn btn-info" type="submit">Kirim</button>
          {{ csrf_field() }}
        </div>
      </div>
      </form>
    @endif
  @endif
@endif

@endsection

@section('pesan')

<div class="col-md-1"><h4>
  @if(auth()->user()->role->namaRule === 'produksi')
  <a data-toggle="dropdown" class="dropdown-toggle">
    <i class="fa fa-envelope-o"></i>
      <span class="badge bg-theme">{{$jumlahp}}</span>
    </a>
    <ul class="dropdown-menu extended inbox">
      <div class="notify-arrow notify-arrow-green"></div>
      <li>
        <p class="green">You have {{$jumlahp}} new messages</p>
      </li>
      <li class="text-center">
        @foreach($dataF as $dF)
        <a href="{{ route('inboxproduksi',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">See all messages</a>
        @endforeach
      </li>
    </ul>
  @endif

  @if(auth()->user()->role->namaRule === 'evaluator')
    <a data-toggle="dropdown" class="dropdown-toggle">
      <i class="fa fa-envelope-o"></i>
      <span class="badge bg-theme">{{$jumlahm}}</span>
    </a>
    <ul class="dropdown-menu extended inbox">
      <div class="notify-arrow notify-arrow-green"></div>
      <li>
        <p class="green">You have {{$jumlahm}} new messages</p>
      </li>
      <li class="text-center">
        @foreach($dataF as $dF)
        <a href="{{ route('inboxmesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">See all messages</a>
        @endforeach
      </li>
    </ul>
  @endif

  @if(auth()->user()->role->namaRule === 'lab')
    <a data-toggle="dropdown" class="dropdown-toggle">
    <i class="fa fa-envelope-o"></i>
      <span class="badge bg-theme">{{$jumlahl}}</span>
    </a>
    <ul class="dropdown-menu extended inbox">
      <div class="notify-arrow notify-arrow-green"></div>
      <li>
        <p class="green">You have {{$jumlahl}} new messages</p>
      </li>
      <li class="text-center">
        @foreach($dataF as $dF)
          <a href="{{ route('inboxlab',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">See all messages</a>
        @endforeach
      </li>
    </ul>
  @endif

  @if(auth()->user()->role->namaRule === 'kemas')
    <a data-toggle="dropdown" class="dropdown-toggle">
      <i class="fa fa-envelope-o"></i>
      <span class="badge bg-theme">{{$jumlahk}}</span>
    </a>
    <ul class="dropdown-menu extended inbox">
      <div class="notify-arrow notify-arrow-green"></div>
      <li>
        <p class="green">You have {{$jumlahk}} new messages</p>
      </li>
      <li class="text-center">
        @foreach($dataF as $dF)
          <a href="{{ route('inboxkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">See all messages</a>
        @endforeach
      </li>
    </ul>
  @endif
  
</div>
@endsection