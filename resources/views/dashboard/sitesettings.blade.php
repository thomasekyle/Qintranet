@extends('layouts.base-admin')
@section('content')
<div id="container">
  <div id="row">
    <h1> Site Settings </h1>
    <hr>

<!-- If any errors are found in input -->
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

<form class="form-horizontal" role="form" method="POST" action="/dashboard/sitesettings/update/{{$sitesettings->id}}">

<div class="row">
       

<!-- Form Name -->

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">Address Information</div>
<div class="panel-body">

<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_name">Company Name:</label>  
  <div class="col-md-8">
  <input id="company_name" name="company_name" value="{{$sitesettings -> company_name}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_street_number">Street Number:</label>  
  <div class="col-md-8">
  <input id="company_street_number" name="company_street_number" value="{{$sitesettings -> company_street_number}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_street_name">Street Name:</label>  
  <div class="col-md-8">
  <input id="company_street_name" name="company_street_name" value="{{$sitesettings -> company_street_name}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_city">City:</label>  
  <div class="col-md-8">
  <input id="company_city" name="company_city" value="{{$sitesettings -> company_city}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_state">State:</label>  
  <div class="col-md-8">
  <input id="company_state" name="company_state" value="{{$sitesettings -> company_state}}" class="form-control input-md" type="text">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_zip">Zip Code:</label>  
  <div class="col-md-8">
  <input id="company_zip" name="company_zip" value="{{$sitesettings -> company_zip}}" class="form-control input-md" type="text">
    
  </div>
</div>
</fieldset>
</div>

</div>
</div>


<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">Contact Information</div>
<div class="panel-body">

<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_phone_number">Phone Number</label>  
  <div class="col-md-8">
  <input id="company_phone_number" name="company_phone_number" value="{{$sitesettings -> company_phone_number}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_fax_number">Fax Number:</label>  
  <div class="col-md-8">
  <input id="company_fax_number" name="company_fax_number" value="{{$sitesettings -> company_fax_number}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company_email">Email Address</label>  
  <div class="col-md-8">
  <input id="company_email" name="company_email" value="{{$sitesettings -> email}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="http_link">Facebook Link:</label>  
  <div class="col-md-8">
  <input id="http_link" name="http_link" value="{{$sitesettings -> http_link}}" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="http_link2">Twitter Link</label>  
  <div class="col-md-8">
  <input id="http_link2" name="http_link2" value="{{$sitesettings -> http_link2}}" class="form-control input-md" type="text">
    
  </div>
</div>



</fieldset>
</div>

</div>
</div>
<!-- Button -->


</div>
<hr>
<div class="row">
<div class="col-md-6 col-md-offset-5"><div class="form-group">
  <label class="col-md-10 control-label" for="btnSubmit"></label>
  <div class="col-md-2">
    <button id="btnSubmit" name="btnSubmit" class="btn btn-primary">Submit</button>
  </div>
</div></div>
</div>
           </form>
  </div><!-- End row -->
</div><!-- End container -->
@stop