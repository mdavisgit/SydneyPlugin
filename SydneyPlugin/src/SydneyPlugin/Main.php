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
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Stone;
 
class Main extends PluginBase implements Listener{
 
        public function onLoad(){
                $this->getLogger()->info("onLoad() has been called!");
        }
 
        public function onEnable(){
				$this->getLogger()->info("onEnable() has been called!");
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new BroadcastPluginTask($this), 1200);
				// This line above will schedule a repeating task to run every minute (1200 ticks)
				$this->getServer()->getPluginManager()->registerEvents($this,$this);    
				//This line above is required to use additional events
				// Also must include "use pocketmine\event\player\<EventNameToUse>"
				//  You can get supported event names here: http://docs.pocketmine.net/d3/daf/namespacepocketmine_1_1event.html
				//   expand the events on the left column to see the choices.  Ex. "use pocketmine\event\player\PlayerJoinEvent" 
        }
 
		public function onDisable() {
				$this->getLogger()->info("onDisable() has been called!");
		}
		
		public function testmessage($m) {
			Server::getInstance()->broadcastMessage($m);
		}
		
		public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
			switch ($command->getName ()) {
				case "hi" :
					$sender->sendMessage ( "Hello " . $sender->getName () . "!".time());
					$this->testmessage("Boo Ya");
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

		public function playerJoin(PlayerJoinEvent $PJE) {
			// Format for function is "public function <anyName>(<EventNameFromDocumentation> <anyVariableName>) {
			$this->testmessage("onJoin");
			$player = $PJE->getPlayer();
			$name = $player->getDisplayName();
			$this->getServer()->broadcastMessage("Howdy ".$name." [DEFAULT] joined the game!".time());


			
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