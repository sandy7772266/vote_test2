@extends('layouts.master')




@section('content')
	票數限制： {{$can_select}}
	{{ Form::open(['class' => 'form','method'=>'get','route'=>['candidates_select_result']]) }}
		<div class="col-md-6">
					@if ($err_msg)
						{{$err_msg}}
					@endif

					<ul class="list-group">
					@foreach ($candidates as $candidate)
						<li class="list-group-item">
							<input tabindex="1" type="checkbox" name="candidate[]" id={{$candidate->id}} value={{$candidate->id}}>
							{{$candidate->cname}} ** {{$candidate->job_title}}**	{{$candidate->sex}}
							<br>
						</li>
					@endforeach
			</ul>
		</div>
	<input type="submit"  />
	{{ Form::close() }}

@stop