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


@if (!empty($success))
<div class="alert alert-success" role="success" id="success-alert">
<span class="close" data-dimiss="alert" aria-label="close">&times;</span>
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  
  <span class="sr-only">Success:</span>
  {{$success}}
</div>
<hr>
@endif

<div class="row">


<!--<div class="panel-group">-->
<div class="col-md-6">
<div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9">
                                         <div class="huge"><h4>Helpful Documents</h4></div>
                                        <div class="huge">All documents are available in PDF format</div>
                 
                                    </div>
                                    <div class="col-xs-3 text-right">
                                       @if ($user->privilege == 'Administrator' || $user->privilege == 'Human Resources' || $user->privilege == 'Director of Operations')
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Upload</button>
                  @endif
                                        
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-body">
                                @if ($schedule_current_week !== null)
                                    <span class="pull-left">Current Week - <a href="/uploads/documents/{{rawurlencode($schedule_current_week->document_true_name)}}" target="_blank">{{$schedule_current_week -> document_name}}</a></span>
                                @endif
                                @if ($schedule_next_week !== null)   
                                    <span class="pull-left">Next Week - <a href="/uploads/documents/{{rawurlencode($schedule_next_week->document_true_name)}}" target="_blank">{{$schedule_next_week -> document_name}}</a></span>
                                @endif
                                @if ($phone_list !== null )
                                    <span class="pull-left">Phone List - <a href="/uploads/documents/{{rawurlencode($phone_list->document_true_name)}}" target="_blank">{{$phone_list -> document_name}}</a></span>
                                @endif
                                @if ($emergencies !== null) 
                                    <span class="pull-left">Emergencies - <a href="/uploads/documents/{{rawurlencode($emergencies->document_true_name)}}" target="_blank">{{$emergencies -> document_name}}</a></span>
                                @endif
                                @if ($pay_dates !== null)
                                    <span class="pull-left">Pay Dates and Holidays - <a href="/uploads/documents/{{rawurlencode($pay_dates->document_true_name)}}" target="_blank">{{$pay_dates -> document_name}}</a></span>
                                @endif
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  
                                </div>
                            
                        </div>
</div>
<div class="col-md-6">
<div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <div class="huge"><h4>{{$user->fname}} {{$user->lname}}</h4></div>
                                        <div><b>{{$user->privilege}}</b></div>
                                    </div>
                                    <div class="col-xs-3 text-right">
                                        
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-body">
                                    <span class="pull-left">Weclome Back! Your last login was at {{$user->updated_at}}.</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            
                        </div>
                        </div>

</div>

 <form class="form-horizontal" role="form" method="GET" action="/dashboard/posts/search">
<div class="col-md-4">
@if ($user->privilege == 'Administrator')
  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm2">Post Announcement</button>
 @endif

</div>
  <div class="col-md-8" style="padding-bottom:10px;">
  <!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="input-group">
          @if ($search != '')
            <input type="text" class="form-control" name="search" id="search" value="{{$search}}" placeholder="Search for a document...">
           @else
            <input type="text" class="form-control" name="search" id="search" value="" placeholder="Search for a document...">
           @endif 
            <span class="input-group-btn">
              <button id="btnSubmit" name="btnSubmit" class="btn btn-default" type="submit">Search</button>
            </span>
          </div>

        </div>
<hr>
@if ($posts !== 0)
@forelse ($posts as $post)
<div class="col-md-12">
<div class="panel panel-info">
<div class="panel-heading">
 @if ($user->privilege == 'Administrator')
    <a href="/dashboard/posts/delete/{{$post->id}}" class="close" onclick="return confirm('Are you sure you want to delete this post?')" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></a>
    <a href="/dashboard/posts/edit/{{$post->id}}" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-pencil"></i></span></a>
     @endif
<div class="row">
      
      <div class="col-md-8">
      {{$post->post_name}} - {{$post->post_date}}
      
      </div>
      <div class="col-md-2">
    </div>
    <div class="col-md-2">
      
    
    </div>
   
</div>

    </div>

<div class="panel-body">  {!!html_entity_decode($post->post_content)!!}</div>

    
               
</div>
</div>
@endforeach
<div class="row">
    <div class="col-md-2 col-md-offset-5 col-sm-8 col-sm-offset-1 col-xs-offset-3">{!! $posts->render() !!}</div>
</div>
@endif
 </div>
</div>



<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/documents/upload">
        <fieldset>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="dcat" value="schedule">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload a document</h4>
      </div>

      

      <div class="modal-body">

      
<!-- Form Name -->


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="type">Type:</label>
  <div class="col-md-8">
    <select id="document_tags" name="document_tags" class="form-control">
        <option value="Current Week" selected="selected">Schedule - Current Week</option>
      <option value="Next Week">Schedule - Next Week</option>
      <option value="Phone List">Phone List</option>
      <option value="Emergencies">Emergencies Document</option>
      <option value="Pay Dates">Pay Dates</option>

    </select>
  </div>
</div>
<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="file">File:</label>
<div class="col-md-8">
    <input type="file" name="file[]" class="input-file" id="file[]" multiple="true">
</div>
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



<div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
          <h4 class="modal-title" id="myModalLabel">New Post</h4>
      

      </div>

        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/posts/new">

      
      <fieldset>
      <div class="modal-body">
          
          <!-- Form Name -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          

          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="post_name">Post Name:</label>  
              <div class="col-md-10">
                <input id="post_name" name="post_name" value="" class="form-control input-md" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label" for="post_content">Post Text:</label>  
              <div class="col-md-10">
                <textarea type="hidden" class="form-control input-md" name="post_content" id='post_content' rows="7"></textarea>

              </div>
            </div>
        
        <div class="form-group">
              <label class="col-md-2 control-label" for="post_tags">Post Tags:</label>  
              <div class="col-md-10">
                <input id="post_tags" name="post_tags" value="" class="form-control input-md" type="text">
              </div>
            </div>
        

<div class="form-group">
  <label class="col-md-2 control-label" for="pcat">Post Category:</label>
  <div class="col-md-10">
    <select id="pcat" name="pcat" class="form-control">
      <option value="Alpha" >Alpha</option>
      <option value="Park">Park</option>
      <option value="Customer Service">Customer Service</option>
      <option value="Client Services">Client Services</option>   
      <option value="Reports">Reports</option>    
      <option value="All">All</option>
        
    </select>
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
