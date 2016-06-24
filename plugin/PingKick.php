<?php
class pingkick implements Plugin{
	private $api, $config;
	public function __construct(ServerAPI $api, $server = false){
		$this->api = $api;
		$this->server = ServerAPI::request();
	}
	public function init(){
		$this->config = new Config($this->api->plugin->configPath($this)."settings.yml", CONFIG_YAML, array(
			"PingKick" => "4000",
			"Enabled" => "true",
			"PingCheck" => "1",
			));
		$this->pingcheck = $this->config->get("PingCheck");
		$this->pingkick = $this->config->get("PingKick");
		$this->enabled = $this->config->get("Enabled");
		$this->api->console->register("pingkick", "pingkick commands", array($this, "cmd"));
		$this->api->addHandler("player.spawn", array($this, "join"), 15);
		if($this->enabled == "true"){
			console("§a[PingKick] Enabled!");
		}
		if($this->enabled == "false"){
			console("§e[PingKick] Disabled!");
		}
		if($this->pingcheck == 0){
			console("§c[PingKick] PingCheck is set at 0! please set it greater than 0");
		}
		console("§9[PingKick] Set at ".$this->pingkick."ms");
		console("§9[PingKick] Checking ping every ".$this->pingcheck." seconds");
	}
	public function join($data, $event){
		switch($event){
			case "player.spawn":
				$this->api->schedule(20, array($this, "join"), array(), true);
				$ping = round($data->getLag(), 2);
				if($this->pingcheck !== 0){
					if($this->enabled == "true"){
						if($this->pingkick < $ping){
							$this->server->api->ban->kick($data->username, "Ping was too high");
						}else{
							break;
						}
					}else{
						break;//this function looks like a jet fighter lol :P
					}
				}else{
					break;
				}
		}
	}
	public function cmd($cmd, $args, $issuer){
		$num = $args[1];
		switch($cmd){
			case "pingkick":
				switch($args[0]){
					case "set":
						/*
						if($args[1] !== 1-99999999999999999999999999999){
							$output = "[PingKick] Please set it to a number";
							break;
						}else{
							$this->config->set("PingKick", "".$num."");
							console("[PingKick] set at ".$num."ms");
						*/
							$output = "[PingKick] Not supported yet but im working on it :)";
							break;
					case "enable":
						$this->config->set("Enabled", "true");
						$this->config->save();
						$output = "[PingKick] Please restart the server for effect";
						break;
					case "disable":
						$this->config->set("Enabled", "false");
						$this->config->save();
						$output = "[PingKick] Please restart the server for effect";
						break;
					case "check":
						$this->config->set("PingCheck", "".$num."");
						$this->config->save();
						$output = "[PingKick] Please restart the server for effect";
						break;
					case "status":
						if($issuer instanceOf Player){
							$output = "[PingKick] Please use this command in console";
							break;
						}
						if($this->enabled == "true"){
							console("§a[PingKick] Enabled!");
						}
						if($this->enabled == "false"){
							console("§e[PingKick] Disabled!");
						}
						if($this->pingcheck == 0){
							console("§c[PingKick] PingCheck is set at 0! please set it greater than 0");
						}
						console("§9[PingKick] Set at ".$this->pingkick."ms");
						console("§9[PingKick] Checking ping every ".$this->pingcheck." seconds");
						break;
				}
		return $output;
		}			
	}
	public function __destruct(){}
}