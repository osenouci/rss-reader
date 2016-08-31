# RSS Reader
Simple news RSS Reader that is capable of reading news from several news API. 
It currently can read from two APIs:
* [reuters.com](reuters.com)
* [newsapi.org](https://newsapi.org)

```
Please note: It was not possible to use Google's news API as it has been dupricated and taken out of service.
```
## 1) Introduction
The project has been divided into two parts:
* API that serves the news. (Based on SLIM Framework mainly)
* Stand alone user UI. (Created using Redux, react and bootstrap - Compiled using webpack)

### 1.1) Feature list
The RSS Reader has the following feature:
* Display news articles.
* Display categories that we can use to view different type of articles for example sports or economy.
* We can change the news source.
* We can select a favorite category by clicking on the star on its life. When we revisit the RSS Reader
or refresh the page, the content of the favorite category will be displayed in the home page.
* Device friendly. Works on Desktop, tablets and mobile phones.

## 2) Web API (SLIM based)
Based of SLIM. It uses different request methods (GET, POST, PUT and DELETE) to carry out operations. 
It can be easily extended to support more news APIs.

### 2.1) Requirements
In order to run the API the following are required:
* A web server like Apache (CROS capable).
* Composer to install the required packages like SLIM framework.
* Enable mode rewrite on the server.
* PHP 7.

### 2.2) Installation
1. Download the source code git.
2. Extract it and configure your web server to run it. (See the slim website for more information)
3. Using the command line navigate to the `rss-reader` directory and install the require packages using 
compose by issuing the following command

```
composer install
```
4. You're done.

### 2.3) News adapters

Currently the RSS Reader supports:
* [reuters.com](reuters.com)
* [newsapi.org](https://newsapi.org)

If you would you like to extend by adding more news sources then create a news adapter by implementing the following
interface:
```
RSSReader\NewsSources\Adapters\Interfaces\NewsAdapter
```

And finally add your `Adapter` to the Adapter factory:
```
RSSReader\NewsSources\NewsAdapterFactory
```

## 3) RSS client UI
The client is a stand alone HTML page. The page can be run in one of two ways:
1. Can be served to the audience using a web server like apache. 
2. Easy way: `Can be simply downloaded to the desktop and run it in a browser.` 

The stand alone page has been created using:
* react
* Redux
* Bootstrap
* Webpack (Translates ES6 to ES5 and also compresses the JS code into a single file.)

The stand alone client page location:
```
/rss-reader/public/index.html
```
### 3.1) Install, compile and run the page (Optional)

`NMP` is required to install the required packages to run the page.
Once `NPM` has been installed, navigate to the UI's src directory and install the required packages:
```
cd rss-reader/src_ui/
npm install
```

Once `npm` has finished installing the different packages, you will be able to run `webpack-dev-server`
 and acces the page from the server.
Just run the following command 
```
webpack-dev-server
``` 
You will be able to access the page by opening a browser and visitng localhost:8080.

If you want to build the JS package only without having to run the sevrer then execute:
```
webpack
``` 


## 4) Possible improvements
* Added unit tests to SLIM and (redux+react).
* Add error messages system. Currently the Stand alone page goes bananas if the API is not running. 
I did not have time to manage the such errors.
* Compress the style sheets and the JS files of the UI client.
* Use actors to execute several action in a row.