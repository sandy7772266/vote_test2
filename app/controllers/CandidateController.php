<?php

class CandidateController extends \BaseController {

	
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

		$candidates = Candidate::get();
		return View::make('tasks.index_candidates', compact('candidates'));	
		//return Response::json(Candidate::all());
		//return View::make('tasks.index', compact('votes'));	
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$value = null;		
	 
		 Excel::load(storage_path().'/001.xls', function($reader) use (&$value) {
         $value = $reader->get()->toArray();//object -> array


    	});
		 return Redirect::action('CandidateController@store_a', ['data' => $value]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */


	public function store_a()
	{		
		      $data = Input::get('data');
		     
		        foreach ($data as $data_array1) {
			 		

				
					$candidate = new Candidate;
					$candidate->cname=$data_array1[0];
					$candidate->job_title=$data_array1[1];
					$candidate->sex=$data_array1[2];
					$candidate->vote_id=42;
					$candidate->total_count=0;
					$candidate->save();
				}

	}
    //修改部分 end

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function mydd($data){
		
		echo "<pre>";
		var_dump($data);
		echo "tt";
		echo "</pre>";
	}



	public function file_move()	{		

		    
		    if (Input::hasFile('image'))
			{
			    $vote_id_temp = Session::get('vote_id_insert', '');
				
			    $this->clean($vote_id_temp);
			    $file = Input::file('image'); //
		    	$fileName = "test222";
		    	$destinationPath = storage_path().'/file_import/';
			    $file = $file->move($destinationPath, $fileName);


			    Excel::selectSheetsByIndex(0)->load($file, function($reader) use($vote_id_temp) {
			    	//以第一個資料表中的資料為主
			    	//提醒使用ooo的使用者，不要存成 Microsoft Excel 95 
			    	//需存成 Microsoft Excel 97/2000/xp  ***.xls
         			$value = $reader->get()->toArray();//object -> array

				    foreach ($value as $data_array1) {
				 		//$vote_id_temp = Session::get('vote_id_insert', '');
				    	$data_array1['vote_id'] = $vote_id_temp;
				    	//var_dump($data_array1);
						$candidate = Candidate::create($data_array1);
						// $candidate = new Candidate;
						// $candidate->cname=$data_array1[0];
						// $candidate->job_title=$data_array1[1];
						// $candidate->sex=$data_array1[2];
						// $candidate->vote_id=42;
						// $candidate->total_count=0;
						// $candidate->save();
					}
				});
			    // echo $file;

				//File::delete($file);
			}
			return Redirect::route('manage');


	}




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
		$vote->delete();

		$arr = [
			'flash' => ['type' => 'success',
						'msg' => '待辦事項已刪除！']
		];

		return Redirect::route('home');
	}



	public function clean($vote_id){

		Candidate::where('vote_id', '=', $vote_id)->delete();

		$arr = [
			'status' => 'success',
			'msg' => '完成事項已刪除！'
		];

		return Response::json($arr);
	}


public function update2($id)
	{
		$arr = 'o';
		return Response::json($arr);
	}
    //修改部分 end



//	public function candidates_select_result($id)
//	{
//		//    $cadidates_checked = Input::get('candidate');
////    if(is_array($cadidates_checked))
////    {
////
////     foreach ($cadidates_checked as $candidate_id){
////         echo $candidate_id;
////         //$account = Account::find(6776);
////         //$candidate->accounts()->save($account);
//////            $candidate->accounts()->detach();
//////            $candidate->delete();
////     }
////        //echo $account_id;
////    }
////    // return our view and Vote information
////   // return View::make('tasks.candidate_select_result',compact('candidates'));
//	}

}
