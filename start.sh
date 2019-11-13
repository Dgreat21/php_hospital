ip=`ifconfig | grep "broadcast " | awk '{print $2}'`
port=":8888";
addr="$ip$port";
echo "Your server is avalibale on: $addr"
php -S $addr;
