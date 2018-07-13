<?php

namespace PetFishCo\Frontend\Helpers;

class UnitsConverter {

	const SYSTEM_DECIMAL = 'D';
	const SYSTEM_IMPERIAL = 'I';

	/**
	 * @param float $liters
	 *
	 * @return float|int
	 */
	public static function litersToGallons($liters) {

		return number_format($liters * 0.264172, 2) ;
	}

	/**
	 * @param float|int $liters
	 *
	 * @return string
	 */
	public static function formatLitersOutput($liters){
		return $liters . ' L';
	}

	/**
	 * @param float|int $gallons
	 *
	 * @return string
	 */
	public static function formatGallonsOutput($gallons){
		return $gallons . ' gal.';
	}

}