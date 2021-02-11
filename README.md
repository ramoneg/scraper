
# PHP Web Scraper 📖

A simple webscraper which scans a XML file (including it's childs-xmls) and exports the contents of its urls to a json file. You can scrape or clone the data of a complete Wordpress site for example.

You can scrape or clone the data of a complete Wordpress site for example.

## Basic Example
### Command
    ./scraper --sitemap="https://zen.oceanwp.org/wp-sitemap.xml" --elements="h1,p"
### Result
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


## Socials
| Social | Url
|--|--|
| LinkedIn | https://www.linkedin.com/in/ramon-egger-7509a4123/
| Instagram | https://instagram.com/aintroman
| RACERFISH | https://racerfish.com
