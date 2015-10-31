<?php

class VoteController extends \BaseController {

public function store()
	{
		//
		$data = Input::all();
		$vote = new Vote;
		$vote->school_no=Session::get('school_no');
		$vote->school_name=Session::get('school_name');
		$vote->vote_title=$data['vote_title'];
		$vote->vote_amount=$data['vote_amount'];
		$vote->start_at=$data['start_at'];
		$vote->end_at=$data['end_at'];
		$vote->vote_goal=$data['vote_goal'];
		$vote->can_select=$data['can_select'];
		$vote->builder_name=Session::get('builder_name');
		$vote->save();

		$arr=[
			'vote' => $vote,
			'flash' => ['type'=>'success','msg' => '新增成功！']
		];

		$vote_new = DB::table('votes')
                    ->orderBy('id', 'desc')
                    //->groupBy('count')
                    //->having('count', '>', 100)
                    ->get();

		$vote_id = $vote_new[0]->id;
		$vote_data=[$vote_id,$vote->vote_amount];
		Session::put('vote_data', $vote_data);
		Session::put('redo', 1);
		$this->account_create();

		return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	

	}
    //修改部分 end

   
	public function account_create()
	{
		
		$redo = Session::get('redo');
		$vote_id = Session::get('vote_id');
		if ($redo == 1){
			
			Account::where('vote_id', '=', $vote_id)->delete();
		}
		$vote_data = Session::get('vote_data');
		
		
		$vote_amount = $vote_data[1];
		
			// $table->increments('id');
			// $table->string('username');
			// $table->integer('vote_id')->unsigned();
		for($x=0;$x<=$vote_amount-1;$x++){ 
		$str_rand = $this->GeraHash(6);
		$zero_str_len = strlen($vote_amount) - strlen($x) ;
		$zero_str = '';
			for($y=1;$y<=$zero_str_len;$y++){ 
				$zero_str .= '0';
			}
		$index_no = $zero_str.$x;
		$Caracteres = 'ABCDEFGHJKLMPQRSTUVXWYZ23456789';
		$index_str = '';
			for ($y=0;$y<strlen($index_no);$y++){ 
				$index_ary[$y] = intval(substr($index_no, $y, 1));
				$index_ary_insert[$y] = substr($Caracteres, $index_ary[$y]+7, 1);
				$index_str .= $index_ary_insert[$y];
			}
			//echo $index_str."**";
		$str_rand = substr($str_rand, 0, 2).$index_str.substr($str_rand, 3, 5); 
		$username_ary[$x] = $str_rand;

 		}    
 		for($x=0;$x<=$vote_amount-1;$x++){ 
	 		$account = new Account;
			$account->username = $username_ary[$x];
			$account->vote_id = $vote_data[0];
			$account->save();    
		}    
		
		return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	

	}
}
?>