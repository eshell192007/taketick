# TakeTick
[TakeTick](http://taketick.com) is open source, laravel based helpdesk software.

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=26KXARS236B8W)

## Documentation

### Installation

To install just clone repository and update `bower` and `composer`.

```$bash
git clone https://github.com/zuffik/taketick.git path/to/project
cd path/to/project
bower update
# publishing vendors and migrations are ensured in
# composer post-install and post-update commands
composer update
```

### Requirements

This project requires php BCMath extension (see [HashIds package](https://github.com/ivanakimov/hashids.php)) and
also php mailparse extension (see [PHP mail parser](https://github.com/php-mime-mail-parser/php-mime-mail-parser)). 

## Contribution
If you want to contribute to this project you can simply do it by pull requests.

## Donation
If you like this project feel free to donate:

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=26KXARS236B8W)