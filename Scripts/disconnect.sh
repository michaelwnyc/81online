#!/bin/bash

username=username

passwd=password

dbname=database name


/usr/local/mysql/bin/mysql -u$username -p$passwd -e "INSERT into log (start_time,trusted_ip,trusted_port,protocol,remote_ip,remote_netmask,username,status) values(now(),'$trusted_ip',$trusted_port,'$proto_1','$ifconfig_pool_remote_ip','$route_netmask_1','$common_name',1)" $dbname



/usr/local/mysql/bin/mysql -u$username -p$passwd -e "INSERT INTO stat (username) VALUES ('$common_name') ON DUPLICATE KEY UPDATE username=username;" $dbname




/usr/local/mysql/bin/mysql -u$username -p$passwd -e "UPDATE stat SET origin_time=now() where origin_time='0000-00-00 00:00:00' and username='$common_name';" $dbname


/usr/local/mysql/bin/mysql -u$username -p$passwd -e "update stat set origin_time=now() where TO_DAYS(NOW())-TO_DAYS(origin_time)>(select quota_cycle from user where user.username='$common_name') AND username='$common_name';" $dbname
