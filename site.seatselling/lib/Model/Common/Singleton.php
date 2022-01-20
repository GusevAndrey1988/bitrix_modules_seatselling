<?php

namespace Site\SeatSelling\Model\Common;

trait Singleton
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): static
    {
        if (!static::$instance)
        {
            static::$instance = new static();
        }

        return static::$instance;
    }
}