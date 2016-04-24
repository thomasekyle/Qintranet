@extends('layouts.base-admin')
@section('content')
<div id="container">

<div class="row">


<!--<div class="panel-group">-->
                    
    @if (count($errors))
@foreach($errors->all() as $err)
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  {{$err}}
</div>
@endforeach
<br><br>
@endif
<div class="row">
<form class="form-horizontal" role="form" method="GET" action="/dashboard/5mintopics/search">
 <div class="col-md-4">
  <a class="btn btn-default" href="javascript:history.back()">Back</a>
  @if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">Edit</button>

  <a href="/dashboard/5mintopics/delete/{{$topic->id}}" class="btn btn-default">Delete</a>
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

        </div></div>
        

</form>

@if ($topic !== 0)
<div class="col-md-12">
<div class="panel panel-info">
<div class="panel-heading">
<div class="row">
      
      <div class="col-md-8">
      <h4>{{$topic->topic_name}}</h4>
      
      </div>
     
    <div class="col-md-2 col-md-offset-2">
      
    <h4>{{$topic->topic_date}}</h4>
    </div>
</div>
    </div>

<div class="panel-body">  {!!html_entity_decode($topic->topic_text)!!}.</div>

    
    <div class="panel-footer">Topic Tags: {{$topic->topic_tags}}</div>           
</div>

<table class="table table-striped task-table">
<th>
Attachments
</th>

@foreach ($attachments as $attachment)



<tr>
<td>
<div class="col-md-10 col-xs-10"><a href="/uploads/attachments/{{$attachment->attachment_true_name}}" target="_blank">{{$attachment->attachment_name}}</a></div>
@if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
<div class="col-md-2 col-xs-2"><a href="/dashboard/attachments/delete/{{$attachment->id}}" class="btn btn-danger btn-sm">Delete</a></div>
@endif

</td>

</tr>



@endforeach
</table>

</div>
@endif
 </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Topic</h4>
      </div>

      <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/5mintopics/update/{{$topic->id}}">
<fieldset>
      <div class="modal-body">

      
<!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<!-- Select Basic -->

  <div class="form-group">
  <label class="col-md-2 control-label" for="topic_name">Topic Name:</label>  
  <div class="col-md-10">
  <input id="topic_name" name="topic_name" value="{{$topic->topic_name}}" class="form-control input-md" type="text">
    
  </div>
</div>

<div class="form-group">
<label class="col-md-2 control-label" for="Text Area">Topic Text:</label>
<div class="col-md-10">

<textarea type="hidden" class="form-control input-md" name="topic_text" id='topic_text' rows="7">{{$topic->topic_text}}</textarea>




</div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="topic_tags">Topic Tags:</label>  
  <div class="col-md-10">
  <input id="topic_tags" name="topic_tags" value="{{$topic->topic_tags}}" class="form-control input-md" type="text">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="topic_category">Topic Category:</label>
  <div class="col-md-10">
    <select id="topic_category" name="topic_category" class="form-control">
    <option value="{{$topic->topic_category}}" selected>{{$topic->topic_category}}</option>

      @if($topic->topic_category != 'alpha')
        <option value="Alpha" >Alpha</option>
      @endif
      @if($topic->topic_category != 'park')
      <option value="Park">Park</option>
      @endif
      @if($topic->topic_category != 'customer service')
      <option value="Customer Service">Customer Service</option>
      @endif
      @if($topic->topic_category != 'client services')
      <option value="Client Services">Client Services</option>
      @endif
      @if($topic->topic_category != 'reports')
      <option value="Reports">Reports</option>
      @endif
      @if($topic->topic_category != 'all')
      <option value="All">All</option>
      @endif  
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
        <input class="btn btn-default btn-sm" type="submit" name="save" id="save" onlick="$('#topic_text').val(editor.getHTML());" value="Submit">
      </div>
</fieldset>
</form>
  </div>
</div>
</div>
@stop