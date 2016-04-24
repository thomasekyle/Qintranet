<div class="row">
<hr>
    <div class="col-lg-12">
        <ul class="nav nav-pills nav-justified">
        	<li><a href="/">© 2016 Resident Research, LLC</a></li>
        	<li><a href="#"></a></li>
        	@unless (Auth::check())
    			<li><a href="/auth/login">Login</a></li>
			@endunless
			@unless (!(Auth::check()))
    			<li><a href="/auth/logout">Logout</a></li>
			@endunless
        		
		</ul>
    </div>
</div>