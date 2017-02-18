#!/bin/sh

#
# Deploy script for unrepeatable.org backend.
#

rsync -azP --delete . phardyn@s4.mydevil.net:domains/unrepeatable.org/public_html/api
