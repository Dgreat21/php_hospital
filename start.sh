ip=`ifconfig | grep "broadcast " | awk '{print $2}'`
port=":9364";
addr="$ip$port";
echo "Your server is avalibale on: $addr"
php -S $addr;
