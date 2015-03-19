<?php
 
namespace SydneyPlugin;
 
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
 
class Main extends PluginBase{
 
        public function onLoad(){
                $this->getLogger()->info("onLoad() has been called!");
        }
 
        public function onEnable(){
				$this->getLogger()->info("onEnable() has been called!");
        }
 
		public function onDisable() {
				$this->getLogger()->info("onDisable() has been called!");
		}
		
		public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
			switch ($command->getName ()) {
				case "hi" :
					$sender->sendMessage ( "Hello " . $sender->getName () . "!");
					return true;
				case "tst" :
					$sender->sendMessage ( "Test works" );
					return true;
				case "soo" :
					$sender->sendMessage ( " :-)\n  :-)\n   Hello Sydney Soo\n    Daddy Loves you!\n     :-)\n      :-)" );
					return true;
						
				default :
					return false;
			}
}

/**
 *
 * @param PlayerRespawnEvent $event
 *        	@priority NORMAL
 * @ignore Cancelled false
 */
public function onSpawn(PlayerRespawnEvent $event) {
	Server::getInstance ()->broadcastMessage ( $event->getPlayer ()->getDisplayName () . " has just spawned!" );
}
}