<?php

namespace ChatBubbles;

use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

class TextManager extends PluginTask{
    protected $plugin;
    private $p;
    public function __construct(Main $plugin){
    	parent::__construct($plugin);
        $this->plugin = $plugin;
    }
	
    public function onRun($tick){
        $this->revert();
    }
    
    public function revert(){
        $this->p->setNameTag($this->p->getDisplayName());
    }
    
    public function createBubble($player, $message){
        $this->p = $player;
        $this->m = wordwrap($message, $this->plugin->getConfig()->get("MaxCharactersPerLine"), "\n");
        $this->p->setNameTag("<" . $this->p->getDisplayName() . ">\n" . $this->m);
    }
}
