<?php

namespace Task\Statics\Configurations\Configs;

class AppConfig
{
    private const DEFAULT_DOMAIN = 'nnv-test.pl';
    private const DEFAULT_NAME = 'NNV - Zadanie Rekrutacyjne';
    private const DEFAULT_DESCRIPTION = "";

    private const DEFAULT_META_TITLE = '';

    private const DEFAULT_META_KEYWORDS = '';

    private static $domain;
    private static $name;
    private static $description;

    public static function setDomain($domain): void
    {
        self::$domain = $domain;
    }

    public static function getDomain(): string
    {
        return self::$domain ?? self::DEFAULT_DOMAIN;
    }

    public static function setName(string $name): void
    {
        self::$name = $name;
    }

    public static function getName(): string
    {
        return self::$name ?? self::DEFAULT_NAME;
    }

    public static function setDescription(string $description): void
    {
        self::$description = $description;
    }

    public static function getDescription(): string
    {
        return self::$description ?? self::DEFAULT_DESCRIPTION;
    }

    public static function getTitle(): string
    {
        return self::DEFAULT_META_TITLE;
    }

    public static function getKeywords(): string
    {
        return self::DEFAULT_META_KEYWORDS;
    }

    public static function getAppVersion(): string
    {
        $gitVersion = trim(shell_exec('git log --format="%H" -n 1'));

        return $gitVersion ?: bin2hex(self::getDomain());
    }
}