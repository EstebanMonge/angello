# Angello
Simple starving hacker IP management

This HTML and PHP front end allows you to show nmap XML reports in a pretty way

Working in process... Help wanted!

# Installation
Install PHP Pear
pear install net_nmap

# NMAP command
You can load nmap xml scan files to Angello.

Execute a scan with this command:

nmap -sTU -O -oX net_128_XML -oG net_128_GREP 10.149.128.0/24

Or:

nmap -sTU -O -oX net_128_XML 10.149.128.0/24


Go to angello directory and execute:
nmap.php /path/to/net_128_XML vlan

# Several VLANs only one server?
In you have a lot of vlans but only one Angello server, generally by security concerns you doesn't have acces to these vlans, may be you have a GNU/Linux server or Microsoft Windows with nmap, you can run the scan with nmap and send the XML files to Angello.

You can upload yourself or I created a little web service to inject the files. Execute this command:
send_file.php username password /path/to/net_128_XML

This will upload the files to the upload folder.

You need configure target_url in send_file.php
