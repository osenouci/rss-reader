<?php
namespace RSSReader\NewsSources\Adapters;

use \RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter;
use \RSSReader\NewsSources\Adapters\Interfaces\NewsAdapter;

class ReutersAdapter implements NewsAdapter {

    /**
     * Used to hold a URL to reuters website
     * @var string
     */
    protected $URL;
    /**
     * Will be appended to all the api calls of reuters to return the data in XML format instead of html
     * @var string
     */
    protected $xmlFormatParameter;
    /**
     * Will hold a mapped `new category name` to `new category URL` collection. We will obtain this by scrapping the
     * reuters' website using XPATH.
     * @var array
     */
    protected $data;

    /**
     * ReutersAdapter constructor.
     * @param string $url
     * @param string $xmlFormatParameter
     *
     * It sets the values for the following properties ReutersAdapter::URL and ReutersAdapter::xmlFormatParameter.
     * @note: Having those two values as parameters will help with testing the class since we can create a dummy
     * page locally and pass its URL to the class.
     */
    public function __construct(string $url, string $xmlFormatParameter)
    {
        $this->URL           = $url;
        $this->xmlFormatParameter = $xmlFormatParameter;
        $this->data      = [];

        $this->readReutersData();

        if(empty($this->data)) {
            throw new Exception("Cannot reach reuters' API. Please check your connectivity!");
        }
    }
    public function setCategoryFormatter(CategoryFormatter $formatter){
        $this->formatter = $formatter;
    }
    /**
     * Scape the main page of reuters API
     */
    protected function readReutersData()
    {
        $dom = new DomDocument;

        libxml_use_internal_errors(true);   // Don't show any errors related to
        $dom->loadHTMLFile($this->URL);     // Load the HTML
        libxml_use_internal_errors(false);  // Restore the value to the default.

        // Create a new XPath object
        $xpath = new DomXPath($dom);

        // Query all <td> nodes containing specified class name 'xmlLink' and get their respective child link.
        $nodes = $xpath->query("//td[@class='xmlLink']/a");

        // Traverse the DOMNodeList object to output each DomNode's nodeValue and href attribute
        foreach ($nodes as $node) {
            $this->data[$node->nodeValue] = $node->getAttribute('href') . $this->xmlFormatParameter;
        }
    }
    /**
     * Returns a list of categories and their URL as an associative array.
     * @example
     * $rtNews = new ReutersAdapter();
     * $result = $rtNews->getCategories();
     * -----------------------------------
     * The output of $result will be:
     * array("Breaking News" => "http://URL_TO_GET THE _BREAKING_NEWS.com",
     *       "sports" => "http://URL_TO_GET THE _SPORTS.com"
     * );
     * -----------------------------------
     * @return array
     */
    public function getCategories():array
    {
        return $this->data;
    }
    /**
     * Returns the home page category in array format. It tries to check if TOP NEW is available, if it is then returns
     * its link. In case it is not available then it checks if `world news` category is available, if it is then it
     * returns its name and url. If non of the two is available then it selects a random category.
     *
     * @return array
     */
    public function getHomePageCategory():string
    {
        $this->formatter->setData(["Top News", "World News"]);
        return $this->formatter->getHomeCategory($this->data);
    }
    /**
     * Returns a boolean value that indicate if the adapter supports categories or not. If the keys are string then it
     * does. If the keys are integers than it does not.
     * @return bool
     */
    public function hasCategories():bool
    {
        if(empty($this->data)) {
            return false;
        }

        return is_string(array_rand($this->data));  // Tests a random key and checks if it is a string or not.
    }
}