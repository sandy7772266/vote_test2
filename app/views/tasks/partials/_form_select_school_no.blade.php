{{ Form::open(['class' => 'form','method'=>'get','route'=>['vote_result_show_index']]) }}
	                 
                     <input type="text" class="form-control" placeholder="學校代號...." autofocus required
                      name="school_no" />
                     <input type="submit"  />
{{ Form::close() }}

