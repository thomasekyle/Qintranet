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
<form class="form-horizontal" role="form" method="GET" action="/dashboard/documents/search">
  <div class="col-md-12" style="padding-bottom:10px;">
  <!-- Form Name -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="documents" value="{{ $documents }}">
          <div class="input-group">
          @if ($search != '')
            <input type="text" class="form-control" name="search" id="search" value="{{$search}}" placeholder="Search for a listing...">
           @else
            <input type="text" class="form-control" name="search" id="search" value="" placeholder="Search for a document...">
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
      {{$document->document_name}}
      
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
    {{$document->document_text}}
    </div>
               
    <div class="panel-footer">
    {{$document->document_tags}}
    </div>



</div>
</div>






<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

          <h4 class="modal-title" id="myModalLabel">Edit a document</h4>

      </div>
        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/documents/update/{{$editdocument->id}}">

      <fieldset>
      <div class="modal-body">
          
          <!-- Form Name -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="document_category" value="{{ $document_category }}">

          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="documents_tags">Document Tags:</label>  
              <div class="col-md-10">
                <input id="document_tags" name="document_tags" value="{{$editdocument->document_tags}}" class="form-control input-md" type="text">
              </div>
            </div>


<div class="form-group">
  <label class="col-md-2 control-label" for="dcat">Document Category:</label>
  <div class="col-md-10">
    <select id="dcat" name="dcat" class="form-control">
    <option value="{{$editdocument->document_category}}" selected>{{$editdocument->document_category}}</option>

      @if($editdocument->document_category != 'Alpha')
        <option value="Alpha" >Alpha</option>
      @endif
      @if($editdocument->document_category != 'Park')
      <option value="Park">Park</option>
      @endif
      @if($editdocument->document_category != 'Customer Service')
      <option value="Customer Service">Customer Service</option>
      @endif
      @if($editdocument->document_category != 'Client Services')
      <option value="Client Services">Client Services</option>
      @endif
      @if($editdocument->document_category != 'Reports')
      <option value="Reports">Reports</option>
      @endif
      @if($editdocument->document_category != 'All')
      <option value="All">All</option>
      @endif  
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="file">Document</label>
<div class="col-md-8">
    <input type="file" name="file" class="input-file" id="file">
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