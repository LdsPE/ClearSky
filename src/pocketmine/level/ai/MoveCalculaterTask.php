<?php

namespace pocketmine\level\ai;

use pocketmine\Server;
use pocketmine\scheduler\AsyncTask;
use pocketmine\entity\ai\AIManager;
use pocketmine\network\protocol\MoveEntityPacket;

class MoveCalculaterTask extends AsyncTask{
	// private $server;
	private $yaw;
	private $levelId;
	private $entityId;
	private $entityType;
	private $result = null;
	private $serialized = false;
	private $cancelRun = false;
	/** @var int */
	private $taskId = null;

	public function __construct($levelId, $entityId, $entityType, $yaw){
		$this->levelId = $levelId;
		// $this->server = $level->getServer();
		$this->entityId = $entityId;
		$this->entityType = $entityType;
		$this->yaw = $yaw;
	}

	public function onRun(){
		// $rs = ["LevelId" => $this->levelId, "EntityId" => $this->entityId, "EntityType" => $this->entityType, "yaw" => $this->yaw];
		// AIManager::calculateMovement($entity);
		$yaw = $this->yaw;
		$yaw++;
		if($yaw >= 360) $yaw = 0;
		// $rs = ['id' => $id, 'x' => $x, 'y' => $y, 'z' => $z];
		$rs = ["LevelId" => $this->levelId, "EntityId" => $this->entityId, "EntityType" => $this->entityType, "yaw" => $yaw];
		$this->setResult($rs);
	}

	public function onCompletion(Server $server){
		$level = $server->getLevel($this->getResult()["LevelId"]);
		$entity = $level->getEntity($this->getResult()["EntityId"]);
		if($entity != null){
			#$server->broadcastTip(var_export($this->getResult(), true));
			$server->getLogger()->info($this->getResult()["yaw"]);
			$entity->setPositionAndRotation($entity->getPosition(), $this->getResult()["yaw"], $entity->pitch);
		}
	}
}