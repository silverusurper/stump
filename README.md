Stump
==

Ask for input, and bring down a private repo.

> I want to only use this for lazy dev build. It's just as easy (and more secure) to do git clone and be prompted for the username and password, but put the token in the password. IDK
 
```
#!/bin/bash

# github details
github_account='no_account'
github_reponame='no_reponame'
read -e -p "Provide the github account [${github_account}]: " -i ${github_account} github_account
read -e -p "Provide the repository name [${github_reponame}]: " -i ${github_reponame} github_reponame

# where does the content land? start with current dir plus repo
github_repo_dest="${PWD}/${github_reponame}"
read -e -p "Provide repo destination [${github_repo_dest}]: " -i ${github_repo_dest} github_repo_dest

# now, ask for the token, do not echo the token
github_token='no_token'
read -s -p "Provide the github token: " github_token
echo ""; echo "" # newlines

# show me what we're working with, for debugging
#echo "github account: ${github_account}"
#echo "github reponame: ${github_reponame}"
#echo "github repo dest: ${github_repo_dest}/${github_reponame}"

# proceed, create the url
github_url="https://${github_token}@github.com/${github_account}/${github_reponame}.git"
#echo "Github URL: ${github_url}"

# pull down the repo
git clone ${github_url} ${github_repo_dest} && echo 'The eagle has landed!' || exit 1

# we all done here?
echo -e '\nAll done here boss...'
```
