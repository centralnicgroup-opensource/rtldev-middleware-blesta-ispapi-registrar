#!/bin/bash

src_dir="/usr/share/rtldev-middleware-blesta/blesta"
dest_dir="/var/www/html/blesta/"

# Use mv to move the directory and overwrite existing files, including hidden files
cp -a "$src_dir/." "$dest_dir"