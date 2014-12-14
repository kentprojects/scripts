<?php
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 */
namespace Deployer;

require_once __DIR__ . "/phpmailer.smtp.php";
require_once __DIR__ . "/phpmailer.php";

/**
 * Class CommandException
 *
 * @package Deployer
 */
class CommandException extends \Exception
{
	/**
	 * @param string $error
	 * @param string $command
	 * @param int $exit
	 * @param \Exception $previous
	 */
	public function __construct($error, $command, $exit, \Exception $previous = null)
	{
		parent::__construct(
			"An error occurred running '{$command}' with exit code '{$exit}': {$error}", $exit, $previous
		);
	}
}

class Mail extends \PHPMailer
{
	public function __construct($subject, $body)
	{
		/**
		 * Tell PHPMailer to use SMTP
		 */
		$this->isSMTP();
		/**
		 * Enable SMTP debugging
		 * 0 = off (for production use)
		 * 1 = client messages
		 * 2 = client and server messages
		 */
		$this->SMTPDebug = 2;

		/**
		 * Set the login details of the sender.
		 */
		$this->Host = "smtp.gmail.com";
		$this->Port = 587;
		$this->SMTPSecure = "tls";
		$this->Username = "bot@kentprojects.com";
		$this->Password = "band-lay-exclaimed-cent";
		$this->setFrom("bot@kentprojects.com", "KentProjects Server");
		$this->addReplyTo("developer@kentprojects.com", "KentProjects Developers");
		$this->addAddress("developer@kentprojects.com", "KentProjects Developers");

		$this->Subject = $subject;
	}
}

/**
 * Class MailException
 *
 * @package Deployer
 */
class MailException extends \Exception
{
	/**
	 * @var string
	 */
	protected $body;
	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @param string $subject
	 * @param string $body
	 * @param \Exception $previous
	 */
	public function __construct($subject, $body, \Exception $previous = null)
	{
		parent::__construct("Sending an email: " . $subject . ": " . $body, 0, $previous);
	}

	/**
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}
}

/**
 * Class TestException
 *
 * @package Deployer
 */
class TestException extends \Exception
{

}

/**
 * Run a command on the command line.
 *
 * @param string $command
 * @param string $error
 * @throws CommandException
 * @return void
 */
function run($command, $error)
{
	$exit = 0;
	passthru($command, $exit);
	if ($exit > 0)
	{
		throw new CommandException($error, $command, $exit);
	}
}