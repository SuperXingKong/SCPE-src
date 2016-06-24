<?php
namespace Ad5001\PlayerSelector ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\Server;
use pocketmine\math\Vector3;
 use pocketmine\Player;


class Main extends PluginBase implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
public function onLoad(){
}
public function onPreCommand(PlayerCommandPreprocessEvent $event) {
	$message = $event->getMessage();
	$sender = $event->getPlayer();
	if(preg_match("/@r/i", $message)) {
		$cmd = $message;
		$idrand = rand(0, count($this->getServer()->getOnlinePlayers()));
		$id = 0;
		foreach($this->getServer()->getOnlinePlayers() as $player) {
			$players = $player;
			if($id === $idrand) {
				$cmd = str_ireplace("@r", $player->getName(), $cmd);
				$cmd = str_ireplace("/", "", $cmd);
			}
			$id++;
		}
		$this->getServer()->dispatchCommand($sender, $cmd);
	$event->setCancelled(true);
	}
	if(preg_match("/@a/i", $message)) {
		$cmd = $message;
		foreach($this->getServer()->getOnlinePlayers() as $player) {
			$cmd = $message;
			$cmd = str_ireplace("@a", $player->getName(), $cmd);
			$cmd = str_ireplace("/", "", $cmd);
			$this->getServer()->dispatchCommand($sender, $cmd);
		}
	$event->setCancelled(true);
	}
	if(preg_match("/@p/i", $message)) {
		$cmd = $message;
		$pos = new Vector3($sender->x, $sender->y, $sender->z);
		if($pos instanceof Vector3){ 
		$selp = null;
		$ld = -1;
		if(count($sender->getLevel()->getPlayers()) <= 1) {
			$cmd = str_ireplace("@p", $sender->getName(), $cmd);
		} else {
		foreach($sender->getLevel()->getPlayers() as $player){
			if($player ===! $sender) {
				$distance = $sender->distance($player);
				if($ld === -1 or $ld > $distance){
					$cmd = str_ireplace("@p", $player->getName(), $cmd);
					$ld = $distance;
				}
				}
			}
		}
		}
		$cmd = str_ireplace("/", "", $cmd);
		$this->getServer()->dispatchCommand($sender, $cmd);
	    $event->setCancelled(true);
  }
	if(preg_match("/@m/i", $message)) {
	$cmd = $message;
	$cmd = str_ireplace("@m", $sender->getName(), $cmd);
	$cmd = str_ireplace("/", "", $cmd);
	$this->getServer()->dispatchCommand($sender, $cmd);
	$event->setCancelled(true);
	}
	if(preg_match("/@w/i", $message)) {
		$cmd = $message;
		foreach($sender->getLevel()->getPlayers() as $player) {
			$cmd = $message;
			$cmd = str_ireplace("@w", $player->getName(), $cmd);
			$cmd = str_ireplace("/", "", $cmd);
			$this->getServer()->dispatchCommand($sender, $cmd);
		}
	$event->setCancelled(true);
	}
return false;
 }
 
}