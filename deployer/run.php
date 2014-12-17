#!/usr/bin/php
<?php
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 */
namespace Deployer;

/**
 * If we have arguments, then
 * - If the argument is for the develop branch, run the develop branch tests and deploy.
 * - If the argument is for the master branch, run the master branch tests and deploy.
 * - Otherwise, run all the tests and deploy.
 * Otherwise, run all the tests and deploy.
 *
 * Unlike `listen.php`, this script will display the relevant output rather than emailing it.
 * (Unless a command line argument is set *wink*)
 */

define("METHOD", "run");

try
{
	require_once __DIR__ . "/main.php";
}
catch (\Exception $e)
{

}