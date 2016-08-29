<?php
namespace RSSReader\Storage\Interfaces;

interface Storage {

    public function AddFavoriteCategory(string $name):array;
    public function RemoveFavoriteCategory(string $name);
    public function ClearFavoriteCategory();

    public function getNewsSource():string;
    public function setNewsSource(string $value);
}