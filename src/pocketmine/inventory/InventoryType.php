<?php
namespace pocketmine\inventory;

/**
 * Saves all the information regarding default inventory sizes and types
 */
class InventoryType{
	const CHEST = 0;
	const DOUBLE_CHEST = 1;
	const PLAYER = 2, INVENTORY = 2;
	const FURNACE = 3;
	const CRAFTING = 4;
	const WORKBENCH = 5;
	const STONECUTTER = 6;
	const BREWING_STAND = 7, CAULDRON = 7;
	const ANVIL = 8;
	const ENCHANT_TABLE = 9, ENCHANTMENT = 9;
	const DISPENSER = 10;
	const DROPPER = 11;
	const HOPPER = 12;
	const MINECART_CHEST = 13;
	const MINECART_HOPPER = 14;
	const HORSE = 15;

	const PLAYER_FLOATING = 254;

	private static $default = [];

	private $size;
	private $title;
	private $typeId;

	/**
	 * @param $index
	 *
	 * @return InventoryType
	 */
	public static function get($index){
		return isset(static::$default[$index]) ? static::$default[$index] : null;
	}

	public static function init(){
		if(count(static::$default) > 0){
			return;
		}

		static::$default[static::CHEST] = new InventoryType(27, "Chest", 0);
		static::$default[static::DOUBLE_CHEST] = new InventoryType(27 + 27, "Double Chest", 0);
		static::$default[static::PLAYER] = new InventoryType(36 + 4, "Player", 0); //36 CONTAINER, 4 ARMOR
		static::$default[static::FURNACE] = new InventoryType(3, "Furnace", 2);
		static::$default[static::CRAFTING] = new InventoryType(5, "Crafting", 1); //4 CRAFTING slots, 1 RESULT
		static::$default[static::WORKBENCH] = new InventoryType(10, "Crafting", 1); //9 CRAFTING slots, 1 RESULT
		static::$default[static::ENCHANT_TABLE] = new InventoryType(2, "Enchant", 3); //1 INPUT/OUTPUT, 1 LAPIS
		static::$default[static::BREWING_STAND] = new InventoryType(4, "Brewing", 4); //1 INPUT, 3 POTION
		static::$default[static::ANVIL] = new InventoryType(3, "Anvil", 5); //2 INPUT, 1 OUTPUT
		static::$default[static::DISPENSER] = new InventoryType(9, "Dispenser", 6); //9 CONTAINER
		static::$default[static::DROPPER] = new InventoryType(9, "Dropper", 7); //9 CONTAINER
		static::$default[static::HOPPER] = new InventoryType(5, "Hopper", 8); //5 CONTAINER
		static::$default[static::MINECART_CHEST] = new InventoryType(27, "Minecart with Chest", 9);
		static::$default[static::MINECART_HOPPER] = new InventoryType(5, "Minecart with Hopper", 10);
		static::$default[static::HORSE] = new InventoryType(5, "Horse", 11); //2 CONTAINER & maybe chest?

		static::$default[static::PLAYER_FLOATING] = new InventoryType(36, "Floating", null); //Mirror all slots of main inventory (needed for large item pickups)
	}

	/**
	 * @param int    $defaultSize
	 * @param string $defaultTitle
	 * @param int    $typeId
	 */
	private function __construct($defaultSize, $defaultTitle, $typeId = 0){
		$this->size = $defaultSize;
		$this->title = $defaultTitle;
		$this->typeId = $typeId;
	}

	/**
	 * @return int
	 */
	public function getDefaultSize(){
		return $this->size;
	}

	/**
	 * @return string
	 */
	public function getDefaultTitle(){
		return $this->title;
	}

	/**
	 * @return int
	 */
	public function getNetworkType(){
		return $this->typeId;
	}
}