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

	/**
	 * Send email via Mailgun SDK
	 *
	 * @param Email $email
	 * @return array
	 * @throws Exception
	 */
	public function send(Email $email)
	{
		$config = $email->profile();

		$headers = $email->getHeaders(['from', 'replyTo', 'to']);
		$subject = $email->subject();

		$message['html'] = $email->message(Email::MESSAGE_HTML);
		$message['text'] = $email->message(Email::MESSAGE_TEXT);

		try {
			$params = array(
				'from' => $headers['From'],
				'to' => $headers['To'],
				'h:reply-to' => $headers['Reply-To'],
				'subject' => $subject,
				'text' => $message['text'],
				'html' => $message['html']
			);

			$mailgun = new Mailgun\Mailgun($config['mailgun_api_key']);
			$result = $mailgun->sendMessage($config['mailgun_domain'], $params);

			if ($result->http_response_code != 200) {
				throw new Exception($result->http_response_body->message);
			}
		} catch (Exception $exc) {
			throw $exc;
		}

		return $result;
	}

}