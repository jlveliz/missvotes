<?php
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