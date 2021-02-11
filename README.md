
# PHP Web Scraper 📖

A simple webscraper which scans a XML file (including it's childs-xmls) and exports the contents of its urls to a json file. You can scrape or clone the data of a complete Wordpress site for example.

You can scrape or clone the data of a complete Wordpress site for example.

## Installation

Add a vcs record to your composer.json (until it's release on packagist).
```json
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ramoneg/scraper"
        }
    ]
```
Install it with **composer require**
```bash
composer require ramoneg/scraper
```
Fire it up with the binary in the vendors/bin folder
```bash
vendor/bin/scraper
```



## Basic Example
### Command
    vendor/bin/scraper --sitemap="https://zen.oceanwp.org/wp-sitemap.xml" --elements="h1,p"
### Result
the resulting json file is stored in the *exports* folder in the package root. (Most likely in vendors/ramoneg/scraper/exports)
```json
{
	"https://zen.oceanwp.org/cras-metus-sed-aliquet-risus-a-tortor/": {
		"title": "Cras metus sed aliquet risus a tortor – Zen",
		"elements": {
			"h1": ["...."],
			"p": ["....", "...."]
		},
		"metaTags": [ "...." ]
	},
	"https://zen.oceanwp.org/quis-ligula-lacinia-aliquet-mauris/": {
		"title": "Cras metus sed aliquet risus a tortor – Zen",
		"elements": {
			"h1": ["...."],
			"p": ["....", "...."]
		},
		"metaTags": [ "...." ]
	},
	
  
  
	"..."
}
```

## Options
| Option | Example | Explenation | Required |
|--|--|--|--|
| sitemap | https://zen.oceanwp.org/wp-sitemap.xml | the target sitemap file. | yes |
| elements | h1,h2,p | the elements which will be stored in the json file. | yes |
| meta-tags | description,twitter:creator | the meta fields which will be stored in the json file. | no |
| inside-class | page-content | only fetch elements from withing this class | no |
| exclude | https://zen.oceanwp.org/blog/,https://zen.oceanwp.org/about-us/ | exclude urls from scraping (**adds wildcard at the end!**). | no |


## Socials
| Social | Url
|--|--|
| LinkedIn | https://www.linkedin.com/in/ramon-egger-7509a4123/
| Instagram | https://instagram.com/aintroman
| RACERFISH | https://racerfish.com
