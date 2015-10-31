<?php

class AuthController extends BaseController {

	/**
	 * 處理 OpenID 登入
	 * GET login/openid
	 */
	public function openIDLogin()
	{
		try{

			// $openid = new LightOpenID('my-host.example.org');
			$openid = new LightOpenID('10.231.87.225:81');

			if(!$openid->mode){
				// 第一步驟
				// 設定
				$openid->identity = 'http://openid.ntpc.edu.tw/';
				// 要求取得之資料欄位
				$openid->required = array(
										
										
										'namePerson',
										'pref/timezone'
									);

				// 會先到　輸入帳密登入頁面
				// 再到 同意 / 不同意 授權頁面
				return Redirect::to($openid->authUrl());

			} elseif ($openid->mode == 'cancel') {
				// 使用者取消(不同意授權)
				return Redirect::to('/'); // 導回首頁

			} else {
				// 使用者同意授權
				// 此時 $openid->mode = "id_res"
				if ($openid->validate()) {
					// 通過驗證，也同意授權
					// 取得資料
				    $attr = $openid->getAttributes();
				    // return dd($attr);
				    // 將取得之資料帶到下一個步驟進行處理
				    // 要有相對應的路由設定
				    return Redirect::action('AuthController@showUserData', ['user' => $attr]);
				}

			}

		} catch (ErrorException $e) {

    		echo $e->getMessage();

		}
		
	}


	public function openIDLogout()
	{
		    Session::flush();
		    return Redirect::route('home');
	}

	/**
	 * 處理自OpenID取得之User資料
	 * 
	 */
	public function showUserData(){
		// 取得傳過來的data
		$user_data = Input::get('user');
		
		// 檢查是否為教學組長或教務主任;
		foreach (json_decode($user_data['pref/timezone']) as $item) {
                //echo '<tr>';
                //echo '<td>' . $item->id . '</td>';
                //echo '<td>' . $item->name . '</td>';
                //echo '<td>' . $item->role . '</td>';
                //echo '<td>' . $item->title . '</td>';
                //echo '<td>' . implode('、', $item->groups) . '</td>';
                $gr = $item->groups;
                $role = $item->role;
                if  ($role == "教師") {
                	//echo "資訊22";  echo $role;
                	Session::put('school_no', $item->id);
					Session::put('school_name', $item->name);
					Session::put('builder_name', $user_data['namePerson']);
					//Session::put('user_session', $user_data);
                }
                
     //            if ((in_array("資訊組長", $gr) ) or (in_array("教務主任", $gr) ) ){
     //              	echo "資訊22";
     //            	Session::put('school_no', $item->id);
					// Session::put('school_name', $item->name);
					// Session::put('builder_name', $user_data['namePerson'];);
     //            }

                //echo Session::get('school_no', '這是預設值，沒設定過就用這個囉！！');
                //echo Session::get('school_name', '這是預設值，沒設定過就用這個囉！！');
                //echo Session::get('builder_name', '這是預設值，沒設定過就用這個囉！！');
                //echo '</tr>';
            }


		// 存到session
		Session::put('login_session', $user_data);
		
		//echo "<hr />";
		//echo "Session 裡的東西：";
		//$this->mydd(Session::get('login_session', '這是預設值，沒設定過就用這個囉！！'));

		//Removing An Item From The Session
		//Session::forget('key');

		// 清掉全部session
		// Session::flush();
		// echo "<hr />";
		// echo "Session 裡現在什麼都沒有：";
		// $this->mydd(Session::get('login_session', '這是預設值，沒設定過就用這個囉！！'));
		// Redirect::action('VoteController@index');
		return Redirect::route('home');
	}

	/**
	 * dump 資料，讓輸出較易讀
	 * 
	 */
	public function mydd($data){
		
		return Redirect::action('VoteController@index');
		// echo "<pre>";
		// var_dump($data);
		
		// $s = $data['namePerson'];
		// echo $s;
		
		// echo "</pre>";
	}

}
