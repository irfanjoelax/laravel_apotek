@if (session('info'))
<div class="alert background-success"><em class="fa fa-thumbs-up"></em> 
	<strong>{{ session('info') }}</strong>
</div>
@endif

@if (session('warning'))
<div class="alert background-warning"><em class="fa fa-warning"></em> 
	<strong>{{ session('warning') }}</strong>
</div>
@endif

@if (session('danger'))
<div class="alert background-danger"><em class="fa fa-times-circle"></em> 
	<strong>{{ session('danger') }}</strong>
</div>
@endif