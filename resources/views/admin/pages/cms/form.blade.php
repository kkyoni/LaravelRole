<div class="ibox-content">
	<div class="form-group row {{ $errors->has('module_name') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Module Name</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::text('module_name',null,['class' => 'form-control','id' => 'module_name','placeholder' => 'Enter Module Name']) !!}
		</div>
	</div>
	<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Name</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::text('name',null,['class' => 'form-control','id' => 'name','placeholder' => 'Enter Name','autocomplete' => 'off']) !!}
		</div>
	</div>
	<div class="form-group row {{ $errors->has('meta_title') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Meta Title</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::text('meta_title',null,['class' => 'form-control','id' => 'meta_title','placeholder' => 'Enter Meta Title','autocomplete' => 'off']) !!}
		</div>
	</div>
	<div class="form-group row {{ $errors->has('meta_keyword') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Meta Keyword</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::textarea('meta_keyword',null,['class' => 'form-control ','id' => 'meta_keyword','placeholder' => 'Enter Meta Keyword','autocomplete' => 'off','rows' => '4','cols' => '50']) !!}
		</div>
	</div>
	<div class="form-group row {{ $errors->has('meta_description') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Meta Description</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::textarea('meta_description',null,['class' => 'form-control ','id' => 'meta_description','placeholder' => 'Enter Description','autocomplete' => 'off','rows' => '4','cols' => '50']) !!}
		</div>
	</div>
	<div class="form-group row {{ $errors->has('meta_description') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Description</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::textarea('description',null,['class' => 'form-control ','id'	=> 'description','autocomplete' => 'off']) !!}
		</div>
	</div>
	<div class="form-group row {{ $errors->has('meta_tag') ? 'has-error' : '' }}">
		<label class="col-sm-3 col-form-label">
			<strong>Meta Tag</strong>
		</label>
		<div class="col-sm-9">
			{!! Form::text('meta_tag',null,['class' => 'form-control','id' => 'meta_tag','placeholder' => 'Enter Meta Tag','autocomplete' => 'off']) !!}
		</div>
	</div>
</div>

<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
var editor = CKEDITOR.replace('description', {
	language: 'en',
	toolbar :[
	{ name: 'document', items : [ 'NewPage','Preview' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
	'/',
	{ name: 'styles', items : [ 'Styles','Format' ] },
	{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'tools', items : [ 'Maximize','-','About' ] }],
	extraPlugins: 'notification'
});
editor.on( 'required', function( evt ) {
	editor.showNotification( 'This field is required.', 'warning' );
	evt.cancel();
});
</script>