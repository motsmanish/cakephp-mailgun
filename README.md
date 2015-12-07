# CakePHP 3.x Mailgun Transport

Send mail using Mailgun SDK and CakePHP 3.0 (Quick and dirty code for now)

## Requirements

* PHP 5.4+
* Mailgun SDK
* Composer

## Installation Steps

1) Install Mailgun SDK with composer `add "mailgun/mailgun-php" : "1.8"` in require array of composer.json and run `composer update`
2) Copy the file MailgunTransport.php in 'src/Mailer/Transport/' folder
3) Add your mailgun api key and domain as constants (MAILGUN_API_KEY, MAILGUN_API_DOMAIN) in boostrap.php 
4) Add configuration in app.php

```php
'EmailTransport' => [
		'default' => [
			...
		],
		'mailgun' => [
			'className' => 'Mailgun',
		],
	],
	'Email' => [
		'default' => [
			...
		],
		'mailgun' => [
			'transport' => 'mailgun',
			'mailgun_domain' => 'example.com',
			'mailgun_api_key' => 'key-xxxxxxxxxxxxxxxxxxxxxxxxx'
		],
	],
```

And you are good to go.

# Usage

```php

try {
	$email = new Email('mailgun');
	$email->domain(MAILGUN_API_DOMAIN);
	$email->to($to);
	$email->from($from);
	$email->template($template);
	$email->subject($subject);
	$email->emailFormat('both');
	$email->replyTo($replyTo);
	$email->viewVars($vars);
	$result = $email->send();
} catch (Exception $ex) {
	echo $ex->getMessage();
}
```

## Todo

* Add Support for other email parameters (cc,bcc etc)
* Attachments
* Test cases