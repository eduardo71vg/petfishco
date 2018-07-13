<?php

namespace PetFishCo\Backend\Validators;


use Codeception\Test\Unit;

class FishTest extends Unit {

	/**
	 * @var \UnitTester
	 */
	protected $tester;

	protected function _before()
	{
	}

	protected function _after()
	{
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isFinCountAllowedInAquarium()
	 */
	public function testIsFinCountAllowedInAquariumForFishWithLessThan3Fins() {

		$fins = 2;
		$aquarium_instance_id = 1;
		$validator = new Fish();
		$actual = $validator->isFinCountAllowedInAquarium($fins, $aquarium_instance_id);

		$this->assertTrue($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isFinCountAllowedInAquarium()
	 */
	public function testIsFinCountAllowedInAquariumForFishWith3FinsAndLessThan75Liters() {

		$fins = 3;
		$aquarium_instance_id = 1;
		$capacity = 74;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getAquariumCapacity')
			->with($aquarium_instance_id)
			->andReturn($capacity);

		$validator = new Fish($service);
		$actual = $validator->isFinCountAllowedInAquarium($fins, $aquarium_instance_id);

		$this->assertFalse($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isFinCountAllowedInAquarium()
	 */
	public function testIsFinCountAllowedInAquariumForFishWith3FinsAndMoreThan75Liters() {

		$fins = 3;
		$aquarium_instance_id = 1;
		$capacity = 76;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getAquariumCapacity')
			->with($aquarium_instance_id)
			->andReturn($capacity);

		$validator = new Fish($service);
		$actual = $validator->isFinCountAllowedInAquarium($fins, $aquarium_instance_id);

		$this->assertTrue($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isFinCountAllowedInAquarium()
	 */
	public function testIsFinCountAllowedInAquariumForFishWithMoreThan3FinsAndMoreThan75Liters() {

		$fins = 8;
		$aquarium_instance_id = 1;
		$capacity = 76;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getAquariumCapacity')
			->with($aquarium_instance_id)
			->andReturn($capacity);

		$validator = new Fish($service);
		$actual = $validator->isFinCountAllowedInAquarium($fins, $aquarium_instance_id);

		$this->assertTrue($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isCompatibleSpecieWithAquarium()
	 */
	public function testIsCompatibleSpecieWithAquarium() {

		$in = [Fish::SPECIE_GOLDFISH, Fish::SPECIE_GUPPIE];
		$aquarium_instance_id = 1;
		do {
			$specie_id = rand(1, 20);
		} while(in_array($specie_id, $in));

		$validator = new Fish();
		$actual = $validator->isCompatibleSpecieWithAquarium($specie_id, $aquarium_instance_id);

		$this->assertTrue($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isCompatibleSpecieWithAquarium()
	 */
	public function testIsCompatibleSpecieWithAquariumOnEmptyAquarium() {

		$specie_id = Fish::SPECIE_GOLDFISH;
		$aquarium_instance_id = 1;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getSpecies')
			->with($aquarium_instance_id)
			->andReturn([]);

		$validator = new Fish($service);
		$actual = $validator->isCompatibleSpecieWithAquarium($specie_id, $aquarium_instance_id);

		$this->assertTrue($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isCompatibleSpecieWithAquarium()
	 */
	public function testIsCompatibleSpecieWithAquariumOnEmptyAquariumWithGuppie() {

		$specie_id = Fish::SPECIE_GUPPIE;
		$aquarium_instance_id = 1;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getSpecies')
			->with($aquarium_instance_id)
			->andReturn([]);

		$validator = new Fish($service);
		$actual = $validator->isCompatibleSpecieWithAquarium($specie_id, $aquarium_instance_id);

		$this->assertTrue($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isCompatibleSpecieWithAquarium()
	 */
	public function testIsCompatibleSpecieWithAquariumWithGuppie() {

		$specie_id = Fish::SPECIE_GUPPIE;
		$aquarium_instance_id = 1;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getSpecies')
			->with($aquarium_instance_id)
			->andReturn([Fish::SPECIE_GOLDFISH]);

		$validator = new Fish($service);
		$actual = $validator->isCompatibleSpecieWithAquarium($specie_id, $aquarium_instance_id);

		$this->assertFalse($actual);
	}

	/**
	 * @author Eduardo
	 * @covers Fish::isCompatibleSpecieWithAquarium()
	 */
	public function testIsCompatibleSpecieWithAquariumWithGoldfish() {

		$specie_id = Fish::SPECIE_GOLDFISH;
		$aquarium_instance_id = 1;

		//create mock service and inject it
		$service = \Mockery::mock(\PetFishCo\Backend\Models\Services\Fish::class)->makePartial();
		$service->shouldReceive('getSpecies')
			->with($aquarium_instance_id)
			->andReturn([Fish::SPECIE_GUPPIE]);

		$validator = new Fish($service);
		$actual = $validator->isCompatibleSpecieWithAquarium($specie_id, $aquarium_instance_id);

		$this->assertFalse($actual);
	}
}
