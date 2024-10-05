#!/bin/bash

echo "Starting Vagrant..."

vagrant up

# Check if Vagrant is running
if vagrant status | grep -q "running"; then
    echo "Vagrant is up!"
else
    echo "ERROR: Vagrant is not up!!!"
    exit 1
fi

# echo "Building Docker image..."
# vagrant ssh -c "cd /home/vagrant && docker build -t finaldevops5-web ."

# if [ $? -ne 0 ]; then
#    echo "ERROR: Docker build failed!"
# fi


echo "Starting Docker and Docker-compose inside of VM"
vagrant ssh -c "cd /vagrant && docker-compose up -d && echo 'Docker containers' && docker ps"