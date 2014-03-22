Apache2 configuration
======

A few things will need to be modified in Apache's configuration.

* **Enable mod rewrite**: zarth.us makes use of `mod_rewrite`, so you'll need to enable that with `sudo a2enmod rewrite`.  
* **Configure h5ai and (and maybe even) home.php as DirectoryIndex**: In `apache.conf`, set `DirectoryIndex index.html index.php home.php /_h5ai/server/php/index.php`.  
* **Restart apache**: Follow up by restarting apache with `sudo service apache2 restart`