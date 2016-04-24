 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">RR Intranet</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/dashboard/home">Dashboard</a></li>
            <li><a href="/dashboard/5mintopics/all">5 Minute Topics</a></li>
             <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
           Documents <span class="caret"></span></a>
          
            <ul class="dropdown-menu">
            <li><a href="/dashboard/documents/view/cat/alpha">Alpha</a></li>
            <li><a href="/dashboard/documents/view/cat/park">Park</a></li>
            <li><a href="/dashboard/documents/view/cat/reports">Reports</a></li>
            <li><a href="/dashboard/documents/view/cat/customerservice">Customer Service</a></li>
            <li><a href="/dashboard/documents/view/cat/clientservices">Client Services</a></li>
            <li><a href="/dashboard/documents/view/cat/all">All</a></li>
            

          </ul>
          </li>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
           Videos <span class="caret"></span></a>
          
            <ul class="dropdown-menu">
            <li><a href="/dashboard/videos/view/cat/alpha">Alpha</a></li>
            <li><a href="/dashboard/videos/view/cat/park">Park</a></li>
            <li><a href="/dashboard/videos/view/cat/reports">Reports</a></li>
            <li><a href="/dashboard/videos/view/cat/customerservice">Customer Service</a></li>
            <li><a href="/dashboard/videos/view/cat/clientservices">Client Services</a></li>
            <li><a href="/dashboard/videos/view/cat/all">All</a></li>
            

          </ul>
          </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-user fa-lg" aria-hidden="true"></span> {{$user->fname}} {{$user->lname}} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/dashboard/users/edit/{{$user->id}}">Profile</a></li>
             @if ($user->privilege == 'Administrator')
             <li role="separator" class="divider"></li>
            <li><a href="/dashboard/users">Users</a></li>
            <li><a href="/dashboard/sitesettings">Website Settings</a></li>
            @endif
            
            
            <li role="separator" class="divider"></li>
            <li><a href="/auth/logout">Logout</a></li>
          </ul>
        </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
    </br>
    </br>
    </br>
    </br>
