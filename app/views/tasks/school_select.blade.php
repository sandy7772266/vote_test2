@extends('layouts.master')




@section('content')


	<div class="col-md-6">
		<h5>請輸入學校代號(測試學校代號為 14646 )</h5>
		@if($err)
			{{print $err;}}
			{{$err='';}}
		@endif
		@include('tasks/partials/_form_select_school_no')
	</div>
@stop