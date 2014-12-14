```
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 */
```

# Deployer

A simple deployment script designed to deploy KentProjects, and run Unit Tests for the KentProjects sections where
applicable.

## Setup

This collection of scripts will require a small amount of setup.

Namely, creating a `tmp/` folder at this level, and set the permissions so that **www-data** can read and write to it.
If everybody is working under the same user (aka `kentprojects` (like the [production setup script details]
(../production/setup.sh))) then something akin to this will work fine:

```sh
# mkdir tmp
# chmod 775 tmp
# chown kentprojects:www-data tmp
```
