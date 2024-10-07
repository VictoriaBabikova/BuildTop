<?php

declare(strict_types=1);

namespace App;

use Exception;

class Base
{
    public string $uri;
    public string $HTTPMethod;
    private array $arguments;
    private array $argumentList;

    /**
     * @throws Exception
     */
    public function __construct(string $uri, string $HTTPMethod)
    {
        $this->uri = $uri;

        $this->HTTPMethod = $HTTPMethod;

        $this->arguments = Route::getArguments();

        $this->argumentList = [];

        $this->checkToUnknownPath();

        $this->loadingPage();
    }

    private function checkToUnknownPath(): void
    {
        if ((!array_key_exists($this->uri, Route::getUrl())) && (!array_key_exists($this->uri, Route::getUrl()['HandlerJS']))) {
            require_once "../templates/404_page.tpl.php";
        }
    }

    /**
     * @throws Exception
     */
    private function loadingPage(): void
    {

        foreach ($this->arguments as $argument => $value) {
            if ($value == null) {
                unset($this->arguments[$argument]);
            } else {
                $this->argumentList[$argument] = $value;
            }
        }

        foreach (Route::getUrl() as $key => $uri) {
            if (array_key_exists($this->uri, Route::getUrl()['HandlerJS'])) {
                foreach (Route::getUrl()['HandlerJS'] as $urlJS) {
                    foreach ($urlJS as $key_method => $value) {
                        if (!array_key_exists($this->HTTPMethod, $urlJS)) {
                            throw new Exception("expected to accept the method $key_method accepted the method $this->HTTPMethod");
                        }
                        if ($this->HTTPMethod === $key_method) {
                            call_user_func('App\Controller\\'. $value, ...$this->arguments);
                        }
                    }
                }
            }
            if ($this->uri === $key) {
                foreach ($uri as $key_method => $value) {
                    if (!array_key_exists($this->HTTPMethod, $uri)) {
                        throw new Exception("expected to accept the method $key_method accepted the method $this->HTTPMethod");
                    }
                    if ($this->HTTPMethod === $key_method) {
                        require_once "../templates/header.tpl.php";
                        require_once "../templates/bar_menu.tpl.php";
                        call_user_func('App\Controller\\'. $value, ...$this->argumentList);
                        require_once "../templates/footer.tpl.php";
                    }
                }
            }
        }
    }
}
