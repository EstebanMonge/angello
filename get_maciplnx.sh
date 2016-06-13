#!/bin/bash

hostname=$(hostname)
ip a | grep "link\|inet"|grep -v "127.0.0.1\|loopback\|inet6" > /tmp/ipoutput
while read line
do
	if [[ $line == *link* ]]
	then
		mac=$(echo $line | awk '{print $2}')
	fi	
	if [[ $line == *inet* ]]
	then
		iface=$(echo $line | awk '{print $7}')
		ip=$(echo ${line%/*} | awk '{print $2}')
		echo $hostname,$iface,$mac,$ip
	fi
done < /tmp/ipoutput
