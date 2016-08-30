<?php
namespace RSSReader\Storage\Interfaces;

interface Storage {

    public function getFavoriteCategories():array;
    public function addFavoriteCategory(string $name);
    public function removeFavoriteCategory(string $name);
    public function clearFavoriteCategory();

    public function getNewsSource():string;
    public function setNewsSource(string $value);

    public function setActiveNewsSource(string $value);
    public function getActiveNewsSource():string;
}