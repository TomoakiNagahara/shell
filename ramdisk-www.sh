#!/usr/bin/env bash

# https://qiita.com/yassy/items/074f4f42c559f47083f3

# HFS+フォーマットでボリューム名を付ける
# https://xtech.nikkei.com/it/atcl/column/15/042000103/080700070/

# -s で case-sensitive になる
# -v で ボリューム名を付けれる
# https://www.manpagez.com/man/8/newfs_hfs/

# -h を付けると、HFSでフォーマットする（HFS+ではなく）
# https://renoji.com/IT.php?Contents=ShellScript_Bash/Cmd_newfs_hfs.html

# Create ramdisk 256000=125MB, 512000=250MB, 1024000=500MB, 2048000=1GB, 4096000=2GB
# 128MB  262144
# 512MB 1048576
# 1GB 	2097152
# 2GB 	4194304
#NUMSECTORS=(2048*512)
#NUMSECTORS=(256000*1)
#NUMSECTORS=2048000

NUMSECTORS=${1:-2048000}
MOUNTPOINT=/www/
VOLUMENAME=www
USERNAME=`whoami`

# RAM Disk
DEVICE=`hdiutil attach -nomount ram://$NUMSECTORS`
newfs_hfs -s -v $VOLUMENAME $DEVICE
mount -t hfs $DEVICE $MOUNTPOINT
chown $USERNAME $MOUNTPOINT

mkdir -p /www/_log/apache/
mkdir -p /www/_log/nginx/
mkdir -p /www/_caches/Chrome/
mkdir -p /www/_caches/edgemac/
mkdir -p /www/_caches/php/
ln -s /www/_caches/ /www/caches
mkdir -p /www/localhost/
mkdir -p /www/phpmyadmin/
mkdir -p /www/uqunie/com/2020/
mkdir -p /www/onepiece-framework/2019/
mkdir -p /www/hua-xia/htdocs2/
mkdir -p /www/cctokyo/www/
mkdir -p /www/nhk/

# Make directory
#mkdir -p "${MOUNTPOINT}/caches/"
#mkdir -p "${MOUNTPOINT}/caches/regtest/"
#mkdir -p "${MOUNTPOINT}/caches/log/apache2/"
#mkdir -p "${MOUNTPOINT}/caches/log/nginx/"
#mkdir -p "${MOUNTPOINT}/caches/php/session/"

# Change owner
#chown tomoaki "${MOUNTPOINT}/caches/regtest/"
#chown _www    "${MOUNTPOINT}/caches/php/session/"
