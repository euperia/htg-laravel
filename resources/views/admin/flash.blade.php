@if(session()->has('flash_message'))
<div class="row">
<div class="box box-default">
<div class="col-md-10 col-md-offset-1">
<div class="alert alert-{{ session()->get('flash_message')['level'] }} alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Alert!</h4>
		{{ session()->get('flash_message')['msg'] }} 
</div>
</div>
</div>
</div>
@endif
