
@if (Session::has('builder_name'))


@extends('layouts.master')




@section('content')
<div class="col-md-6">
	<h3>投票系統管理</h3>
	<a href="{{ url('/insert-first') }}"><strong>新增</strong></a>	                                               	
	<ul class="list-group">

		<?php
		Session::forget('redo');
		?>
		@foreach ($ary[0] as $vote)

			@if ( $time_now > $vote->end_at )
				<td><br>投票已完成...<br><a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></a><br>
				</td>
			@elseif ( $time_now > $vote->start_at)
				<td ><br>投票進行中...
					<a href="{{ url('/account_data_show', array($vote->id), false) }}"><strong>籤票內容</strong></a>

					<br><a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></a><br>
					<br><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong><br>
				</td>


			@else
				<td ><br>尚未投票...<br><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong>

<?php
		$candidates = Candidate::where('vote_id', '=', $vote->id)->get();
		$can_id = null;
		if ( count($candidates) <> 0 ){
		$can_id = $candidates[0]->id;

		}
		?>
			<li class="list-group-item">
				<table>
				<tr>
				<td >
				@if ($ary[1][$vote->id]<>'沒有資料')

				<!-- {{$ary[1][$vote->id]}} -->
				<a href="{{ url('/candidate_data_show', array($vote->id), false) }}"><strong>瀏覽選項內容</strong></a>
				
				
				@else
				沒有選項內容
				@endif 
				</td>
				<td>
				@if ( $can_id <> null )	
				<a href="{{ url('/insert-second', array($vote->id), false) }}"><strong>重新上傳選項內容</strong></a>
				@else
				<a href="{{ url('/insert-second', array($vote->id), false) }}"><strong>上傳選項內容</strong></a>
				@endif
				</td>
				<td>
				<a href="{{ url('/account_data_show', array($vote->id), false) }}"><strong>籤票內容</strong></a>
				</td>
				
				<td>
				<a href="{{ url('/account_data_redo', array($vote->id), false) }}"><strong>重新製作籤票</strong></a>

<!-- 				{{ Form::open(['url' => 'votes', 'class' => 'form','method'=>'delete','route'=>['votes.destroy', $vote->id]]) }}
 -->			
 				</td>
 				<td>
 				<a href="{{ url('/', array($vote->id), false) }}"><strong>編輯{{ $vote->vote_title }}</strong></a>	                                               
 				</td>
 				<td>
 				{{ Form::open(['class' => 'form','method'=>'delete','route'=>['votes.destroy', $vote->id]]) }}
				
                {{ Form::submit('刪除',['class'=>'btn btn-default btn-xs'])}}
				{{ Form::close() }}



				<!-- {{Form::model($vote,array('route'=>array('votes.update',$vote->id)))}}			

				{{Form::text('vote_title')}}

				<input type="submit"  />
				{{ Form::close() }} -->
				</td>
					@endif

				</tr>
				</table>
			</li>
		@endforeach
	</ul>
</div>

@stop

@else

	<center><h3>請登入</h3></center>
@endif