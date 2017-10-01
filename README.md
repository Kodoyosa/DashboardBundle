KodoyosaDashboardBundle
=========

Dashboard Bundle for symfony >= 3.3

####Requirements :

(for both following requirements, see 3. for configuration example)

* Assetic bundle :
    http://symfony.com/doc/current/assetic/asset_management.html
    
* twbs/bootstrap 4.0.0-alpha.6

    * add `"twbs/bootstrap": "4.0.0-alpha.6"` to your composer.json
    * then run `composer update`

####Steps :

1) `php bin/console doctrine:schema:update --force`

2) Assetic configuration in config.yml
    
        # Assetic Configuration
        assetic:
            filters:
                cssrewrite: ~
            assets:
                bootstrap_js:
                    inputs:
                        - '%kernel.root_dir%/../vendor/twbs/bootstrap/dist/js/bootstrap.js'
                bootstrap_css:
                    inputs:
                        - '%kernel.root_dir%/../vendor/twbs/bootstrap/dist/css/bootstrap.min.css'
                        - '%kernel.root_dir%/../vendor/twbs/bootstrap/dist/css/bootstrap-grid.min.css'
                        - '%kernel.root_dir%/../vendor/twbs/bootstrap/dist/css/bootstrap-reboot.min.css'
                        
3) run `php bin/console assetic:dump
`

4) (optionnal) Change `prefix:   /` in /app/config/routing.yml for the Dashboard 