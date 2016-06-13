#!/bin/ksh
for i in $(cat /dsh/Aseguramiento)
do
for x in $(ssh root@$i "netstat -i | grep link | grep -v lo0 " | awk '{ print $1 }' )
do
full=$(ssh root@$i "netstat -in | grep $x " | awk '{print $1":"$4":"}')
nic=$(echo $full | cut -f1 -d":")
mac=$(echo $full | cut -f2 -d":")
ip=$(echo $full | cut -f4 -d":")
echo $i":"$nic":"$mac":"$ip
done
done
