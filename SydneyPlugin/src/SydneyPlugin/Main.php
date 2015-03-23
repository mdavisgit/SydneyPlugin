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
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\nbt\tag\String;
// use SydneyPlugin\Messages;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerKickEvent;

$playersOnline = array ();

// $playerOnline is a global variable
class Main extends PluginBase implements Listener {
	
	/**
	 * public function sendMessageAll(Messages $m) {
	 *
	 * }
	 */
	public function onLoad() {
		$this->getLogger ()->info ( "onLoad() has been called!" );
	}
	public function onEnable() {
		$this->getLogger ()->info ( "onEnable() has been called!!!" );
		$this->getServer ()->getScheduler ()->scheduleRepeatingTask ( new BroadcastPluginTask ( $this ), 120 );
		// This line above will schedule a repeating task to run every minute (1200 ticks)
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
		// This line above is required to use additional events
		// Also must include "use pocketmine\event\player\<EventNameToUse>"
		// You can get supported event names here: http://docs.pocketmine.net/d3/daf/namespacepocketmine_1_1event.html
		// expand the events on the left column to see the choices. Ex. "use pocketmine\event\player\PlayerJoinEvent"
	}
	public function onDisable() {
		$this->getLogger ()->info ( "onDisable() has been called!" );
	}
	
	/**
	 * _________________________________________________________________
	 *
	 * @param String $m        	
	 */
	public function messageToAll($m) {
		Server::getInstance ()->broadcastMessage ( $m );		
	}
	
