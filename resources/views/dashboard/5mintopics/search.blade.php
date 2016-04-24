@extends('layouts.base-admin')
@section('content')
<div id="container">

<div class="row">

@if (count($errors))
@foreach($errors->all() as $err)
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  {{$err}}
</div>
@endforeach

@endif
<!--<div class="panel-group">-->
                    

<div class="row">
<form class="form-horizontal" role="form" method="GET" action="/dashboard/5mintopics/search">
<div class="col-md-4">
@if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">Add New</button>
 @endif

</div>
  <div class="col-md-8" style="padding-bottom:10px;">
  <!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="input-group">
          @if ($search != '')
            <input type="text" class="form-control" name="search" id="search" value="{{$search}}" placeholder="Search for a topic...">
           @else
            <input type="text" class="form-control" name="search" id="search" value="" placeholder="Search for a topic...">
           @endif 
            <span class="input-group-btn">
              <button id="btnSubmit" name="btnSubmit" class="btn btn-default">Search</button>
            </span>
          </div>

        </div>
        
        

</form>
</div>
<hr>
<div class="row">
@if ($topics !== 0)
@foreach ($topics as $topic)


<div class="col-md-4" >
<div class="panel panel-default" style="min-height:150px; max-height:150px;">
<div class="panel-heading">
<div class="row">
      
      <div class="col-md-8">
      <h4><a href="/dashboard/5mintopics/view/{{$topic->id}}">{{substr($topic->topic_name, 0, 30)}}...</a></h4>
      
      </div>
     
    <div class="col-md-4">
      
    {{$topic->topic_date}}
    </div>
</div>
    </div>

<div class="panel-body">  {{(substr(strip_tags($topic->topic_text), 0, 90))}}....</div>

    
               
</div>

</div>


@endforeach
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-5 col-sm-8 col-sm-offset-1 col-xs-offset-3">{!! $topics->appends(['_token' => csrf_token()])->appends(['search' => $search])->render() !!}</div>
</div>

@else
<h3>Your search did not produce any results.</h3>
@endif
</div>
 

</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Topic</h4>
      </div>

      <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/5mintopics/create">
<fieldset>
      <div class="modal-body">

      
<!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="document_category" value="schedule">

<!-- Select Basic -->

 <div class="form-group">
  <label class="col-md-2 control-label" for="fax_number">Topic Name:</label>  
  <div class="col-md-10">
  <input id="fax_number" name="topic_name" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="fax_number">Topic Text:</label> 
  <div class="col-md-10">
<textarea type="hidden" class="form-control input-md" name="topic_text" id='topic_text' rows="7"></textarea>

</div>
</div>



<div class="form-group">
  <label class="col-md-2 control-label" for="fax_number">Topic Tags:</label>  
  <div class="col-md-10">
  <input id="topic_tags" name="topic_tags" value="" class="form-control input-md" type="text">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="topic_category">Topic Category:</label>
  <div class="col-md-10">
    <select id="topic_category" name="topic_category" class="form-control">
    
        <option value="Alpha" >Alpha</option>
  
      <option value="Park">Park</option>
     
      <option value="Customer Service">Customer Service</option>

      <option value="Client Services">Client Services</option>
    
      <option value="Reports">Reports</option>
   
      <option value="All">All</option>
  
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-2 control-label" for="file">Attachments:<br> (Max 20)</label>
<div class="col-md-4">
    <input type="file" name="file[]" class="input-file" id="file[]" multiple="true">
 </div>
</div>

<div class="col-md-8 col-md-offset-6">

        </div>


    </div>

<div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <input class="btn btn-default btn-sm" type="submit" value="Submit">
      </div>
</fieldset>
</form>
  </div>
</div>
</div>
@stop