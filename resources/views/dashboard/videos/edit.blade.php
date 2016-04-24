@extends('layouts.base-admin')
@section('content')
<div id="container">
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

@if (!empty($success))
<div class="alert alert-success" role="success">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Success:</span>
  {{$success}}
</div>
<hr>
@endif

<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/videos/update/{{$video->id}}">
<div class="panel panel-info">
<div class="panel-heading">Editing a video - {{$video->video_name}}</div>
<div class="panel-body">
<!-- Form Name -->


          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="video_text">Video Text:</label>  
              <div class="col-md-8">
                <input id="video_text" name="video_text" value="{{$video->video_text}}" class="form-control input-md" type="text">
              </div>
            </div>


          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="videos_tags">Video Tags:</label>  
              <div class="col-md-8">
                <input id="video_tags" name="video_tags" value="{{$video->video_tags}}" class="form-control input-md" type="text">
              </div>
            </div>


<div class="form-group">
  <label class="col-md-2 control-label" for="vcat">Video Category:</label>
  <div class="col-md-8">
    <select id="vcat" name="vcat" class="form-control">
    <option value="{{$video->video_category}}" selected>{{$video->video_category}}</option>

      @if($video->video_category != 'Alpha')
        <option value="Alpha" >Alpha</option>
      @endif
      @if($video->video_category != 'Park')
      <option value="Park">Park</option>
      @endif
      @if($video->video_category != 'Customer Service')
      <option value="Customer Service">Customer Service</option>
      @endif
      @if($video->video_category != 'Client Services')
      <option value="Client Services">Client Services</option>
      @endif
      @if($video->video_category != 'Reports')
      <option value="Reports">Reports</option>
      @endif
      @if($video->video_category != 'All')
      <option value="All">All</option>
      @endif  
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="file">Video:(Currently stored - {{$video->video_name}})</label>
<div class="col-md-8">
    <input type="file" name="file" class="input-file" id="file">
 </div>
</div>

</div>


</div>

<div class="col-md-2 pull-right">
        <a class="btn btn-default btn-sm" href="javascript:history.back()">Back</a>
        <input class="btn btn-default btn-sm" type="submit" value="Submit">
     </div>

</form>
</div>
@stop