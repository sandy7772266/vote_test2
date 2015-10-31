Route::get('/test3', function()
{

$vote = Vote::find(51);

$candidates = Candidate::where('vote_id', '=', 51)->get();
        foreach ($candidates as $candidate){
        $dump_d = Candidate::with('accounts')->find($candidate->id);
        dd($dump_d);
        }
// $account = Account::find(1);
// $candidate = Candidate::find(10);
// $candidate->accounts()->detach();

// // return $candidate->accounts;
// return Candidate::with('accounts')->find($candidate->id);


});
