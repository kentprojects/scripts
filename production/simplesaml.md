# KentProjects &raquo; SimpleSAML

Setting up SimpleSAML for KentProjects is a little complicated but worth it!

## Installation

Get the latest copy of the code from the [SimpleSAML downloads page](https://simplesamlphp.org/download).
 These instructions expect this to be run on our production KentProjects setup, thus the `kentprojects` user will exist.

### Files

```sh
# cd /var/www
# wget {URL of latest stable release}
# tar -xzf simplesamlphp-1.x.y.tar.gz
# mv simplesamlphp-1.x.y simplesaml
# chown -R kentprojects:kentprojects simplesaml
# chown -R kentprojects:www-data simplesaml/www
```

### Apache

The [Production Apache Config](./apache.02.live.conf) already includes an alias to the SimpleSAML folder.

### Configuration

Now we need to make a few changes to `config/config.php`:

```
'auth.adminpassword' => 'somecleverimportantpassword',
```

Generate a random salt using the following command:

```
$ tr -c -d '0123456789abcdefghijklmnopqrstuvwxyz' </dev/urandom | dd bs=32 count=1 2>/dev/null;echo
```

And place it in `config/config.php`:

```
'secretsalt' => 'randombytesinsertedhere',
```

Set the technical contact information:

```
'technicalcontact_name' => 'KentProjects Developers',
'technicalcontact_email' => 'developer@kentprojects.com',
```

And finally, set the timezone:

```
'timezone' => 'Europe/London',
```

### Sanity Check

Next, copy the Sanity Check module configuration to enable a sanity check:

```sh
$ cp /var/www/simplesaml/modules/sanitycheck/config-templates/config-sanitycheck.php /var/www/simplesaml/config/
```

And set `cron_tag` to `NULL` if you wish to disable the CRON check (desired).

## Setting up as a Service Provider

This requires information from the Kent SSO IDP service. Please get in contact with them to get the SAML2 Federation
 details.

Once you have the details, generate a key for the service provider:

```sh
$ cd /var/www/simplesaml
$ mkdir cert
$ openssl req -newkey rsa:2048 -new -x509 -days 3652 -nodes -text -out cert/saml.crt -keyout cert/saml.key
```

Next, edit `config/authsources.php` and replace the `default-sp` with the following:

```
"default-sp" => array(
	"saml:SP",
	"privatekey" => "saml.key",
	"certificate" => "saml.crt",
	"idp" => "https://sso.id.kent.ac.uk/idp",
),
```

And take the PHP output for the `$metadata` array (this can either be given to you by the Kent SSO team OR SimpleSAML
 can generate the contents of the `$metadata` array for you (via the `Federation` tab, then `XML to simpleSAMLphp
 metadata converter`).

It should start with:

```php
<?php
$metadata["https://sso.id.kent.ac.uk/idp"] = array(
	// Exceptional amount of data.
);
```

## And in your application

```php
<?php
require_once("/var/www/simplesaml/lib/_autoload.php");
$sp = new SimpleSAML_Auth_Simple("default-sp");
$sp->requireAuth();
$attributes = $sp->getAttributes();
print_r($attributes);
```