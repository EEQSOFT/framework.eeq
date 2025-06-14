<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{
    Cache,
    Config,
    CsrfToken,
    Data,
    Email,
    Html,
    Key,
    Manager
};

abstract class Controller
{
    protected readonly Config $config;
    protected readonly Cache $cache;
    protected readonly Data $data;
    protected readonly Key $key;
    protected readonly Email $email;
    protected readonly Html $html;
    protected readonly CsrfToken $csrfToken;
    protected array $database;
    protected array $manager;
    private readonly array $redirects;

    public function __construct()
    {
        $this->redirects = require REDIRECTS_FILE;

        $this->config = new Config();
        $this->cache = new Cache();
        $this->data = new Data();
        $this->key = new Key();
        $this->email = new Email();
        $this->html = new Html();
        $this->csrfToken = new CsrfToken();
    }

    public function setManager(string $name = DEFAULT_DATABASE_NAME): void
    {
        if (!isset($this->manager[$name])) {
            $class = 'App\\Core\\' . DEFAULT_DATABASE_CLASS;

            $this->database[$name] = new $class($name);
            $this->manager[$name] = new Manager($this->database[$name]);

            $this->database[$name]->connect();
        }
    }

    public function getManager(string $name = DEFAULT_DATABASE_NAME): Manager
    {
        $this->setManager($name);

        return $this->manager[$name];
    }

    public function redirectToRoute(string $route): array
    {
        if (isset($this->redirects[$route])) {
            $path = $this->redirects[$route];
        } else {
            $path = '/';
        }

        return ['redirection' => true, 'path' => $path];
    }
}
