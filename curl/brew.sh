#!/bin/bash

# Check if Homebrew is installed
if ! command -v brew &> /dev/null; then
    echo "Homebrew is not installed. Installing..."
    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    # Add Homebrew to the PATH
    echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> ~/.zprofile
    eval "$(/opt/homebrew/bin/brew shellenv)"
else
    echo "Homebrew is already installed."
fi

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "git is not installed. Installing..."
    brew install git
else
    echo "git is already installed."
fi

# Clone the repository
git clone https://github.com/NishanthBlack28/BlackBros-E-Commerce.git
