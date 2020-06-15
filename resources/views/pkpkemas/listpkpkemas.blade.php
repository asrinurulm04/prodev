@extends('pv.tempvv')

@section('title', 'List PKP')

@section('judulhalaman','Data PKP')

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>List PKP</h2>
    <div class="card-block">
      <div class="clearfix"></div>
      <div class="x_content" style="overflow-x: scroll;">
      <table class="table table-striped no-border">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>#</th>
            <th>PKP Number</th>
            <th>Project Name</th>
            <th>Author</th>
            <th class="text-center">Date</th>
            <th width="">Tujuan Kirim</th>
            <th width="11%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection