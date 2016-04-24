@extends('layouts.base-admin')
@section('content')
<div id="container">
  <div id="row">
    <h1>Profile</h1>
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
       



<div class="row">
<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/users/update/{{$edituser->id}}">
<fieldset>
<!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">Picture</div>

<div class="panel-body">
<!-- Text input-->
<div class="col-md-12">
            <a href="#" class="thumbnail"><img src="/uploads/user/{{$edituser->id}}/{{$edituser->pic_id}}" alt="..." width="250px" height="100%"></a>
              
              </div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="file"></label>
  <div class="col-md-4">
    <input id="file" name="file" class="input-file" type="file">
  </div>
</div>

</div>
</div>
</div>


<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">User Information</div>


<div class="panel-body">

@if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="active">Active:</label>
  <div class="col-md-8">
    <select id="active" name="active" class="form-control">
        <option selected="selected">{{$edituser->active}}</option>
        @if ($edituser->active != 'Active')
      <option value="Active">Active</option>
      @endif
      @if ($edituser->active != 'Not Active')
      <option value="Not Active">Not Active</option>
      @endif
    </select>
  </div>
</div>


<!-- Select Basic -->

<div class="form-group">
  <label class="col-md-4 control-label" for="privilege">Type of User:</label>
  <div class="col-md-8">
    <select id="privilege" name="privilege" class="form-control">
    <option value="{{$edituser->privilege}}">{{$edituser->privilege}}</option>
    @if ($edituser->privilege != 'Director Of Operations')
      <option value="Director of Operations">Director of Operations</option>
    @endif  
    @if ($edituser->privilege != 'Client Services Manager')
      <option value="Client Services Manager">Client Services Manager</option>
    @endif  
    @if ($edituser->privilege !='Customer Service Specialist')
      <option value="Customer Service Specialist">Customer Service Specialist</option>
    @endif
    @if ($edituser->privilege != 'Reports Specialist')
      <option value="Reports Specialist">Reports Specialist</option>
    @endif
    @if ($edituser->privilege != 'Team Lead')
      <option value="Team Lead">Team Lead</option>
    @endif
    @if ($edituser->privilege != 'Verification Specialist')
      <option value="Verification Specialist">Verification Specialist</option>
    @endif
    @if ($edituser->privilege != 'Billing Coordinator')  
      <option value="Billing Coordinator">Billing Coordinator</option>
    @endif
    @if ($edituser->privilege != 'Administrator')
      <option value="Administrator">Administrator</option>
    @endif
    </select>
  </div>
</div>
@endif

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email Address:</label>  
  <div class="col-md-8">
  <input id="email" name="email" value="{{$edituser -> email}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Old Password:</label>
  <div class="col-md-8">
    <a href="/password/email" class="btn btn-default">Reset Password</a>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fname">Firsrt Name:</label>  
  <div class="col-md-8">
  <input id="fname" name="fname" value="{{$edituser -> fname}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lname">Last Name:</label>  
  <div class="col-md-8">
  <input id="lname" name="lname" value="{{$edituser -> lname}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone_number">Phone umber:</label>  
  <div class="col-md-8">
  <input id="phone_number" name="phone_number" value="{{$edituser -> phone_number}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fax_number">Fax Number</label>  
  <div class="col-md-8">
  <input id="fax_number" name="fax_number" value="{{$edituser -> fax_number}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Profile Information:</label>
  <div class="col-md-8">                     
    <textarea class="form-control" id="description" name="description">{{$edituser -> description}}</textarea>
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
    <button id="btnSubmit" name="btnSubmit" class="btn btn-default">Submit</button>
    <a href="/dashboard/home" class="btn btn-default" role="button">Cancel</a>
  </div>
</div>
</fieldset>
</form>
</div>


           
  </div><!-- End row -->
</div><!-- End container -->
@stop