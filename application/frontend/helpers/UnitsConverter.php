<?php

namespace PetFishCo\Frontend\Helpers;

use PetFishCo\Core\Exceptions\AppException;

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
		return $liters;
	}

	/**
	 * @param string $measure_system
	 * @param float  $capacity
	 *
	 * @return string
	 * @throws AppException
	 */
	public static function formatVolumeOutput($measure_system, $capacity) {
		if ($measure_system == self::SYSTEM_IMPERIAL) {
			$capacity = self::litersToGallons($capacity);
		} else {
			$capacity = $capacity;
		}

		return $capacity . ' ' . self::getSufix($measure_system);
	}

	/**
	 * @param string $measure_system
	 *
	 * @return string
	 */
	public static function getSufix($measure_system){
		if($measure_system == self::SYSTEM_DECIMAL){
			return 'L';
		}else if($measure_system == self::SYSTEM_IMPERIAL){
			return 'gal.';
		}else{
			throw new AppException('Invalid measure system ' . $measure_system);
		}
	}

}