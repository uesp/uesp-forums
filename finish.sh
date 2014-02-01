#!/bin/bash

rm -rf docs
rm -rf install
chmod 755 images/ranks
chmod 755 images/smilies
chmod 644 images/smilies/*
chmod 755 images/avatars/gallery

rm robots.txt
mv robots.final.txt robots.txt

rm *~
rm preconvert.sh
rm postinstall.sh
rm dumpadmin.sh
rm finish.sh
rm admin.sql
rm mod.sql
rm db_update.php

