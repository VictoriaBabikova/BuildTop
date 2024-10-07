<?php

declare(strict_types=1);

namespace App;

class Route
{
    private static array $url = [];
    private static array $arguments = [];

    public static function get(string $uri, string $action, bool $HandlerJS = false): void
    {
        self::setToUrl($uri, $action, "get", $HandlerJS);
    }

    public static function post(string $uri, string $action, bool $HandlerJS = false): void
    {
        self::setToUrl($uri, $action, "post", $HandlerJS);
    }

    public static function getArguments(): array
    {
        return self::$arguments;
    }


    private static function setToUrl(string $uri, string $action, string $method, bool $HandlerJS): void
    {
        if ($HandlerJS) {
            self::$url["HandlerJS"] = [
                $uri => [
                    strtoupper($method) => $action,
                ]
            ];
            unset(self::$url[$uri]);
        } else {
            if (array_key_exists($uri, self::$url)) {
                self::$url[$uri][strtoupper($method)] = $action;
            } else {
                self::$url[$uri] = [
                    strtoupper($method) => $action,
                ];
            }
        }
    }

    public static function getUrl(): array
    {
        return self::$url;
    }

    private static function parsePath(): void
    {
        $URIParts = explode('?', $_SERVER['REQUEST_URI']);

        $arguments = [];

        if (! empty($URIParts)) {
            if (isset($URIParts[1])) {
                $params = $URIParts[1];
                $getParamArr = ParseDataRequest::parseApplicationContent($params);
                foreach ($getParamArr as $key => $value) {
                    $arguments[$key] = $value;
                }
            }
        }

        self::$arguments = $arguments;

    }

    public static function addArgumentToList(string $newArgument): string
    {
        self::parsePath();

        self::$arguments[$newArgument] = self::$arguments[$newArgument] ?? null;
        return $newArgument . "=" . self::$arguments[$newArgument];
    }
}
