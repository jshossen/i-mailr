Rest API Samples
===================

This sample project is a simple web app that you can explore to understand what the payment APIs can do for you.

To try out the sample, run `composer update --no-dev` from the PayPal-PHP-SDK folder and you are all set.

#### Running Samples

##### PHP 5.4 or higher
* If you are running PHP 5.4 or greater, PHP provides a built-in support for hosting PHP sites.
* The fastest way to get it running is
```bash
php -f sample/index.php
```
* This would get the [built-in web server](http://php.net/manual/en/features.commandline.webserver.php) started, and hosted on `http://localhost:5000'

```bash
LM-AUN-00876403:PayPal-PHP-SDK japatel$ php -f sample/index.php
PHP 5.5.14 Development Server started at Wed Nov 19 21:07:52 2014
Listening on http://localhost:5000
Document root is /Users/japatel/Documents/workspace/Server-SDK/PayPal-PHP-SDK/sample
Press Ctrl-C to quit.
[Wed Nov 19 21:07:56 2014] ::1:60826 [200]: /index.php
...
```

##### PHP 5.3 or less

* You could host the entire project in your local web server, by using tools like [MAMP](http://www.mamp.info/en/) or [XAMPP](https://www.apachefriends.org/index.html).
* Once done, you could easily open the samples by opening the matching URL. For e.g.:
`http://localhost/PayPal-PHP-SDK/sample/index.html`

You should see a sample dashboard page as shown below:
![Web Output!](/sample/images/sample_web.png)

#### Running on console
> Please note that there are few samples that requires you to have a working local server, to receive redirects when user accepts/denies PayPal Web flow

* To run samples itself on console, you need to open command prompt, and direct to samples directory.
* Execute the sample php script by using `php -f` command as shown below:
```bat
php -f payments/CreatePaymentUsingSavedCard.php
```

The result would be as shown below:
![Console Output!](/sample/images/sample_console.png)
#### Configuration

The sample comes pre-configured with a test account but in case you need to try them against your account, you must

   * Obtain your client id and client secret from the [developer portal](https://developer.paypal.com/webapps/developer/applications/myapps)
   * Update the [bootstrap.php](https://github.com/paypal/PayPal-PHP-SDK/blob/master/sample/bootstrap.php#L29) file with your new client id and secret.

#### More Help

If you are looking for a full fledged application that uses the new RESTful APIs, check out the Pizza store sample app at https://github.com/paypal/rest-api-sample-app-php
