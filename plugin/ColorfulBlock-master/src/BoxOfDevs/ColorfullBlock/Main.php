<?php
namespace BoxOfDevs\ColorfullBlock ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocetmine\Player;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
 use pocketmine\Player;


class Main extends PluginBase{
public function onEnable(){
	$this->reloadConfig();
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new ChangeColorTask($this), 10);
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this), 5);
	// $this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
public function onLoad(){
$this->reloadConfig();
$this->saveDefaultConfig();
}
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
switch($cmd->getName()){
	case "createcolorblock":
	if(isset($args[0]) and is_numeric($args[0]) and isset($args[1]) and is_numeric($args[1]) and isset($args[2]) and is_numeric($args[2])) {
		$x = $args[0];
		$y = $args[1];
		$z = $args[2];
	} elseif(isset($args[0])) {
		$player = $this->getServer()->getPlayer($args[0]);
		if($player instanceof Player) {
			$x = $player->x;
			$y = $player->y;
			$z = $player->z;
		}
	} else {
			$x = $sender->x;
			$y = $sender->y;
			$z = $sender->z;
	}
	$this->getConfig()->set("X" . $this->getConfig()->get("LastBlockNumber") + 1, $x);
	$this->getConfig()->set("Y" . $this->getConfig()->get("LastBlockNumber") + 1, $y);
	$this->getConfig()->set("Z" . $this->getConfig()->get("LastBlockNumber") + 1, $z);
	$this->getConfig()->set("LastBlockNumber", $this->getConfig()->get("LastBlockNumber") + 1);
	$this->saveConfig();
}
return false;
 }
}