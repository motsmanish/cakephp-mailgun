# CakePHP 3.x Mailgun Transport

Send mail via Mailgun SDK in CakePHP 3.0

## Requirements

* PHP 5.4+
* Mailgun SDK ~1.7.2
* CakePHP 3.x

## Installation Steps

* 1) Install using composer 

```PHP
composer require motsmanish/cakephp-mailgun
```

* 2) Updated configuration in app.php

```php
'EmailTransport' => [
		'default' => [
			...
		],
		'mailgun' => [
			 'className' => 'MailgunEmail\Mailer\Transport\MailgunTransport'
		],
	],
	'Email' => [
		'default' => [
			...
		],
		'mailgun' => [
			'transport' => 'mailgun',
			'mailgun_domain' => 'example.com', //required
			'mailgun_api_key' => 'key-xxxxxxxxxxxxxxxxxxxxxxxxx',  //required
			'mailgun_postbin_id' => '' //optional, provide postbin id only when you want to debug messages on http://bin.mailgun.net/ instead of actually sending
		],
	],
```

And you are good to go.

# Usage

```php

// load Email class
use Cake\Mailer\Email;

// send mail by setting all the required properties 
$email = new Email('mailgun');
$result = $email->from(['me@example.com' => 'My Site'])
	->to('you@example.com')
	->subject('Hello')
	
	//->template('get_in_touch')
	//->viewVars(['to' => 'You', 'from' => 'Me'])
	//->emailFormat('both')
	
	->addHeaders(['o:tag' => 'testing'])
	->addHeaders(['o:deliverytime' => strtotime('+1 Min')])
	->addHeaders(['v:my-custom-data' => json_encode(['max' => 'testing'])])
	
	->readReceipt('admin@example.com')
	->returnPath('bounce@example.com')
	
	->attachments([
		'cake_icon1.png' => Configure::read('App.imageBaseUrl') . 'cake.icon.png',
		'cake_icon2.png' => ['file' => Configure::read('App.imageBaseUrl') . 'cake.icon.png'],
		WWW_ROOT . 'favicon.ico'
	])
	
	->send('How are you?');

```
