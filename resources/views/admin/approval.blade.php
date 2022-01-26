@extends('layout.tempvv')
@section('title', 'PRODEV|Approval')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>  
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-check"> Approval</li></h3>
  </div>
	<div class="card-block">
    <div class="dt-responsive table-responsive">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
        	<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">Nama</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>           
            <th class="text-center">Departement</th>            
            <th class="text-center">Level</th>            
            <th class="text-center">Status</th>           
            <th width="17%" class="text-center">Action</th>           
          </tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					@if($user->status =='sending')
					<tr>
						<td>{{ $user->name}}</td>
						<td>{{ $user->username}}</td>
						<td>{{ $user->email}}</td>
						<td class="text-center">{{ $user->departement->dept}}</td>
						<td class="text-center">{{ $user->role->namaRule}}</td>
						<td class="text-center"><span class="label label-warning">{{$user->status}}</span>     
						</td>
						<td class="text-center">
    					{{csrf_field()}}
    					<button class="btn-sm btn-primary fa fa-check" data-toggle="modal" data-target="#approve{{ $user->id  }}"> Approve</a></button>
							<button class="btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#delete{{ $user->id  }}"> Reject</a></button>
						</td>
            <!-- modal approve-->
            <div class="modal" id="approve{{ $user->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog " role="document">
                <div class="modal-content">
                  <div class="modal-header">                 
                    <h3 class="modal-title" id="exampleModalLabel">Send Messenge
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('/sendEmail',$user->id) }}" novalidate>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">To Email</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="email" class="form-control " readonly value="{{ $user->email }}" type="email" name="email" required>
                      </div>
                    </div>
                    <input type="hidden" value="active" name="status" id="status">
                    <input id="nama" class="form-control" value="{{ $user->Role->namaRule }}" type="hidden" name="role" required>
                    <input id="nama" class="form-control" value="{{ $user->username }}" type="hidden" name="username" required>
                    <input id="nama" class="form-control" value="{{ $user->Departement->dept }}" type="hidden" name="dept" required>
                    <input id="nama" class="form-control" value="{{ $user->name }}" type="hidden" name="nama" required>
			            	<input type="hidden" value="Account Confirmation" class="form-control" id="judul" name="judul"/>
			            	<input type="hidden" id="pesan" name="pesan" value="Akun yang anda buat sudah kami approve, sekarang anda bisa masuk dengan akun yang telah anda buat..">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Send</button>
                      {{ csrf_field() }}
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal approve Selesai -->
            <!-- modal delete-->
            <div class="modal" id="delete{{ $user->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog " role="document">
                <div class="modal-content">
                  <div class="modal-header">                 
                    <h3 class="modal-title" id="exampleModalLabel">Send Messenge
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('/sendEmailreject',$user->id) }}" novalidate>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">To Email</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="email" class="form-control " value="{{ $user->email }}" type="email" name="email" required>
                      </div>
                    </div>
                    <input type="hidden" value="nonactive" name="status" id="status">
                    <input id="nama" class="form-control " value="{{ $user->Role->namaRule }}" type="hidden" name="role" required>
                    <input id="nama" class="form-control " value="{{ $user->username }}" type="hidden" name="username" required>
                    <input id="nama" class="form-control " value="{{ $user->Departement->dept }}" type="hidden" name="dept" required>
                    <input id="nama" class="form-control " value="{{ $user->name }}" type="hidden" name="nama" required>
			            	<input type="hidden" value="Account Confirmation" class="form-control" id="judul" name="judul"/>
			            	<input type="hidden" id="pesan" name="pesan" value="Tapi maaf jika kami tidak dapat menerima akun yang telah anda ajukan, silahkan untuk kembali membuat akun dengan data yang sesuai... :)">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Send</button>
                      {{ csrf_field() }}
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal delete Selesai -->
					</tr>   
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection