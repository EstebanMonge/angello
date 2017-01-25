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

nmap -sP -oX nmap_scan.xml 10.149.128.0/24

Go to angello directory and execute:
nmap.php /path/nmap_scan.xml vlan


