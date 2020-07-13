<?php

namespace FeedHealCMD\Commands;

use FeedHealCMD\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\level\sound\{
    AnvilBreakSound,
    AnvilFallSound,
    AnvilUseSound,
    BlazeShootSound,
    ClickSOund,
    DoorBumpSound,
    DoorCrashSound,
    DoorSound,
    EndermanTeleportSound,
    FizSound,
    GenericSound,
    GhastShootSound,
    GhastSound,
    LaunchSound,
    PopSound

class HealCommand extends Command
{
    private $plugin;
    private $config;

    public function __construct()
    {
        $this->plugin = Main::getInstance();
        parent::__construct("heal");
        $this->setDescription("Heal yourself!");
        $this->setPermission("command.use.heal");
        $this->config = Main::$config;
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if ($sender->hasPermission("command.use.heal")) {
                if (empty($args[0])) {
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage($this->config["healsuccess"]);
                    $sender->getLevel()->addSound(new $this->config["healsound"]($sender));
                    return false;
                }
                if (Main::getInstance()->getServer()->getPlayer($args[0])) {
                    $player = Main::getInstance()->getServer()->getPlayer($args[0]);
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage($this->config["healsuccess"]);
                    $sender->getLevel()->addSound(new $this->config["healsound"]($sender));
                }
            } else {
                $sender->sendMessage($this->config["nopermission"]);
            }
        } else {
            $sender->sendMessage(Main::prefix . "The command must be executed in-game.");
        }
    }
}
