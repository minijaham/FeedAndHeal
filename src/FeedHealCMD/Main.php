<?php

namespace FeedHealCMD;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use FeedHealCMD\Commands\FeedCommand;
use FeedHealCMD\Commands\HealCommand;

class Main extends PluginBase
{

    const prefix = "FeedHeal CMD";

    public static $instance;

    public static $config;

    public static function getInstance()
    {

        return self::$instance;
    }

    public function onEnable()
    {

        $this->getServer()->getLogger()->info(self::prefix . " Enabled");

        self::$instance = $this;

        $this->saveResource("config.yml");

        self::$config = (new Config($this->getDataFolder() . "config.yml", Config::YAML))->getAll();

        $this->onCommands();

    }

    private function onCommands()
    {

        $this->getServer()->getCommandMap()->registerAll(
            "command",
            [

                new FeedCommand(),
                new HealCommand(),

            ]

        );
    }

    public function onDisable()
    {

        $this->getServer()->getLogger()->info(self::prefix . " Disabled");
    }
}
