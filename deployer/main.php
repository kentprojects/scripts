<?php
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 */
namespace Deployer;
if (!defined("METHOD"))
{
	exit("");
}
require_once __DIR__ . "/classes.php";
/**
 * The main routine for deployment.
 *
 * 1) Check out the repository in a certain folder.
 * 2) Run the tests of that repository, looking for a `tests/run.sh`.
 * 3) Handle the results effectively.
 */