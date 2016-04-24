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
<div class="row">


<!--<div class="panel-group">-->

<div class="col-md-6">
@if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Upload</button>

    @endif

</div>

 <div class="col-md-6 col-md-offset-6">                       

<div class="row">
<form class="form-horizontal" role="form" method="GET" action="/dashboard/videos/search">
  <div class="col-md-12" style="padding-bottom:10px;">
  <!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="videos" value="{{ $videos }}">
          <div class="input-group">
          @if ($search != '')
            <input type="text" class="form-control" name="search" id="search" value="{{$search}}" placeholder="Search for a listing...">
           @else
            <input type="text" class="form-control" name="search" id="search" value="" placeholder="Search for a video...">
           @endif 
            <span class="input-group-btn">
              <button id="btnSubmit" name="btnSubmit"  class="btn btn-default">Search</button>
            </span>
          </div>

        </div>
        </form>
    </div>
    </div>


<div class="col-md-12">
<div class="panel panel-info">
<div class="panel-heading">
<div class="row">
      
      <div class="col-md-6">
      {{$video->video_name}}
      
      </div>
      <div class="col-md-3">
    </div>
    <div class="col-md-3">
       <!-- Small modal -->

    </div>
</div>
    </div>
<!--<div class="panel-body"></div>-->

    <div class="panel-body">
    {{$video->video_text}}
    </div>
               
    <div class="panel-footer">
    {{$video->video_tags}}
    </div>



</div>
</div>






<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

          <h4 class="modal-title" id="myModalLabel">Edit a video</h4>

      </div>
        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/videos/update/{{$editvideo->id}}">

      <fieldset>
      <div class="modal-body">
          
          


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