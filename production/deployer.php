<?php
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 *
 * A simple script to automatically deploy the repositories.
 * The permissions are all fine because the original checkout was made by the Apache user.
 * `sudo -u www-data` is a real life saver.
 *
 * This script will also run any potential tests, to ensure that we are deploying safe versions of the code.
 * I am yet to determine how it will email results, but hey-ho it's in the design.'
 */
/**
 * Class CommandException
 * Represents an error when running a command on the command line.
 */
class CommandException extends Exception
{
	public function __construct($error, $command, $exit)
	{
		parent::__construct("An error occurred running '{$command}' with exit code '{$exit}': {$error}", $exit);
	}
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

$baseurl = "/var/www";
$directories = array(
	"kentprojects-api", "kentprojects-web",
	"kentprojects-api-dev", "kentprojects-web-dev",
);

header("Content-Type: text/plain");
try
{
	ob_start();
	foreach ($directories as $directory)
	{
		$pwd = "{$baseurl}/{$directory}";
		$tmp = "{$baseurl}/tmp/{$directory}";

		run("cd {$baseurl}", "There was an error switching to the base directory.");

		echo $pwd, PHP_EOL;

		if (is_dir("{$baseurl}/tmp"))
		{
			$repository = "https://github.com/" . str_replace(array("-dev", "-"), array("", "/"), $directory);
			run("mkdir -p {$tmp}", "Unable to create the temporary directory.");
			run("cd {$tmp}", "Unable to switch to the temporary directory.");
			run("git clone {$repository} {$tmp}", "Unable to clone the git repository.");
			if (strpos($directory, "-dev") !== false)
			{
				run("git fetch && git checkout develop", "Unable to checkout the develop branch.");
			}
			if (file_exists("{$tmp}/tests/run.sh"))
			{
				run("sh {$tmp}/tests/run.sh", "Unable to run / complete all of the tests.");
			}
			run("rm -rf {$tmp}", "Unable to remove the temporary directory.");
		}

		run("cd {$pwd} && git pull", "Unable to pull to the latest revision.");
		if (file_exists("{$pwd}/docs"))
		{
			run("cd {$pwd}/docs && jekyll build", "Unable to build the documentation.");
		}
	}
	$output = ob_get_clean();
}
catch (Exception $e)
{
	$output = $e . PHP_EOL . 
		"Here is all the output up to the point the error occurred: " . PHP_EOL . 
		ob_get_clean();
}
echo $output;
