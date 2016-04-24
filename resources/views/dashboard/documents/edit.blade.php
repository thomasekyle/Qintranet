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

<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="/dashboard/documents/update/{{$document->id}}">
<div class="panel panel-info">
<div class="panel-heading">Editing a document - {{$document->document_name}}</div>
<div class="panel-body">
<!-- Form Name -->


          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="document_text">Document Text:</label>  
              <div class="col-md-8">
                <input id="document_text" name="document_text" value="{{$document->document_text}}" class="form-control input-md" type="text">
              </div>
            </div>


          <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-2 control-label" for="documents_tags">Document Tags:</label>  
              <div class="col-md-8">
                <input id="document_tags" name="document_tags" value="{{$document->document_tags}}" class="form-control input-md" type="text">
              </div>
            </div>


<div class="form-group">
  <label class="col-md-2 control-label" for="dcat">Document Category:</label>
  <div class="col-md-8">
    <select id="dcat" name="dcat" class="form-control">
    <option value="{{$document->document_category}}" selected>{{$document->document_category}}</option>

      @if($document->document_category != 'Alpha')
        <option value="Alpha" >Alpha</option>
      @endif
      @if($document->document_category != 'Park')
      <option value="Park">Park</option>
      @endif
      @if($document->document_category != 'Customer Service')
      <option value="Customer Service">Customer Service</option>
      @endif
      @if($document->document_category != 'Client Services')
      <option value="Client Services">Client Services</option>
      @endif
      @if($document->document_category != 'Reports')
      <option value="Reports">Reports</option>
      @endif
      @if($document->document_category != 'All')
      <option value="All">All</option>
      @endif  
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="file">Document:(Currently stored - {{$document->document_name}})</label>
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