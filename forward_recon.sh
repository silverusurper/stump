#!/bin/bash
# blank script to gather creds and pull first content

# defaults
github_account='no_account'
github_repo_dest='' 
github_repo_dest_owner="${USER}"

# I need the github user/account
read -e -p "Provide the github account: " github_account
read -s -p "Provide the github token: " github_token
read -e -p "Provide the repo name: " github_reponame
read -e -p "Provide the destination []: " github_repo_dest
read -e -p "Provide the repo_dest_owner: " github_repo_dest_owner

# if the dest owner user dne, exit
[[ ! -d /home/${github_repo_dest_owner} ]] && echo "Destination owner does not exist..." && exit 42


# create the url
github_url="https://${github_token}@github.com/${github_account}/${github_reponame}.git"
echo "Github URL: ${github_url}"


# use the big hammer (sudo), pull down the repo into the home dir
sudo git clone ${github_url} ${github_repo_dest} && echo "The eagle has landed..." || exit 1

# change the owhership of the repo content
sudo chown -R ${github_repo_dest_owner}:${github_repo_dest_owner} ${github_repo_dest} || exit 2


# we all done here?
echo "All done here boss..."
