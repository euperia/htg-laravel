@if(session()->has('flash_message'))
<div class="row">
    <div class="box box-default">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-{{ session()->get('flash_message')['level'] }} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session()->get('flash_message')['msg'] }} 
            </div>
        </div>
    </div>
</div>
@endif

@if (count($errors) > 0)
<div class="row">
    <div class="col-md-6">
        <div class="box-body">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                {{ $error }}
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

