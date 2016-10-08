<?php
namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>


class StartGamePacket extends DataPacket{
	const NETWORK_ID = Info::START_GAME_PACKET;

	public $entityUniqueId;
	public $entityRuntimeId;
	public $x;
	public $y;
	public $z;
	public $seed;
	public $dimension;
	public $generator = 1; //default infinite - 0 old, 1 infinite, 2 flat
	public $gamemode;
	public $difficulty;
	public $spawnX;
	public $spawnY;
	public $spawnZ;
	public $hasAchievementsDisabled = 1;
	public $dayCycleStopTime = -1; //-1 = not stopped, any positive value = stopped at that time
	public $eduMode = 0;
	public $rainLevel;
	public $lightningLevel;
	public $commandsEnabled;
	public $isTexturePacksRequired = 0;
	public $unknown;
	public $worldName;

	public function decode(){

	}

	public function encode(){
		$this->reset();
		$this->putEntityId($this->entityUniqueId); //EntityUniqueID
		$this->putEntityId($this->entityRuntimeId); //EntityRuntimeID
		$this->putVector3f($this->x, $this->y, $this->z);
		$this->putLFloat(0); //TODO: find out what these are (yaw/pitch?)
		$this->putLFloat(0);
		$this->putVarInt($this->seed);
		$this->putVarInt($this->dimension);
		$this->putVarInt($this->generator);
		$this->putVarInt($this->gamemode);
		$this->putVarInt($this->difficulty);
		$this->putBlockCoords($this->spawnX, $this->spawnY, $this->spawnZ);
		$this->putByte($this->hasAchievementsDisabled);
		$this->putVarInt($this->dayCycleStopTime);
		$this->putByte($this->eduMode);
		$this->putLFloat($this->rainLevel);
		$this->putLFloat($this->lightningLevel);
		$this->putByte($this->commandsEnabled);
		$this->putByte($this->isTexturePacksRequired);
		$this->putString($this->unknown);
		$this->putString($this->worldName);
	}

}
