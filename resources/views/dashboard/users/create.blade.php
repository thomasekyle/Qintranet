@extends('layouts.base-admin')
@section('content')
<div id="container">
  <div id="row">
    <h1>Add User</h1>
    <hr>
    @if (count($errors))
@foreach($errors->all() as $err)
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  {{$err}}
</div>
@endforeach
<hr>
@endif
       

<form class="form-horizontal" role="form" method="POST" action="/dashboard/users/store">
<fieldset>

<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">Picture</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
            <a href="#" class="thumbnail"><img src="/img/user.png" alt="..." width="250px" height="100%"></a>
              
              </div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filPicture"></label>
  <div class="col-md-4">
    <input id="filPicture" name="filPicture" class="input-file" type="file">
  </div>
</div>


</div>
</div>
</div>
</div>


<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">User Information</div>
<div class="panel-body">


<!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

@if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="active">Active:</label>
  <div class="col-md-4">
    <select id="active" name="active" class="form-control">
      <option value="Active">Active</option>
      <option value="Not Active">Not Active</option>
    </select>
  </div>
</div>


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="privilege">Type of User:</label>
  <div class="col-md-8">
    <select id="privilege" name="privilege" class="form-control">
      <option value="Director of Operations">Director of Operations</option>
      <option value="Client Services Manager">Client Services Manager</option>
      <option value="Customer Service Specialist">Customer Service Specialist</option>
      <option value="Reports Specialist">Reports Specialist</option>
      <option value="Team Lead">Team Lead</option>
      <option value="Verification Specialist">Verification Specialist</option>
      <option value="Billing Coordinator">Billing Coordinator</option>
      <option value="Human Resources">Human Resources</option>
      <option value="Administrator">Administrator</option>
    </select>
  </div>
</div>
@endif

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email Address:</label>  
  <div class="col-md-8">
  <input id="email" name="email" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password:</label>
  <div class="col-md-8">
    <input id="password" name="password" value="" class="form-control input-md" type="password">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password_confirmation">Password (Repeated):</label>
  <div class="col-md-8">
    <input id="password_confirmation" name="password_confirmation" value="" class="form-control input-md" type="password">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fname">Firsrt Name:</label>  
  <div class="col-md-8">
  <input id="fname" name="fname" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lname">Last Name:</label>  
  <div class="col-md-8">
  <input id="lname" name="lname" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="birthday">Birthday:</label>  
  <div class="col-md-8">
  <input id="birthday" name="birthday" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone_number">Phone  Number:</label>  
  <div class="col-md-8">
  <input id="phone_number" name="phone_number" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fax_number">Fax Number</label>  
  <div class="col-md-8">
  <input id="fax_number" name="fax_number" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Profile Information:</label>
  <div class="col-md-8">                     
    <textarea class="form-control" id="description" name="description"></textarea>
  </div>
</div>


</div>
</div>
</div>
</div>
<hr>
  <!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnSubmit"></label>
  <div class="col-md-8 col-md-offset-10">
    <button id="btnSubmit" name="btnSubmit" class="btn btn-primary">Submit</button>
    <a href="/dashboard/users" class="btn btn-danger" role="button">Cancel</a>
  </div>
</div>

</fieldset>
</form>         
  </div><!-- End row -->
</div><!-- End container -->
@stop