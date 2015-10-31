<?php

class Vote extends Eloquent {

	protected $table = 'votes';
	//protected $fillable = array('school_no','school_name','vote_title','vote_amount','start_at','end_at','vote_goal','can_select','builder_name');
	protected $fillable = array('vote_title','vote_amount','start_at','end_at','vote_goal','can_select');



 // Artist __has_many__ Album
    public function accounts()
    {
        return $this->hasMany('Account');
    }

     // Artist __has_many__ Album
    public function candidates()
    {
        return $this->hasMany('Candidate');
    }

}

?>