<?php
namespace RSSReader\Storage;

use RSSReader\Storage\Interfaces\Storage;

class StorageFactory {

    const COOKIE_STORAGE  = "COOKIE_STORAGE";
    const SESSION_STORAGE = "SESSION_STORAGE";

    public static function getStorage(string $type)
    {
        if($type == self::COOKIE_STORAGE) {
            return new CookieStorage();
        }

        if($type == self::SESSION_STORAGE) {
            return new SessionStorage();
        }

        throw new \Exception("The request storage engine is not available or has not been defined: {$type}");
    }

}
