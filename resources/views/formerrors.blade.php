@if(count($errors))
<div class="form-group">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif