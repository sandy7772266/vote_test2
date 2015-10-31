<?php

class VoteController extends \BaseController {

	
// public function index()
// 	{		
// 		$tasks = Task::with('user')->orderby('completed')->orderby('completed', 'desc')->orderby('created_at', 'desc')->get();
// 		$users = User::orderby('name')->lists('name', 'id');
		
		
// 		return View::make('tasks.index', compact('tasks', 'users'));	
// 	}


// *
// 	 * Display a listing of the resource.
// 	 *
// 	 * @return Response
	 
// 	public function index()
// 	{
// 		return Response::json(Vote::all());
// 	}





	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$votes = Response::json(Vote::all());
		$err='';
		$votes = Vote::get();

		return View::make('tasks.index2', compact('votes','err'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */


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
		//$this->passsec($vote_id);	
		//Session::put('vote_id_insert', $vote_id);                
		//return Redirect::route('vote.insert-second');
		return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	
		//Redirect::action('VoteController@passsec', ['id' => $vote_id]);
	}
    //修改部分 end

   
	public function account_create()
	{
		
		$redo = Session::get('redo');
		Session::forget('redo');
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
		//Session::flush();
		//return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	 
		if ($redo == 1){
			return Redirect::route('manage');
			//return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	
		}
		//Session::put('vote_id_insert', $vote_id);
		//return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	
        //return View::make('tasks.vote-insert-second');

	}


	function GeraHash($qx){ 
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
        $Caracteres = 'ABCDEFGHJKLMPQRSTUVXWYZ23456789'; 
        $QuantidadeCaracteres = strlen($Caracteres); 
        $QuantidadeCaracteres--; 

        $Hash=NULL; 
            for($x=1;$x<=$qx;$x++){ 
                $Posicao = rand(0,$QuantidadeCaracteres); 
                $Hash .= substr($Caracteres,$Posicao,1); 
		    } 

		return $Hash; 
	} 


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'hello';
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

		//修改部分
	public function update($id)
	{
		//$data = Input::get();
		$vote = Vote::find($id);

		$vote -> fill(Input::all());
		


		// if(isset($data['vote_title'])){
		// 	$vote->vote_title = $data['vote_title'];

			//return Response::json($vote);
		

		// if(isset($data['done'])){
		// 	$todo->done = $data['done'];
		// }

		$vote->save();

		$arr = [
			'flash' => ['type' => 'success',
						'msg' => '更新成功！']
		];

		//return Redirect::to('/');
		return Redirect::route('manage');
	}
    //修改部分 end

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$vote = Vote::find($id);
		$candidates = Candidate::where('vote_id', '=', $id)->get();
		foreach ($candidates as $candidate){
			 $candidate->accounts()->detach();
			 $candidate->delete();
		}
		Account::where('vote_id', '=', $id)->delete();
		$vote->delete();
		$arr = [
			'flash' => ['type' => 'success',
						'msg' => '待辦事項已刪除！']
		];

		return Redirect::route('manage');
	}


public function update2($id)
	{
		$arr = 'o';
		return Response::json($arr);
	}
    //修改部分 end


     //尚未用到
public function redo($id)
	{
		$accounts = Account::where('vote_id', '=', $id)->get();
        $votes = Vote::where('id', '=', $id)->get();
        $school_no = $votes[0]->school_no;
        $vote_amount = $votes[0]->vote_amount;
        $redo = 1;
        $data = [$accounts,$school_no,$vote_amount,$redo];
        
        $vote_data=[$id,$vote_amount];
        //$redo = 1;
        //echo "id",$votes[0]->$id,"amount",$votes[0]->vote_amount;
        Session::put('vote_id', $id);
        Session::put('vote_data', $vote_data);
        Session::put('redo', 1);

	}


}
