<?php

use MissVote\Models\TicketVoteClient;

if (! function_exists('existOnCart')) {

	function existOnCart($raffleNumber)
	{
		if (!session()->has('cart')) return false;
		$exist = false;
		foreach (session()->get('cart') as $key => $item) {
			if ($item['raffle_number'] == $raffleNumber) {
				$exist = true;
			}
		}
		return $exist;
	}

}

if (! function_exists('isReserved')) {

	function isReserved($raffleNumber)
	{
		$ticket = TicketVoteClient::where('raffle_vote_id',$raffleNumber)->first();
		if ($ticket) return true;
		return false;
	}

}