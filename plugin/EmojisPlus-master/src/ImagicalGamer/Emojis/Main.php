<?php
namespace ImagicalGamer\Emojis;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;	
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{

public function onEnable(){
  $this->getLogger()->info(C::LIGHT_PURPLE . "Emojis Enabled!");
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
}
  public function onChat(PlayerChatEvent $event){
    $player = $event->getPlayer();
    $name = $player->getName();
    $phoneemoji = "☎";
    $checkemoji = "✔";
    $nukeemoji = "☢";
    $frownemoji = "☹";
    $dieemoji = "☠";
    $spadeemoji = "♠";
    $peaceemoji = "☮";
    $umbrellaemoji = "☂";
    $planeemoji = "✈";
    $scissorsemoji = "✂";
    $snowemoji = "❄";
    $snowmanemoji = "☃";
    $watchemoji = "⌚";
    $pencilemoji = "✏";
    $cubeemoji = "▫";
    $arrowemoji = "➡";
    $recycleemoji = "♻";
    $cloveremoji = "☘";
    $anchoremoji = "⚓";
    $swordemoji = "⚔";
    $staremoji = "⭐";
    //$yinyangemoji = "☯";
    $xemoji = "✖";
    $heartemoji = "♥";
    $message = $event->getMessage();
    if($message === ":HEART:"){
      $event->setMessage($heartemoji);
    }
    else if($message === ":CHECK:"){
      $event->setMessage($checkemoji);
    }
    else if($message === ":PHONE:"){
      $event->setMessage($phoneemoji);
    }
    else if($message === ":NUKE:"){
      $event->setMessage($nukeemoji);
    }
    else if($message === ":FROWN:"){
      $event->setMessage($frownemoji);
    }
    else if($message === ":HAZARD:"){
      $event->setMessage($dieemoji);
    }
    else if($message === ":SPADE:"){
      $event->setMessage($spadeemoji);
    }
    else if($message === ":PEACE:"){
      $event->setMessage($peaceemoji);
    }
    else if($message === ":UMBRELLA:"){
      $event->setMessage($umbrellaemoji);
    }
    else if($message === ":PLANE:"){
      $event->setMessage($planeemoji);
    }
    else if($message === ":SCISSOR:"){
      $event->setMessage($scissorsemoji);
    }
    else if($message === ":SNOW:"){
      $event->setMessage($snowemoji);
    }
    else if($message === ":SNOWMAN:"){
      $event->setMessage($snowmanemoji);
    }
    else if($message === ":WATCH:"){
      $event->setmessage($watchemoji);
    }
    else if($message === ":PENCIL:"){
      $event->setMessage($pencilemoji);
    }
    else if($message === ":CUBE:"){
      $event->setMessage($cubeemoji);
    }
    else if($message === ":ARROW:"){
      $event->setMessage($arrowemoji);
    }
    else if($message === ":RECYCLE:"){
      $event->setMessage($recycleemoji);
    }
    else if($message === ":CLOVER:"){
      $event->setMessage($cloveremoji);
    }
    else if($message === ":ANCHOR:"){
      $event->setMessage($anchoremoji);
    }
    else if($message === ":SWORD:"){
      $event->setMessage($swordemoji);
    }
    else if($message === ":STAR:"){
      $event->setMessage($staremoji);
    }
    else if($message === ":X:"){
      $event->setMessage($xemoji);
    }
  }
}
