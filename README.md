<h1 align="center">Sylius Order Email Admin from Plugin Skeleton</h1>

<p align="center">Send an email when an order has payed with all order item and informations of customer.</p>

## Installation

* Run `composer require fmdd/sylius-email-order-admin`.

* Add Bundle in your kernel 
```bash
    ...
    FMDD\SyliusEmailOrderAdminPlugin\FMDDSyliusEmailOrderAdminPlugin::class => ['all' => true],
    ...
```

* Import ressource.
```bash 
#config/packages/_sylius.yaml
imports:
    ...
    - { resource: "@FMDDSyliusEmailOrderAdminPlugin/Resources/config/config.yml"}
```
* Config Parameter.
```bash
#config/services.yaml
parameters:
    ...
    email.admins: ['email.admins@defined.com', 'secondly@defined.com']
```

* Test Email `php bin/console fmdd:email:order:admin --env=dev --locale=en`

## Translations available :
* FR
* EN
* NL

## Plugin Development 
<p align="center">Skeleton for starting Sylius plugins.</p>

2. From the plugin skeleton root directory, run the following commands:

    ```bash
    $ (cd tests/Application && yarn install)
    $ (cd tests/Application && yarn build)
    $ (cd tests/Application && bin/console assets:install public -e test)
    
    $ (cd tests/Application && bin/console doctrine:database:create -e test)
    $ (cd tests/Application && bin/console doctrine:schema:create -e test)
    ```

To be able to setup a plugin's database, remember to configure you database credentials in `tests/Application/.env` and `tests/Application/.env.test`.

## Usage

### Running plugin tests

  - PHPUnit

    ```bash
    $ vendor/bin/phpunit
    ```

  - PHPSpec

    ```bash
    $ vendor/bin/phpspec run
    ```

  - Behat (non-JS scenarios)

    ```bash
    $ vendor/bin/behat --tags="~@javascript"
    ```

  - Behat (JS scenarios)
 
    1. Download [Chromedriver](https://sites.google.com/a/chromium.org/chromedriver/)
    
    2. Download [Selenium Standalone Server](https://www.seleniumhq.org/download/).
    
    2. Run Selenium server with previously downloaded Chromedriver:
    
        ```bash
        $ java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-standalone.jar
        ```
        
    3. Run test application's webserver on `localhost:8080`:
    
        ```bash
        $ (cd tests/Application && bin/console server:run localhost:8080 -d public -e test)
        ```
    
    4. Run Behat:
    
        ```bash
        $ vendor/bin/behat --tags="@javascript"
        ```

### Opening Sylius with your plugin

- Using `test` environment:

    ```bash
    $ (cd tests/Application && bin/console sylius:fixtures:load -e test)
    $ (cd tests/Application && bin/console server:run -d public -e test)
    ```
    
- Using `dev` environment:

    ```bash
    $ (cd tests/Application && bin/console sylius:fixtures:load -e dev)
    $ (cd tests/Application && bin/console server:run -d public -e dev)
    ```
