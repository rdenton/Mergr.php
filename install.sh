#!/bin/bash

FILE="/tmp/out.$$"
GREP="/bin/grep"

#Only root can install mergr.
if [[ $EUID -ne 0 ]]; then
   echo "Sorry, you need root permissions to install Mergr." 1>&2
   exit 1
fi

mkdir /var/lib/mergr
mkdir /var/lib/mergr/plugins

cp build/mergr.php /var/lib/mergr/mergr.php
cp src/plugins /var/lib/mergr -R

ln -s /var/lib/mergr/mergr.php /usr/bin/mergr
chmod +x /usr/bin/mergr

echo "Install complete. Type mergr --help for more information." 1>&2
exit 1
