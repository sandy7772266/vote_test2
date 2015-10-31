@extends('layouts.master')




@section('content')
<div class="col-md-6">
	<h3>Votes ~ edit</h3>
		
	<ul class="list-group">
		
			<li class="list-group-item">
				
				{{Form::model($vote,['method'=>'PATCH','route'=>['votes.update',$vote->id]])}}	<br>		
				學校代號：{{$vote->school_no}}<br>
				學校名稱：{{$vote->school_name}}<br>
				投票名稱：{{Form::text('vote_title')}}<br>
				投票人數：{{Form::text('vote_amount')}}<br>
				* 投票人數有變動時，請重新產生籤票。<br><br>
				開始時間：{{Form::text('start_at')}}<br>
				結束時間：{{Form::text('end_at')}}<br>
				當選人數：{{Form::text('vote_goal')}}<br>
				可投票數：{{Form::text('can_select')}}<br>
				建 立 者：{{$vote->builder_name}}<br>
			 
				{{$vote->id}}<br>
				<input type="submit"  />
				{{ Form::close() }}
			</li>
		
	</ul>
</div>


@stop