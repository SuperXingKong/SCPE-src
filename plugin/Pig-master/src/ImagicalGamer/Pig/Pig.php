<?php
namespace ImagicalGamer\Pig;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use pocketmine\Server;

use pocketmine\utils\TextFormat as C;
use pocketmine\utils\Config;

class Pig extends PluginBase implements Plugin {
  
  public function onEnable(){
    $this->getLogger()->info(C::GREEN . "Enabled!");
  }
  public function onCommand(CommandSender $s, Command $cmd, $label, array $args){
        if($cmd->getName() == "pig"){
           if($args[0] === "install"){
             $file = $this->getServer()->getDataPath() . "plugins/" . $args[1] . ".phar";
             if(file_exists($file)){
               $s->sendMessage(C::RED . $args[1] . " Is already installed!");
             }
             else{
             copy("http://8.26.94.171/ImagicalGamer/" . $args[1], $this->getServer()->getDataPath() . "plugins/" . $args[1] . ".phar");
             $s->sendMessage(C::GREEN . $args[1] . " Installed Successfully!");
             $path = $this->getServer()->getDataPath() . "plugins/" . $args[1] . ".phar";
             $plugin = $this->getServer()->getPluginManager()->loadPlugin($path);
             $this->getServer()->getPluginManager()->enablePlugin($plugin);
           }
           }
           if($args[0] === "remove"){
            $plugin = ($this->getServer()->getDataPath() . "plugins/" . $args[1] . ".phar");
             if(file_exists($plugin)){
               $pluginname = $this->getServer()->getPluginManager()->getPlugin($args[1]);
               $this->getServer()->getPluginManager()->disablePlugin($pluginname);
               unlink($this->getServer()->getDataPath() . "plugins/" . $args[1] . ".phar");
               $s->sendMessage(C::GREEN . $args[1] . " Removed Successfully!");
             }
             else{
               $s->sendMessage(C::RED . $args[1] . " Does not exist!");
             }
           }
           if($args[0] === "help"){
             $s->sendMessage(C::GREEN . C::BOLD . "Pig-Help!" . C::RESET . C::GREEN . "\nInstall: /pig install <PluginName>\nRemove: /pig remove <PluginName>");
           }
        }
     }
   }
