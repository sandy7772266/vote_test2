@extends('layouts.master')




@section('content')



<div class="col-md-6">
	<h5>上傳候選人名單   請將資料填寫於第一張工作表中

		<br>使用 OpenOffice Calc 的使用者，請不要將檔案存成 Microsoft Excel 95 格式
		<br>需存成 Microsoft Excel 97/2000/xp 格式
		<br>接受檔案附檔名為  xls 或 xlsx
	</h5>

	<a href="{{ url('001.xls') }}"><strong>範例檔案</strong></a>	                                               
    
	{{Form::open(array('url' => 'file_import', 'files' => true))}}
	{{Form::file('image')}}
	<input type="submit"  />
	{{ Form::close() }}
</div>
@stop