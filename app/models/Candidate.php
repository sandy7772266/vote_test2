<?php

class Candidate extends Eloquent {

	protected $table = 'candidates';
	protected $fillable = array('cname','job_title','sex','vote_id');


	public function vote()
    {
        return $this->belongsTo('Vote');
    }

    // Album __belongs_to_many__ Listeners
    public function accounts()
    {
        return $this->belongsToMany('Account');
    }

}

?>