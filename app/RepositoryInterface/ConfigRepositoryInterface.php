<?php
namespace  MissVote\RepositoryInterface;

interface  ConfigRepositoryInterface extends CoreRepositoryInterface {

	public static function getCurrentCasting();

	public static function getLangCurrentCasting();
}