The module integrates Magento 2 with the **[Sift](https://sift.com)** fraud detection service.

## How to install
```         
bin/magento maintenance:enable
rm -r composer.lock
composer clear-cache
composer require mage2pro/sift:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy -f en_US <additional locales>
bin/magento maintenance:disable
``` 

## How to setup
See the [manual](manual.md#how-to-setup-the-module).

## How to upgrade
```
bin/magento maintenance:enable
composer remove mage2pro/sift
rm -r composer.lock
composer clear-cache
composer require mage2pro/sift:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy -f en_US <additional locales>
bin/magento maintenance:disable
```