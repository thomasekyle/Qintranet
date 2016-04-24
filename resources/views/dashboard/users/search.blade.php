@extends('layouts.base-admin')
@section('content')
<div id="container">
<div id="row">

<div class="row">
<div class="col-md-2">

</div>
<div class="col-md-6">
<div  style="margin: 30px 0px 0px 0px; width: 50%;">

</div>
</div>
<form class="form-horizontal" role="form" method="GET" action="/dashboard/users/search">
  <div class="col-md-4" style="padding-bottom:10px;">
    <div class="input-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      @if ($search != '')
            <input type="text" class="form-control" name="search" id="search" value="{{$search}}" placeholder="Search for a listing...">
           @else
            <input type="text" class="form-control" name="search" id="search" value="" placeholder="Search for a listing...">
           @endif 
      <span class="input-group-btn">
        <button id="btnSubmit" name="btnSubmit" class="btn btn-default" type="button">Search</button>
        
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
  </div>
          <div class="panel panel-default">
          <div class="panel-heading">
             <div class="row">
               <div class="col-md-9">Users</div>
               <div class="col-md-3"> <a href="/dashboard/users/create" class="btn btn-default btn-sm" role="button">Add New</a>
              <a href="#" class="btn btn-default btn-sm" role="button">Select All</a>
              <a href="#" class="btn btn-default btn-sm" role="button">Delete</a></div>

             </div> 

          
         
          </div>
          <!--<div class="panel-body"></div>-->
          <table class="table table-striped task-table">

                   
                    <thead>
                        
                    </thead>

                   
                    <tbody>
                         @foreach ($users as $u)
                            <tr>
                            <td>
                           <input type="checkbox">
                            
          @if ($u->active == 'Not Active')
          <button type="button" class="btn btn-danger btn-sm">
        Not Active
        </button>
        @else
        <button type="button" class="btn btn-success btn-sm">
        Active
        </button>
        @endif
          {{$u-> privilege}}
                            </td>
                              
                                <td class="table-text">
                                    <div>{{$u-> fname}} {{$u-> lname}} - <a href="mailto:{{$u->email}}">{{$u->email}}</a>
                                  </div>
                                  <div class="col-md-offset-8">
          

                                <button class="btn btn-default btn-sm"type="submit">Reset Password</button>
                                


          <a href="/dashboard/users/delete/{{$u->id }}" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')" role="button">Delete</a>
          </div>
                                </td>

                                <td>
                                
                                </td>

                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                

          <!-- <hr>
          @foreach ($users as $u)
         
           <div class="row">
          <div class="col-md-1">
            <div class="checkbox">
          <label>
              <input type="checkbox">
          </label>
       </div>
          </div>
          <div class="col-md-2">
          @if ($u->active == 'Not Active')
          <button type="button" class="btn btn-danger btn-sm">
        Not Active
        </button>
        @else
        <button type="button" class="btn btn-success btn-sm">
        Active
        </button>
        @endif
          </div>
          <div class="col-md-5">
          <h5>{{$u-> fname}} {{$u-> lname}}</h5>
          </div>
          <div class="col-md-4">
          <a href="/dashboard/users/edit/{{$u->id}}" class="btn btn-primary" role="button">Edit</a>
          <a href="/dashboard/users/delete/{{$u->id }}" class="btn btn-danger" onclick="return confirm('Are you sure?')" role="button">Delete</a>
          
          </div>
          </div>
         <hr>
          
          @endforeach-->
</div>
        {!! $users->appends(['search' => $search])->render() !!}
           
</div>
</div>

@stop