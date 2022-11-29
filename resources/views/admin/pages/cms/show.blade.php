<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>Module Name</th>
			<td>{{$cms->module_name}}</td>
		</tr>
		<tr>
			<th>Name</th>
			<td>{{$cms->name}}</td>
		</tr>
		<tr>
			<th>Meta Title</th>
			<td>{{$cms->meta_title}}</td>
		</tr>
		<tr>
			<th>Meta Keyword</th>
			<td>{{$cms->meta_keyword}}</td>
		</tr>
		<tr>
			<th>Meta Description</th>
			<td>{{$cms->meta_description}}</td>
		</tr>
		<tr>
			<th>Description</th>
			<td>{!! strip_tags($cms->description) !!}</td>
		</tr>
		<tr>
			<th>Meta Tag</th>
			<td>{{$cms->meta_tag}}</td>
		</tr>
	</table>
</div>