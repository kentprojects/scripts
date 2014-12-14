<?php
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 */
namespace Deployer;

/**
 * If this is a PUSH event, check the state.
 * - If it's a commit, and for the develop branch, run the develop branch tests and then deploy.
 * - If it's a commit, and for the master branch, run the master branch tests and then deploy.
 * - Otherwise do nothing.
 * Otherwise, run the tests for develop and master and deploy, because clearly this is being run by hand.
 *
 * Unlike `run.php`, this script is designed to be completely headless.
 */

try
{
	require_once __DIR__ . "/main.php";
}
catch (\Exception $e)
{

}