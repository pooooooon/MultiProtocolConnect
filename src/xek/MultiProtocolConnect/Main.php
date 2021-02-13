<?php

declare(strict_types=1);

namespace xek\MultiProtocolConnect;

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
				if($pk->protocol >= 418 && $pk->protocol <= 424){//pocketmine is not support <418 or >424 | 418 is rtx beta it support
					$pk->protocol = ProtocolInfo::CURRENT_PROTOCOL;
				}else{
					$pk->protocol = $pk->protocol;
				}
			}else{ //i don't have many time to add more
				$pk->protocol = ProtocolInfo::CURRENT_PROTOCOL;
			}
	     }

}
