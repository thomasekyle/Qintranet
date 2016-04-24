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
<!--<div class="panel-group">-->


 <div class="row">
<form class="form-horizontal" role="form" method="GET" action="/dashboard/documents/search">
<div class="col-md-4">
@if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">Upload Document</button>
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
        
        

</form>
</div>

<hr>
<div class="row">

@if (!($documents->isEmpty()))
@foreach ($documents as $document)

<div class="col-md-6">
<div class="panel panel-info" >
<div class="panel-heading">
<div class="row">
      
      <div class="col-md-10">
      @if ($document->document_extension == 'pdf')
      <i class=" fa fa-file-pdf-o"></i>
      @elseif ($document->document_extension == 'doc' || $document->document_extension == 'docx')
      <i class=" fa fa-file-word-o"></i>
      @else
      <i class=" fa fa-file-o"></i>
      @endif
      <a href="/uploads/documents/{{$document->document_true_name}}" target="_blank">{{substr($document->document_name, 0, 60)}}</a>
      </div>
     
    <div class="col-md-2">
      
   

    
    @if ($user->privilege == 'Administrator' || $user->privilege == 'Team Lead' ||  $user->privilege == 'Client Services Manager' )
    <a href="/dashboard/documents/delete/{{$document->id}}" class="close" onclick="return confirm('Are you sure you want to delete this document?')" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></a>
    <a href="/dashboard/documents/edit/{{$document->id}}" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-pencil"></i></span></a>
     @endif
    </div>
</div>
    </div>

<div class="panel-footer">  {!!html_entity_decode(substr(strip_tags($document->document_text), 0, 90))!!}....</div>

              
</div>

</div>

@endforeach
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-5 col-sm-8 col-sm-offset-1 col-xs-offset-3">{!! $documents->appends(['_token' => csrf_token()])->appends(['search' => $search])->render() !!}</div>
</div>
@else
<div class="alert alert-info" role="alert">
  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
  <span class="sr-only">Alert:</span>
  There don't seem to be any documents here.
</div>
<hr>
@endif



<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
          <h4 class="modal-title" id="myModalLabel">Upload a document</h4>
      

      </div>

        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/documents/upload">

      
      <fieldset>
      <div class="modal-body">
          
          <!-- Form Name -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          

          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="documents_tags">Document Tags:</label>  
              <div class="col-md-10">
                <input id="document_tags" name="document_tags" value="" class="form-control input-md" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label" for="documents_text">Document Text:</label>  
              <div class="col-md-10">
                <input id="document_text" name="document_text" value="" class="form-control input-md" type="text">
              </div>
            </div>
        
        

<div class="form-group">
  <label class="col-md-2 control-label" for="dcat">Document Category:</label>
  <div class="col-md-10">
    <select id="dcat" name="dcat" class="form-control">
      <option value="Alpha" >Alpha</option>
      <option value="Park">Park</option>
      <option value="Customer Service">Customer Service</option>
      <option value="Client Services">Client Services</option>   
      <option value="Reports">Reports</option>    
      <option value="All">All</option>
        
    </select>
  </div>
</div>



<div class="form-group">
  <label class="col-md-4 control-label" for="file">Documents</label>
<div class="col-md-8">
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