<?php

namespace SydneyPlugin;

use pocketmine\Player;
use pocketmine\scheduler\PluginTask;
use pocketmine\Server;

class BroadcastPluginTask extends PluginTask{

	public function onRun($currentTick){
		$date = date('Y-m-d H:i:s');
		Server::getInstance()->broadcastMessage("Current Time: " . time()."  -  ".$date);
	}
}
