#!/bin/sh

#
# Deploy script for unrepeatable.org backend.
#

# Run Swagger to generate REST API documentation.
swagger
# Sync the files with the remote server.
rsync -azP --delete . phardyn@s4.mydevil.net:domains/unrepeatable.org/public_html/api
