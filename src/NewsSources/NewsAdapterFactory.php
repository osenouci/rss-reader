<?php
namespace RSSReader\NewsSources;

use RSSReader\NewsSources\Adapters\Interfaces\NewsAdapter;
use RSSReader\NewsSources\Adapters\NewsApiAdapter;
use RSSReader\NewsSources\Adapters\ReutersAdapter;
use RSSReader\NewsSources\Formatters\BasicCategoryFormatter;

class NewsAdapterFactory {

    const REUTERS  = "REUTERS_ADAPTER";
    const NEWS_API = "NEWS_API_ADAPTER";

    public static function getSource (string $type, \RSSReader\Storage\Interfaces\Storage $storage) : NewsAdapter
    {
        if(!empty($storage->getNewsSource())){
            $type = $storage->getNewsSource();
        }

        if($type == self::NEWS_API) {

            $formatter = new BasicCategoryFormatter();
            $adapter = new NewsApiAdapter(URL_NEWSAPI_API);
            $adapter->setCategoryFormatter($formatter);

            $storage->setNewsSource(self::NEWS_API);
            return $adapter;
        }

        if($type == self::REUTERS) {

            $formatter = new BasicCategoryFormatter();
            $adapter = new ReutersAdapter(URL_REUTERS_API, REUTERS_XML_FORMAT_PARAMETER);
            $adapter->setCategoryFormatter($formatter);

            $storage->setNewsSource(self::REUTERS);

            return $adapter;
        }

        throw new Exception("Undefined type: {$type}");
    }
    public static function listSources() {
        return [self::REUTERS => "Reuters", self::NEWS_API => "NewsAPI"];
    }
    public static function isValidSource($source):bool {
        $sources = self::listSources();
        foreach($sources as $key => $value) {

            if(strtolower($source) == strtolower($key)) {
                return true;
            }
        }

        return false;
    }
}