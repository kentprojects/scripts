```
/**
 * @author: KentProjects <developer@kentprojects.com>
 * @license: Copyright KentProjects
 * @link: http://kentprojects.com
 */
```

# Setting up a KentProjects production environment

Well. This bit is meant to be fun!

At the moment, you can grab any [Ubuntu 14.04 LTS](http://www.ubuntu.com/download/server) server image and run the
following command:

```bash
curl -L https://raw.githubusercontent.com/kentprojects/api/develop/vagrant/production/setup.sh | sh
```

This will run the [setup script](./setup.sh) and configure a `kentprojects` user for you and your team to use.

Place any public keys in the [`keys.txt` file](./keys.txt) so you'll be able to `ssh` into the server as the
`kentprojects` user!

See [SimpleSAML.md](./simplesaml.md) for information on setting up Single Sign-On.