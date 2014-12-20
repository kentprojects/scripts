# Build An API Box

## Parallels

First of all, run:

```sh
$ vagrant up --provider parallels
```

Once the box has finished booting, login to the box and install / configure whatever you'd like, most likely by running
[`sh provision.sh`](./provision.sh), then exit the box and `halt` it.

Next, modify `metadata.json` in this folder and ensure the `provider` is set correctly:

```json
{
	"provider": "parallels"
}
```

Next, identify the `.pvm` of your virtual machine (by default in `~/Documents/Parallels`, and run the following commands
(replacing the `.pvm` name with that of your Virtual Machine).

```sh
$ prl_disk_tool compact --hdd ~/Documents/Parallels/kentprojects-api.pvm/harddisk.hdd
$ tar cvzf kentprojects-api-010-parallels.box ~/Documents/Parallels/kentprojects-api.pvm ./metadata.json
```

## VirtualBox

First of all, run:

```sh
$ vagrant up --provider virtualbox
```

Once the box has finished booting, login to the box and install / configure whatever you'd like, most likely by running [`provision.sh`](./provision.sh), then exit the box.

Finally, simply run:

```sh
$ vagrant package --output {name-of-package}.box
```
