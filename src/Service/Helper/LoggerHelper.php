<?php

declare(strict_types=1);

namespace App\Service\Helper;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class LoggerHelper
 */
class LoggerHelper
{
    const DEV = 'dev';

    private Logger $logger;

    /**
     * LoggerHelper constructor.
     *
     * @param string $destination
     */
    public function __construct(string $destination = self::DEV)
    {
        $this->logger = new Logger('logger');
        $this->logger->pushHandler(new StreamHandler(dirname(__DIR__, 3)."/var/log/$destination.log", Logger::DEBUG));
    }

    /**
     * @return Logger
     */
    public function getLogger(): Logger
    {
        return $this->logger;
    }
}