<div class="form-group">
	<label class="col-md-4 control-label">Employee Name</label>
	<div class="col-md-6">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}		
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">E-Mail Address</label>
	<div class="col-md-6">
		{!! Form::email('email', null, ['class'=>'form-control']) !!}		
	</div>
</div>

@if($enterPassword)
<div class="form-group">
	<label class="col-md-4 control-label">Password</label>
	<div class="col-md-6">
		{!! Form::password('password', ['class'=>'form-control']) !!}		
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Confirm Password</label>
	<div class="col-md-6">
		{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
	</div>
</div>
@endif

<div class = "form-group">
	<label class = "col-md-4 control-label">Is Administrator</label>
	<div class = "col-md-6">
		{!! Form::checkbox('admin', 1, null, ['class'=>'form-control']) !!}
		<!--<input type="checkbox" class="form-control" name="admin" value="1">-->
	</div>
</div>	
<div class="form-group">
	<div class="col-md-6 col-md-offset-4 ">
		{!! Form::submit($submitButtonText, ['class'=>'btn btn-primary btn-lg col-xs-12']) !!}
	</div>
</div>
	