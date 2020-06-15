@extends('formula.tempformula')

<style>

  input[type="number"]{
    background: transparent !important;
    border: none;
    outline: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -moz-appearance:textfield;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
  }

  .mini{
    width: 6%;
    height: 8px !important;
    font-size: 12px !important;
    vertical-align: middle !important;
  }

  .batch{
    width: 6%;
    text-align: center !important;
    vertical-align: bottom !important;
  }

  .ib{
    font-size: 12px !important;
  }

  .namaBahan{
    width: 15%;
    vertical-align: bottom !important;
    
  }

  .su{
    width: 6%;
    text-align: center !important;
    vertical-align: bottom !important;
  }

  #myTable{
    font-size: 12px;
  }

  .turunan{
    font-size: 12px !important;
    color: black !important;
    height: 10px !important;
    width: 50px !important;
  }

  .trtur{
    background-color: #4ecdc4;
    color:white;
    font-size:16px;
  }
</style>

@section('title', 'Edit Formula')
@section('content')

<div class="row">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="{{ route('step2',$idf) }}"><span class="nmbr">1</span>Penyusunan</a></li>
        <li class="active"><a href="{{ route('summarry',$idf) }}"><span class="nmbr">2</span>Summary</a></li>
        <li class="completed"><a href="{{ route('step3',$idf) }}"><span class="nmbr">3</span>Premix</a></li>
        <li class="active"><a href="{{ route('panel',$idf) }}"><span class="nmbr">4</span>Data Panel</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"> Premix</h3>
  </div>                 
  <div class="col-md-4">
    <input type="hidden" id="c_premix" name="c_premix">          
    <button type="button" class="btn reset btn-warning" onClick="GueReset()" id="reset">Reset</button>
    <button type="submit" class="btn status btn-primary" onClick="hmm()">Save and continue</button>        
    <a href="{{ route('showworkbook',$formula->workbook_id) }}" type="button" class="btn hapus btn-danger">Batal</a>
  </div><br>
  <table class="table" style="border:2px" id="myTable">
    @php
      for($s=1;$s<=10;$s++){ $showturunan[$s]=collect(); }
    @endphp
    <thead>
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <th style="vertical-align: bottom !important;">No</th>
        <th class="namaBahan">Bahan Baku</th>
        <th class="batch">Batch</th>
        <th class="su">Sisa Utuh</th>
        <th></th>
        <th class="su">Sisa_Koma</th>
        <th class="mini">ke-1</th>
        <th class="mini">ke-2</th>
        <th class="mini">ke-3</th>
        <th class="mini">ke-4</th>
        <th class="mini">ke-5</th>
        <th class="mini">ke-6</th>
        <th class="mini">ke-7</th>
        <th class="mini">ke-8</th>
        <th class="mini">ke-9</th>
        <th class="mini">ke-10</th>
      </tr>
    </thead>
    @foreach($fortails as $fortail)
      @foreach ($fortail->premix as $premix)
        <tr>
          <td>{{ ++$no }}
            <input type="hidden" name="prid[{{$no}}]" value="{{ $premix->id }}">
          </td>
                                
          @if($fortail->premix->count() == 1)
          <td>{{ $fortail->nama_sederhana }}</td>
          @elseif($fortail->premix->count() > 1)
          <td>{{ substr($premix->keterangan,5) }}</td>
          @endif
          <td>
            <input type="number" class="form-control col-md-1 col-xs-12 ib" value="{{ $fortail->per_batch }}" id="batch{{ $no }}" disabled>
          </td>
          <td class="text-center">
            <input type="number" class="form-control col-md-1 col-xs-12" id="utuh{{ $no }}" value="{{ $premix->utuh }}" disabled>
          </td>
          <td class="text-center">
            <i id="loncat{{ $no }}" onClick="kanan(this.id)" class="fa fa-arrow-circle-right"></i>
            <i id="byur{{ $no }}" onClick="byur(this.id)" class="fa fa-rotate-right"></i>
            <i id="mundur{{ $no }}" onClick="kiri(this.id)" class="fa fa-arrow-circle-left"></i>
          </td>
          <td class="text-center">
            <input type="number" class="form-control col-md-1 col-xs-12" value="{{ $premix->koma }}" id="koma{{ $no }}" disabled>    
            <input class="form-control col-md-1 col-xs-12" type="hidden" value="{{ $premix->koma }}" id="komatetap{{ $no }}" disabled>    
          </td>
                                
          {{-- Inisialisasi Kebutuhan --}}
          @php
            for($y=1;$y<=10;$y++){ $total[$y]=0; }
          @endphp
          {{-- Muncul Premix Dan Show Turunan --}}
          @for ($x = 1; $x <=10; $x++)
                                    
            @foreach ($premix->pretail->where('awalan',$x) as $pretail)
              @php
                $total[$x] = $total[$x]+$pretail->jumlah;
              @endphp
            @endforeach

            @php
              $push = $premix->pretail->where('awalan',$x)->count();
              $showturunan[$x]->push($push);
            @endphp

            @if ($total[$x] == 0)
              @php
                $total[$x] = null;
              @endphp
            @endif

            <td> <input onkeyup="ke(this.id)" class="form-control col-md-1 col-xs-12" type="number" step="any" id="ke{{ $x }}{{ $no }}" name="ke[{{ $x }}][{{ $no }}]" placeholder="0" value="{{ $total[$x] }}" min="0"></td>                                                                    
          @endfor                                

          <input type="hidden" id="berat{{ $no }}" value="{{ $premix->berat }}">
          <input type="hidden" id="resetUtuh{{ $no }}" name="resetUtuh[{{ $no }}]" value=" {{ $premix->utuh }} ">
          <input type="hidden" id="resetKoma{{ $no }}" name="resetKoma[{{ $no }}]" value=" {{ $premix->koma }} ">
          <input type="hidden" id="utuhCpb{{ $no }}" name="utuh_cpb[{{ $no }}]">
          <input type="hidden" id="komaCpb{{ $no }}" name="koma_cpb[{{ $no }}]">
          <input type="hidden" id="cpretail{{ $no }}" name="c_pretail[{{ $no }}]" value="0">
        </tr>
      @endforeach
    @endforeach

    <tr class="trtur">
      <th colspan="6">TURUNAN</th>
      @for ($z = 1 ; $z <=10; $z++)
      <th class="mini"><input type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' step="1" min="1" class="form-control turunan" id="turunan{{ $z }}" name="turunan[{{ $z }}]"  placeholder="0" @if($showturunan[$z]->max() > 0 )value="{{ $showturunan[$z]->max() }}" @endif></th>
      @endfor
    </tr>    
  </table>
  </form>
