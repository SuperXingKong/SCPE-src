<?php
namespace BoxOfDevs\ColorfullBlock;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\IPlayer;
use pocketmine\plugin\PluginBase;

   class ChangeColorTask extends PluginTask  {
    private $player;
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	public function onRun($tick) {
		$randwool = rand(0, 15);
		$id = 1;
		while($this->getConfig()->get("LastBlockNumber") => $id) {
			$x = $this->getConfig()->get("X" . $id);
		}
	}
   }