# Build An API Box

## Parallels

First of all, run:

```sh
$ vagrant up --provider parallels
```

Once the box has finished booting, login to the box and install / configure whatever you'd like, most likely by running [`provision.sh`](./provision.sh), then exit the box and
`halt` it.

Next, create `metadata.json` in this folder with the following contents:
      
```json
{
	"provider": "parallels"
}
```

Next, identify the `.pvm` of your virtual machine (by default in `~/Documents/Parallels`, and run the following commands
(replacing the `.pvm` name with that of your Virtual Machine).

```sh
$ prl_disk_tool compact --hdd ~/Documents/Parallels/api_default_1418771862967_54865.pvm/harddisk.hdd
$ tar cvzf kentprojects-api-010-parallels.box ~/Documents/Parallels/api_default_1418771862967_54865.pvm ./Vagrantfile ./metadata.json
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
