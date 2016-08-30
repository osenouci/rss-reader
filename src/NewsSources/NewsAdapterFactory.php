<?php
namespace RSSReader\NewsSources;

use RSSReader\NewsSources\Adapters\Interfaces\NewsAdapter;
use RSSReader\NewsSources\Adapters\NewsApiAdapter;
use RSSReader\NewsSources\Adapters\ReutersAdapter;
use RSSReader\NewsSources\Formatters\BasicCategoryFormatter;

class NewsAdapterFactory {

    const REUTERS  = "REUTERS_ADAPTER";
    const NEWS_API = "NEWS_API_ADAPTER";

    protected $activeNewSource = "";

    public function getSource (string $type, \RSSReader\Storage\Interfaces\Storage $storage) : NewsAdapter
    {
        if(!empty($storage->getNewsSource())){

            $type = $storage->getNewsSource();
        }

        if(!$this->isValidSource($type)){
            throw new Exception("Undefined type: {$type}");
        }
        $this->activeNewSource = $type;

        if($type == self::NEWS_API) {

            $formatter = new BasicCategoryFormatter();
            $adapter = new NewsApiAdapter(URL_NEWSAPI_API);
            $adapter->setCategoryFormatter($formatter);
            $storage->setNewsSource($type);

            return $adapter;
        }

        if($type == self::REUTERS) {

            $formatter = new BasicCategoryFormatter();
            $adapter = new ReutersAdapter(URL_REUTERS_API, REUTERS_XML_FORMAT_PARAMETER);
            $adapter->setCategoryFormatter($formatter);
            $storage->setNewsSource($type);

            return $adapter;
        }
    }
    public function listSources() {
        return [["key" => self::REUTERS, "name" => "Reuters"], ["key" => self::NEWS_API, "name" => "NewsAPI"]];
    }
    public function isValidSource($source):bool {
        $sources = $this->listSources();

        foreach($sources as $key => $value) {

            if(strtolower($source) == strtolower($sources[$key]["key"])) {
                return true;
            }
        }

        return false;
    }
    public function getSelectedNewsSource() {
        return $this->activeNewSource;
    }
}