	public function onKick(PlayerKickEvent $PKE) {
		$this->messageToAll("someone was kicked");
	}
	public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
		global $playersOnline;
		switch ($command->getName ()) {
			case "hi" :
				$sender->sendMessage ( "Hello " . $sender->getName () . "!!!" . time () );
				$this->messageToAll ( "Boo Ya" );
				$e = "Lola140";
				// $e->getPlayer()->sendMessage("poop head");
				
				$this->messageToAll ( "Before foreach" );
				$length = sizeof ( $playersOnline );
				$this->messageToAll ( "Length: " . $length );
				
				for($i = 0; $i < $length; $i ++) {
					$this->messageToAll ( print_r ( $playersOnline ) );
					// $this->messageToAll(var_dump($playersOnline));
					// $this->messageToAll ( "Element " . $i . "0: " . $playersOnline [$i] [0] . " Element " . $i . "1: " . $playersOnline [$i] [1] );
				}
				
				if ($length > 0) {
					// foreach ( $playersOnline as $aName => $aTime ) {
					// while ( list ( $key, $value ) = each ( $aTime ) ) {
					// $this->messageToAll ( "key " . $key . " value " . $value );
					// }
					
					// for($i = 0; $i < $length; $i ++) {
					// $this->messageToAll ( "aName: " . $aName . "aTime: " . $aTime );
					// $this->messageToAll ( "Index: " . $i . " is " . $playersOnline [$i] );
					// $this->messageToAll( "Element ". $length . "0: " . $playersOnline[$length][0] . " Element ". $length . "1: " . $playersOnline[$length][1]);
					// }
				}
				// foreach($playersOnline as $x => $x_value) {
				// $this->testmessage($x. " " . $x_value);
				// echo "Key=" . $x . ", Value=" . $x_value;
				// echo "<br>";
				// $this->testmessage("123");
				// }
				$this->messageToAll ( "Afer foreach" );
				
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
		// $playersOnline = array();
		global $playersOnline;
		$this->messageToAll ( "onJoin!" );
		$player = $PJE->getPlayer ();
		$name = $player->getDisplayName ();
		$this->getServer ()->broadcastMessage ( "Howdy " . $name . " [DEFAULT] joined the game!!" . time () );
		
		$this->messageToAll ( "Before setting array" );
		
		/**
		 * if (empty ( $playersOnline )) {
		 * $playersOnline [0] = $name .
		 *
		 *
		 *
		 *
		 *
		 *
		 * "~" . time ();
		 * $this->messageToAll ( "Added entry to first element: " . $playersOnline [0] );
		 * } else {
		 * $length = count ( $playersOnline );
		 * $this->messageToAll ( "Length: " . $length );
		 * $this->messageToAll ( "Count : " . count ( $playersOnline ) );
		 * $this->messageToAll ( "Name: " . $name );
		 *
		 * $playersOnline [$length] = $name . "~" . time ();
		 * }
		 */
		
		$length = sizeof ( $playersOnline );
		$this->messageToAll ( "Length: " . $length );
		// $this->messageToAll ( "Length before: " . $length);
		// $playersOnline [$length] = $name . "~" . time ();
		// $playersOnline = array (
		// $length => array (
		// $name,
		// time ()
		// )
		// );
		$playersOnline [$name] = time ();
		$this->messageToAll ( print_r ( $playersOnline ) );
		$playersOnline [$name] = time ();
		$this->messageToAll ( print_r ( $playersOnline ) );
		// $this->messageToAll("Player " . $name . " joined " . $playersOnline[$name]);
		$nameDup = $name . "xx";
		$playersOnline [$nameDup] = time ();
		$this->messageToAll ( print_r ( $playersOnline ) );
		// $this->messageToAll("Player " . $nameDup . " joined " . $playersOnline[$name]);
		// $this->messageToAll ( "Element " . $length . "0: " . $playersOnline [$length] [0] . " Element " . $length . "1: " . $playersOnline [$length] [1] );
		// Duplicate the new entry - for testing only
	/**
	 * $length = sizeof ( $playersOnline );
	 * $this->messageToAll("Length: " .
	 *
	 *
	 * $length);
	 * $nameDup = $name."x";
	 * $playersOnline = array (
	 * $length => array (
	 * $nameDup,
	 * time ()
	 * )
	 * );
	 * $this->messageToAll ( "Element " . $length . "0: " . $playersOnline [$length] [0] . " Element " . $length . "1: " . $playersOnline [$length] [1] );
	 *
	 * $this->messageToAll ( "Element 00: " . $playersOnline [0] [0] . " Element 01: " . $playersOnline [0] [1] );
	 * $this->messageToAll ( "Element 10: " . $playersOnline [1] [0] . " Element 11: " . $playersOnline [1] [1] );
	 */
	}
	public function onQuit(PlayerQuitEvent $PQE) {
		global $playersOnline;
		$this->messageToAll ( "bye bye" );
		$player = $PQE->getPlayer ();
		$name = $player->getDisplayName ();
		$this->messageToAll ( print_r ( $playersOnline ) );
		unset ( $playersOnline [$name] );
		$this->messageToAll ( print_r ( $playersOnline ) );
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
	public function onTouch(PlayerInteractEvent $PIE) {
		global $playersOnline;
		$length = count ( $playersOnline );
		$p = $PIE->getPlayer ();
		$name = $p->getDisplayName ();
		$this->messageToAll ( $p . " - " . $name );
		for($i = 0; $i < $length; $i ++) {
			$wValue = $playersOnline [$i];
			if (($x_pos = strpos ( $wValue, '~' )) !== FALSE) {
				$wPlayerName = substr ( $wValue, 0, $x_pos );
				$wPlayerJoinTime = substr ( $wValue, $x_pos + 1 );
				$wOnlineTime = time () - $wPlayerJoinTime;
			}
			$msgSent = 0;
			if (($wOnlineTime >= 12) and ($wOnlineTime <= 600) and $name == $wPlayerName) {
				
				$p->sendMessage ( "You have been playing for " . $wOnlineTime . " seconds." );
				$p->sendMessage ( "Take a break and eat a cookie" );
				$msgSent = 1;
			} elseif (($wOnlineTime >= 601) and ($wOnlineTime <= 1000) and $name == $wPlayerName) {
				
				$p->sendMessage ( "You have been playing for " . $wOnlineTime . " seconds." );
				$p->sendMessage ( "Take a break and eat a cookie" );
				$p->sendMessage ( "You will be kicked from the server if you do not" );
			} elseif (($wOnlineTime > 1001) and $name == $wPlayerName) {
				
				$p->kick ( "Take a break!" );
			}
		}
	}
}