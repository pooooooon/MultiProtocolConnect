<?php
declare(strict_types=1);

namespace mpc\MultiProtocolConnect;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function onPacketReceive(DataPacketReceiveEvent $event): void {
		$player = $event->getPlayer();
		$pk = $event->getPacket();
		if(!$pk instanceof LoginPacket) return;
			if(ProtocolInfo::CURRENT_PROTOCOL == 419 && ProtocolInfo::CURRENT_PROTOCOL == 422){
				if($pk->protocol >= 418 && $pk->protocol < 424){
					$pk->protocol = ProtocolInfo::CURRENT_PROTOCOL;
				}
			}else if(ProtocolInfo::CURRENT_PROTOCOL == 431){
				if($pk->protocol >= 429 && $pk->protocol <= 431){
					 $pk->protocol = ProtocolInfo::CURRENT_PROTOCOL;
				}elseif($pk->protocol >= 433){//437 block bug
					 $event->setCancelled();
					 $pk = new StartGamePacket();
					 $player->sendDataPacket($pk, false, true);
				}
			}else{ 
				$pk->protocol = ProtocolInfo::CURRENT_PROTOCOL;
			}
	     }
	
}
