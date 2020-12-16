@extends('pv.tempvv')
@section('title', 'detailuser')
@section('judulhalaman','User Management')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-user"> Edit Data User</li></h3>
  </div>
  <div class="card-block">
    <div id="overview" class="tab-pane active">
      <div class="row">
        <div class="col-md-4 profile-text mt mb centered">
          <div class="right-divider hidden-sm hidden-xs">
            <div class="profile-pic">
              <p  class="text-center"><img src="{{ asset('img/prodev.png') }}" class="img-circle"></p>
            </div>
          </div>
        </div>
        <div class="col-md-8 centered">
          <div class="row">
            <div class="form">
              <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('userupdate',$users->id) }}"><br>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Name</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <input class="form-control" id="name" name="name" placeholder="nama" value="{{ $users->name }}" type="text" minlength="2" autofocus required/>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Username</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <input class="form-control" id="username" name="username" placeholder="username" value="{{ $users->username }}" type="text" minlength="6" maxlength="12" required/>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Email</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <input class="form-control" id="email" name="email" placeholder="E-mail" value="{{ $users->email }}" type="email" required/>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Departement</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <select id="departement" name="departement" class="form-control" >
                    @foreach($depts as $dept)
                    <option value="{{  $dept->id }}"{{ ( $dept->id == $users->departement_id ) ? ' selected' : '' }} >{{ $dept->dept }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Passwoad</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <input class="form-control" id="myInput" name="password" placeholder="password" type="password" minlength="8" required/>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" ></label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <input type="checkbox" onclick="myFunction()">Show Password
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Confirm password</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <input class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm_password" type="password" required/>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Role</label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <select class="form-control" id="role" name="role">
                    @foreach($roles as $role)
                    <option value="{{  $role->id }}"{{ ( $role->id == $users->role_id ) ? ' selected' : '' }}>{{ $role->namaRule }}</option>
                    @endforeach
                  </select>
                </div>
              </div><br>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" ></label>
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <button class="btn btn-info btn-block" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </div><br>
              </div>
              @include('formerrors')
              </form>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>
@endsection