{{ Form::open(['class' => 'form','method'=>'get','route'=>['candidates_select']]) }}
	                 
                     <input type="text" class="form-control" placeholder="投票代號...." autofocus required
                      name="vote_id" />
                     <input type="text" class="form-control" placeholder="籤號...." autofocus required
                       name="account" />

                    <input type="submit"  />
{{ Form::close() }}

