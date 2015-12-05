<?php

namespace Cake\Mailer\Transport;

use Cake\Mailer\AbstractTransport;
use Cake\Mailer\Email;
use Mailgun;

/**
 * Send mail using Mailgun
 * @author Manish Motwani
 */
class MailgunTransport extends AbstractTransport
{

	public function send(Email $email)
	{
		$headers = $email->getHeaders(['from', 'replyTo', 'to']);
		$subject = $email->subject();
		$message['html'] = $email->message(Email::MESSAGE_HTML);
		$message['text'] = $email->message(Email::MESSAGE_TEXT);

		try {
			$response = $this->_mailgun($subject, $message, $headers);
			$error = null;
		} catch (Exception $exc) {
			$response = false;
			$error = $exc->getMessage();
		}
		return ['headers' => $headers, 'message' => $message, 'response' => $response, 'error' => $error];
	}

	protected function _mailgun($subject, $message, $headers)
	{
		$params = array(
			'from' => $headers['From'],
			'to' => $headers['To'],
			'h:reply-to' => $headers['Reply-To'],
			'subject' => $subject,
			'text' => $message['text'],
			'html' => $message['html']
		);

		$email = new Mailgun\Mailgun(MAILGUN_API_KEY);
		$result = $email->sendMessage(MAILGUN_API_DOMAIN, $params);
		$response = ($result->http_response_code == 200) ? true : false;
		return $response;
	}
}
