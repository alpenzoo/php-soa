#!/bin/sh
echo Building Docker image.
docker build -t funkytaco/php-soa-example:latest .

echo Running Docker container...
docker run -v `pwd`:/opt -p 80:80 funkytaco/php-soa-example:latest
