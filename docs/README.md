Configuring zarth.us
====


The first thing you want to do is configure MySQL and Apache.
* **REQUIRED:** [Making a MySQL user for the database credentials you used](mysql.md)
* **REQUIRED:** [Configuring Apache](apache.md)

After configuring apache and mysql, the next thing you want to do when configuring zarth.us, is copy the config.default.php file to config.php in [/zarth.us/includes/php/](../zarth.us/includes/php/config.default.php)
A lot of things in the default configuration are not yet configured, but here is a list of things you *can* configure:  
* **REQUIRED:** [The database](../zarth.us/includes/php/config.default.php#L23-L27) | [Docs](database.md)
* *RECOMMENDED:* [Set up Google Analytics](../zarth.us/includes/php/config.default.php#L64-L72) | [Docs](google_analytics.md)
* *RECOMMENDED:* [Your navigation bar](../zarth.us/includes/php/config.default.php#L83-L191) | [Docs](navbar.md)
* OPTIONAL: [Your developers and production environment](../zarth.us/includes/php/config.default.php#L30-L39) | [Docs](environment.md)
* OPTIONAL: [The website defaults, title, meta description, etc.](../zarth.us/includes/php/config.default.php#L30-L39) | [Docs](website.md)
* OPTIONAL: [Display Last.FM data on your home page](../zarth.us/includes/php/config.default.php#L53-L62) | [Docs](lastfm.md)

Optionally, you can look at the configuration for [h5ai](http://larsjung.de/h5ai/)
* *RECOMMENDED:* [Configure Google Analytics for h5ai](../_h5ai/conf/options.json#L143-L159)
* For the rest, the default configuration is okay, it's well documented so I suggest you take a look at it yourself.