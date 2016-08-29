<?php
namespace RSSReader\NewsSources\Formatters\Interfaces;
interface CategoryFormatter {
    public function setData    (array $data);
    public function getHomeCategory(array $categories):string;
    public function formatCategory ():array;
}