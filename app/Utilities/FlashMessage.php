<?php

namespace App\Utilities;

class FlashMessage
{
    const SUCCESS = 0;
    const INFO = 1;
    const WARNING = 2;
    const DANGER = 3;

    const MESSAGE_ADDON = [
        self::SUCCESS => 'Berhasil!',
        self::INFO => 'Informasi:',
        self::WARNING => 'Perhatian!',
        self::DANGER => 'Terjadi Kesalahan!',
    ];

    const MESSAGE_LEVEL = [
        self::SUCCESS => 'success',
        self::INFO => 'info',
        self::WARNING => 'warning',
        self::DANGER => 'danger',
    ];

    protected $message;

    protected $type;

    protected $level;

    protected $addon;

    public function __construct($message, int $type)
    {
        $this->message = $message;
        $this->type = $type;
        $this->level = self::MESSAGE_LEVEL[$type];
        $this->addon = self::MESSAGE_ADDON[$type];
    }

    public function __get($name)
    {
        return $this->$name ?? null;
    }
}