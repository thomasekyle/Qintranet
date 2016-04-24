@extends('layouts.base-admin')
@section('content')
<div id="container">
  <div id="row">
    <h1> Profile Settings </h1>
    <hr>
       

<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/profile/update/{{ $user->id }}">
          <fieldset>

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="panel-group">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Picture</div>
        <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
            <a href="#" class="thumbnail"><img src="/img/user.png" alt="..." width="250px" height="100%"></a>
              
              </div>
        </div>
        
          <!-- Form Name -->

          <!-- Text input-->
          
             
            
       

          <!-- File Button --> 
          <div class="form-group">
            <label class="col-md-4 control-label" for="file">Select a Picture</label>
            <div class="col-md-4">
              <input id="file" name="file" class="file" type="file">
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


           


          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="active">Active:</label>
            <div class="col-md-8">
              <select id="active" name="active" class="form-control">
                  <option selected="selected">{{$user->active}}</option>
                <option value="Active">Active</option>
                <option value="Not Active">Not Active</option>
              </select>
            </div>
          </div>


          <!-- Select Basic -->
          @if ($user->privlege == 'Administrator')
          <div class="form-group">
            <label class="col-md-4 control-label" for="privilege">Type of User:</label>
            <div class="col-md-8">
              <select id="privilege" name="privilege" class="form-control">
                  <option selected="selected">{{$user->privilege}}</option>
                <option value="Nomral User">Normal User</option>
                <option value="Administrator">Administrator</option>
              </select>
            </div>
          </div>
          @endif

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="fname">Email:</label>  
            <div class="col-md-8">
            <input id="email" name="email" value="{{$user -> email}}" class="form-control input-md" type="text">
              
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="fname">First Name:</label>  
            <div class="col-md-8">
            <input id="fname" name="fname" value="{{$user -> fname}}" class="form-control input-md" type="text">
              
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="lname">Last Name:</label>  
            <div class="col-md-8">
            <input id="lname" name="lname" value="{{$user -> lname}}" class="form-control input-md" type="text">
              
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="phone_number">Phone  Number:</label>  
            <div class="col-md-8">
            <input id="phone_number" name="phone_number" value="{{$user -> phone_number}}" class="form-control input-md" type="text">
              
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="fax_number">Fax Number</label>  
            <div class="col-md-8">
            <input id="fax_number" name="fax_number" value="{{$user -> fax_number}}" class="form-control input-md" type="text">
              
            </div>
          </div>

          <!-- Textarea -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="description">Profile Information:</label>
            <div class="col-md-8">                     
              <textarea class="form-control" id="description" name="description">{{$user -> description}}</textarea>
            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <label class="col-md-8 control-label" for="btnSubmit"></label>
            <div class="col-md-2">
              <button id="btnSubmit" name="btnSubmit" class="btn btn-primary">Submit</button>
            </div>
          </div> 
          
        
        </div>
      </div>
    </div>

</div>
</div>
      
    </fieldset>
          </form>

          
  </div><!-- End row -->
</div><!-- End container -->
@stop