</div>

@endsection

@section('s')
    <script type="text/javascript">
        $(document).ready(function(){
            var ih = {{ $no }};

            if(ih<1){
                $('#turtif').notify("Bahan Baku Kosong", "error");
            }

            $('#c_premix').val(ih);
            var i;
            for(i = 1 ; i <= ih ; i++){
                var batch   = parseFloat($('#batch'+i).val());
                var kb      = batch/1000;                
                var berat   = parseFloat($("#berat"+i).val());

                var tpremix = 0;
                    for(ii=1 ; ii <= 10 ; ii++){
                        cek = $('#ke'+ii+i).val();
                            if(cek == ''){
                                cek = 0;
                            }
                        var ke = parseFloat(cek);
                        tpremix = tpremix + ke;
                    }                
                // Hitung Utuh dan Koma ( Buat Tampil Doang Da)
                if(tpremix == 0){
                    var utuh = parseFloat($('#resetUtuh'+i).val());
                    var koma = parseFloat($('#resetKoma'+i).val());
                    $('#utuh'+i).val(utuh);
                    $('#koma'+i).val(koma);
                    $('#komatetap'+i).val(koma)
                }
                else if(tpremix > 0){
                    var sisa = kb - tpremix;
                    var utuh = Math.floor(sisa/berat);
                    var koma = (sisa % berat);
                    $("#utuh"+i).val(utuh);
                    $("#koma"+i).val(koma);

                    // Hitung komatetap
                    var resetUtuh = parseFloat($('#resetUtuh'+i).val());
                    var resetKoma = parseFloat($('#resetKoma'+i).val());
                    var myUtuh = resetUtuh - utuh;
                    var myKoma = myUtuh * berat;
                    var komatetap = myKoma + resetKoma;
                    $('#komatetap'+i).val(komatetap);
                }

            }
        });      

    function GueReset(){
            var reset = confirm('Reset Data Premix ?');
            if(reset){
                var ih = {{ $no }};
                $('#c_premix').val(ih);
                var i;
                for(i = 1 ; i <= ih ; i++){
                var utuh = parseFloat($('#resetUtuh'+i).val());
                var koma = parseFloat($('#resetKoma'+i).val());
                $('#utuh'+i).val(utuh);
                $('#koma'+i).val(koma);
                $('#komatetap'+i).val(koma);
                $('#ke1'+i).val('');
                $('#ke2'+i).val('');
                $('#ke3'+i).val('');
                $('#ke4'+i).val('');
                $('#ke5'+i).val('');
                $('#ke6'+i).val('');
                $('#ke7'+i).val('');
                $('#ke8'+i).val('');
                $('#ke9'+i).val('');
                $('#ke10'+i).val('');
                }
                for(y=1;y<=10;y++){
                    $('#turunan'+y).val('');
                }
                console.log(#turunan);
            }            
    }

    function byur(myId){
        i = myId.substring(4);
            var utuh = parseFloat($('#resetUtuh'+i).val());
            var koma = parseFloat($('#resetKoma'+i).val());
            $('#utuh'+i).val(utuh);
            $('#koma'+i).val(koma);
            $('#komatetap'+i).val(koma);
            $('#ke1'+i).val('');
            $('#ke2'+i).val('');
            $('#ke3'+i).val('');
            $('#ke4'+i).val('');
            $('#ke5'+i).val('');
            $('#ke6'+i).val('');
            $('#ke7'+i).val('');
            $('#ke8'+i).val('');
            $('#ke9'+i).val('');
            $('#ke10'+i).val('');            
    }
    
    function kanan(myId){
        i = myId.substring(6);
            var utuh = parseFloat($('#utuh'+i).val());            
            var koma = parseFloat($('#koma'+i).val());
            var berat = parseFloat($('#berat'+i).val());
            var komatetap = parseFloat($('#komatetap'+i).val());
            if(utuh < 1){
                $('#loncat'+i).notify(
                "Sisa Utuh Tidak Mencukupi", "error" ,
                { position:"bottom left" }
                );
            }
            else if(utuh > 0){
                var tUtuh = utuh - 1;
                $('#utuh'+i).val(tUtuh);
                var tkoma = koma + berat;
                $('#koma'+i).val(tkoma);
                var tkomatetap = komatetap + berat;
                $('#komatetap'+i).val(tkomatetap);
            }
            
    }
    function kiri(myId){
        i = myId.substring(6);

            var utuh = parseFloat($('#utuh'+i).val());
            var koma = parseFloat($('#koma'+i).val());
            var berat = parseFloat($('#berat'+i).val());
            var komatetap = parseFloat($('#komatetap'+i).val());

                if(koma < berat){
                    $('#mundur'+i).notify(
                "Sisa Koma Tidak Mencukupi", "error" ,
                { position:"bottom left"}
                );
                }
                else if(koma >= berat){
                    var tUtuh = utuh + 1;
                    $('#utuh'+i).val(tUtuh);            
                    var tKoma = koma - berat;
                    $('#koma'+i).val(tKoma);
                    var tkomatetap = komatetap - berat;
                    $('#komatetap'+i).val(tkomatetap);
                }     
            
                   
    }
    function ke(myId){

        neg = parseFloat($('#'+myId).val());
        if(neg<0){
                $('#'+myId).val('');
                $('#'+myId).notify(
                "Tidak Boleh Negative", "error" ,
                { position:"bottom right" }
                );
        }

        gab = myId.substring(2);
        recheck = gab.substring(0,2);

            if(recheck == '10'){
                ike = gab.substring(0,2);
                i = gab.substring(2);
            }
            else if(recheck != '10'){
                ike = gab.substring(0,1);
                i = gab.substring(1);            
            }
        
            var komatetap = parseFloat($('#komatetap'+i).val());
            var ii;
            var tpremix = 0;
            for(ii=1 ; ii <= 10 ; ii++){
                cek = $('#ke'+ii+i).val();
                    if(cek == ''){
                        cek = 0;
                    }
                var ke = parseFloat(cek);
                tpremix = tpremix + ke;
            }
            var sisa = komatetap - tpremix;

            if(sisa<0){
                tpremix = 0;
                $('#ke'+ike+i).val('');
                $('#ke'+ike+i).notify(
                "Sisa Koma Tidak Mencukupi", "error" ,
                { position:"bottom right" }
                );

                    // Back To 0
                    for(ii=1 ; ii <= 10 ; ii++){
                        if(ii != ike){
                            cek = $('#ke'+ii+i).val();
                            if(cek == ''){
                                cek = 0;
                            }
                            var ke = parseFloat(cek);
                            tpremix = tpremix + ke;
                        }
                    }
                    var sisa = komatetap - tpremix;
                    $('#koma'+i).val(sisa);
            }

            else if(sisa>=0){
                $('#koma'+i).val(sisa);
            }
    }

    function hmm(){

        if(confirm('Simpan Data Premix ?')){

            var ih = parseInt($('#c_premix').val());
            for(i = 1 ; i <= ih ; i++){
                var tpremix = 0;
                var tcpremix = 0;
                for(ii=1 ; ii <= 10 ; ii++){
                    cek = $('#ke'+ii+i).val();
                        if(cek == ''){
                            cek = 0;
                        }
                        else{
                            tcpremix = tcpremix + 1;
                        }
                    var ke  = parseFloat(cek);
                    tpremix = tpremix + ke;
                }
                
                $('#cpretail'+i).val(tcpremix);

                // Hitung Utuh dan Koma CPB
                var berat   = parseFloat($("#berat"+i).val());

                if(tpremix >= berat){
                    var utuh    = Math.floor(tpremix/berat);
                    var koma    = (tpremix % berat);
                    alert(utuh+' & '+koma+' & '+tcpremix);
                    $("#utuhCpb"+i).val(utuh);
                    $("#komaCpb"+i).val(koma);
                }
                else if(tpremix < berat && tpremix > 0){
                    var utuh    = 0
                    var koma    = tpremix;
                    alert(utuh+' & '+koma+' & '+tcpremix);
                    $("#utuhCpb"+i).val(utuh);
                    $("#komaCpb"+i).val(koma);
                }
                else if(tpremix == 0){
                    var utuh    = parseFloat($('#resetUtuh'+i).val());
                    var koma    = parseFloat($('#resetKoma'+i).val());
                    alert(utuh+' & '+koma+' & '+tcpremix);
                    $("#utuhCpb"+i).val(utuh);
                    $("#komaCpb"+i).val(koma);
                }

                
            }

        }
        
    }
    
    </script>
@endsection