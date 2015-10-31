<?php

class Account extends Eloquent {

	protected $table = 'accounts';
	//protected $fillable = array('school_no','school_name','vote_title','vote_amount','start_at','end_at','vote_goal','can_select','builder_name');
	
	// Album __belongs_to__ Artist
    public function vote()
    {
        return $this->belongsTo('Vote');
    }

    // Album __belongs_to_many__ Listeners
    public function candidates()
    {
        return $this->belongsToMany('Candidate');
    }

}
?>