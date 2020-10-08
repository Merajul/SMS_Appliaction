#!/bin/bash
while true; do
    begin=`date +%s`
    php /var/www/html/cloudness/smppserver/receive.php
    end=`date +%s`
    if [ $(($end - $begin)) -lt 1 ]; then
        sleep $(($begin + 5 - $end))
    fi
done
