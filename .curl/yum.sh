#!/bin/bash

# Update the package list
sudo yum update -y

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "git is not installed. Installing..."
    sudo yum install -y git
else
    echo "git is already installed."
fi

# Clone the repository
git clone https://github.com/NishanthBlack28/BlackBros-E-Commerce.git

