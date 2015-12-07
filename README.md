# CakePHP 3.x Mailgun Transport

Send mail via Mailgun SDK in CakePHP 3.0

## Requirements

* PHP 5.4+
* Mailgun SDK
* Composer

## Installation Steps

* 1) Install Mailgun SDK with composer `add "mailgun/mailgun-php" : "1.8"` in require array of composer.json and run `composer update`
* 2) Copy the file MailgunTransport.php in 'src/Mailer/Transport/' folder
* 3) Add configuration in app.php

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

$email = new Email('mailgun');
$result = $email->from(['me@example.com' => 'My Site'])
	->to('you@example.com')
	->subject('Hello')
	->template('get_in_touch')
	->emailFormat('both')
	->viewVars(['to' => 'You', 'from' => 'Me'])
	->addHeaders(['o:tag' => 'testing'])
	->addHeaders(['v:my-custom-data' => json_encode(['max' => 'testing'])])
	->readReceipt('admin@example.com')
	->returnPath('bounce@example.com')
	->send('How are you?');

```

## Todo

* Attachments
* Test cases