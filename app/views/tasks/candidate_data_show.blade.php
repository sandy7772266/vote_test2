@extends('layouts.master')




@section('content')
<div class="col-md-6">
	
	<ul class="list-group">

		@foreach ($candidates as $candidate)
			<li class="list-group-item">
				
				{{$candidate->cname}}
				{{$candidate->job_title}}
				{{$candidate->sex}}

				<br>
				
			</li>
		@endforeach
	</ul>
</div>

@stop