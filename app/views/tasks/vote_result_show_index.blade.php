
@extends('layouts.master')




@section('content')
<div class="col-md-6">
	<h3>{{$votes[0]->school_name}}</h3>
	<ul class="list-group">

		@foreach ($votes as $vote)

			<li class="list-group-item">
				<table>
				<tr>
					@if ( $time_now > $vote->end_at )
				<td ><a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></a>
					@elseif ( $time_now > $vote->start_at)
						<td >投票進行中...<strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong>
					@else
						<td >尚未投票...<strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong>
					@endif
				


				</td>
				<td>
				{{--@if ( $can_id <> null )--}}
				{{--<a href="{{ url('/insert-second', array($vote->id), false) }}"><strong>重新上傳選項內容</strong></a>--}}
				{{--@else--}}
				{{--<a href="{{ url('/insert-second', array($vote->id), false) }}"><strong>上傳選項內容</strong></a>--}}
				{{--@endif--}}
				</td>
				</tr>
				</table>
			</li>
		@endforeach
	</ul>
</div>

@stop