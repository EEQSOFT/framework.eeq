<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{
    Cache,
    Config,
    CsrfToken,
    Data,
    Database,
    Email,
    Html,
    Key,
    Manager
};

abstract class Controller
{
    protected Config $config;
    protected Cache $cache;
    protected Data $data;
    protected Key $key;
    protected Email $email;
    protected Html $html;
    protected CsrfToken $csrfToken;
    protected array $database;
    protected array $manager;
    private array $redirects;

    public function __construct()
    {
        $this->redirects = require(REDIRECTS_FILE);

        $this->config = new Config();
        $this->cache = new Cache();
        $this->data = new Data();
        $this->key = new Key();
        $this->email = new Email();
        $this->html = new Html();
        $this->csrfToken = new CsrfToken();
    }

    public function setManager(int|string $name = 0): void
    {
        if (!isset($this->manager[$name])) {
            $this->database[$name] = new Database($name);
            $this->manager[$name] = new Manager($this->database[$name]);

            $this->database[$name]->dbConnect();
        }
    }

    public function getManager(int|string $name = 0): Manager
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
