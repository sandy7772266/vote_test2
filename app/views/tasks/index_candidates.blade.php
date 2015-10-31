@extends('layouts.master')




@section('content')
<div class="col-md-6">
	<h3>All Votes ~ title</h3>
		
	<ul class="list-group">
		@foreach ($candidates as $candidate)
			<li class="list-group-item">
				{{ $candidate->job_title }}
				

			</li>
		@endforeach
	</ul>
</div>

<div class="col-md-6">
	<h5>Add New Vote(每一欄都要有值^_^，都輸入一個數字即可)</h5>

	@include('tasks/partials/_form')
</div>
@stop