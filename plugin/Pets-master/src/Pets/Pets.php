<?php
namespace Pets;

use Pets\Managers\PointlessManager;
use Pets\Managers\Sqlite3Manager;
use Pets\Managers\YamlManager;
use Pets\Listener\EventListener;

use pocketmine\plugin\PluginBase;
use pocketmine\nbt\tag\Byte;
use pocketmine\nbt\tag\Enum;
use pocketmine\nbt\tag\Double;
use pocketmine\nbt\tag\Float;
use pocketmine\nbt\tag\Int;
use pocketmine\nbt\tag\Short;
use pocketmine\nbt\tag\String;
use pocketmine\entity\Entity;
use pocketmine\nbt\tag\Compound;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class Pets extends PluginBase {
  public $Pets, $cfg, $provider;
  public function onEnable() {
    $this->configProvider();
    Entity::registerEntity(PetWolf::class, true);
    Entity::registerEntity(PetOcelot::class, true);
    $this->getLogger()->debug("Entities have been registered!");
    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    $this->getLogger()->debug("Events have been registered!");
    $this->getLogger()->notice(TF::GREEN."Enabled!");
  }
  public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
    if($this->cfg instanceof Config);
    if($this->provider instanceof PointlessManager);
    if(strtolower($command) === "pet" and $sender->hasPermission("pet.cmd")) {
      if((count($args) == 0 and $sender->hasPermission("pet.cmd.help")) or ($args[0] === "help" and $sender->hasPermission("pet.cmd.help"))) {
        $sender->sendMessage(TF::YELLOW."/pet help");
        $sender->sendMessage(TF::YELLOW."/pet disown");
        $sender->sendMessage(TF::YELLOW."/pet spawn <PetName>");
        $sender->sendMessage(TF::YELLOW."/pet rename [PetName] <NewName>");
        //$sender->sendMessage(TF::YELLOW."/pet items <add|Remove|List>");
        $sender->sendMessage(TF::YELLOW."/pet tp");
        return true;
      }
      if($args[0] === "spawn" and $sender->hasPermission("pet.cmd.make")) {
        if($args[1] === "" or $args[1] === null) {
          $sender->sendMessage(TF::RED."You need to name your pet!");
          return true;
        }
        if($sender instanceof Player);
        $nbt = $this->makeNBT($sender->getSkinData(), $sender->getSkinName(), $args[1], $sender->getInventory(), $sender->getYaw(), $sender->getPitch(), $sender->getX(), $sender->getY(), $sender->getZ());
        $petEntity = Entity::createEntity("PetWolf", $sender->getLevel()->getChunk($sender->getX() >> 4, $sender->getZ() >> 4), $nbt);
        $this->provider->makePet($petEntity->getId(), $sender->getName(),$args[1]);
        if($petEntity) {
          $sender->sendMessage(TF::GREEN."Pet Created!");
          return true;
        }
        $sender->sendMessage(TF::GREEN."Pet Created!");
          return true;
      }elseif($args[0] === "disown" and $sender->hasPermission("pet.cmd.disown")) {
        $pet = $this->getPet($sender->getName());
        if($pet instanceof Entity);
        $pet->kill();
      }elseif($args[0] === "rename" and $sender->hasPermission("pet.cmd.name")) {
        if($args[1] === "" or $args[1] === null) {
          $sender->sendMessage(TF::RED."You need to name your pet!");
          return true;
        }elseif(strtolower($this->cfg->get("allow-rename")) === "false") {
          $sender->sendMessage(TF::RED."Pet renaming is Disabled!");
          return true;
        }
        $this->provider->setPetName($args[1], $sender->getName());
      }elseif($args[0] === "tp" and $sender->hasPermission("pet.cmd.tp")) {
        if($sender instanceof Player);
        $pet = $this->getPet($sender->getName());
        if($pet instanceof Entity);
        if($args[1] === null and $args[2] !== null) {
          $pet->teleport($sender->getPosition());
          // $sender->sendMessage(TF::RED."Functionality not implemented yet");
          return true;
        }
        return true;
      }
      return false;
    }
    return false;
  }
  private function makeNBT($skin, $skinName, $name, $inv, $yaw, $pitch, $x, $y, $z) {
    $nbt = new Compound;
    $nbt->Pos = new Enum("Pos", [
        new Double("", $x),
        new Double("", $y),
        new Double("", $z)
    ]);
    $nbt->Rotation = new Enum("Rotation", [
        new Float("", $yaw),
        new Float("", $pitch)
    ]);
    $nbt->Health = new Short("Health", 20);
    $nbt->Inventory = new Enum("Inventory", $inv);
    $nbt->CustomName = new String("CustomName", $name);
    $nbt->CustomNameVisible = new Byte("CustomNameVisible", 1);
    $nbt->Invulnerable = new Byte("Invulnerable", 0);
    $nbt->Skin = new Compound("Skin", [
        "Data" => new String("Data", $skin),
        "Name" => new String("Name", $skinName)
    ]);
    /* Name visible */
    $nbt->CustomNameVisible = new Byte("CustomNameVisible", 1);
    return $nbt;
  }
  public function getPet($name) {
    if($this->provider instanceof PointlessManager);
    $pet = $this->provider->getPetId($name); // TODO find the pet id by name then use the id to target the specific entity
    return $pet;
  }
  public function configProvider() {
    if(!file_exists($this->getDataFolder())) {
      @mkdir($this->getDataFolder());
    }
    $this->saveDefaultConfig();
    $this->cfg = new Config($this->getDataFolder()."config.yml");
    $DataProvider = $this->cfg->get("dataProvider");
    if(strtolower($DataProvider) === "sqlite3" or strtolower($DataProvider) === "sql") {
      $this->provider = new Sqlite3Manager($this);
      $this->getLogger()->info("Using SQLITE3 data provider");
    }elseif(strtolower($DataProvider) === "yaml" or strtolower($DataProvider) === "yml") {
      $this->provider = new YamlManager($this);
      $this->getLogger()->info("Using YAML data provider");
    }else{
      $this->provider = new Sqlite3Manager($this);
      $this->getLogger()->info("Using SQLITE3 data provider");
      throw new \RuntimeException("Invalid data provider");
    }
  }
  public function onDisable() {
    $this->getLogger()->notice(TF::GREEN."Enabled!");
  }
}
