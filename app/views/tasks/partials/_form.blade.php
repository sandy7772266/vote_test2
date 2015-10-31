{{ Form::open(['url' => '/votes', 'class' => 'form']) }}
	                 
                     <input type="text" class="form-control" placeholder="投票名稱...." autofocus required
                      name="vote_title" /> 
                     <input type="text" class="form-control" placeholder="投票人數...." autofocus required
                       name="vote_amount" />
                     <input type="text" class="form-control" placeholder="2015-10-15 12:00:00" autofocus required
                        name="start_at" /> 
                     <input type="text" class="form-control" placeholder="2015-10-15 12:00:00" autofocus required
                         name="end_at" />

                     <input type="text" class="form-control" placeholder="當選人數...." autofocus required
                       name="vote_goal" />      
                     <input type="text" class="form-control" placeholder="可投票數...." autofocus required
                         name="can_select" />  

                                                               
                    <input type="submit"  />
{{ Form::close() }}

