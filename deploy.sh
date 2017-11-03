#!/bin/sh
#base script by greut (https://github.com/greut)

set -xe

(
    cd build
    git init
    git config user.name "TravisCI"
    git config user.email "travis@s-amiral.test"
    git add .
    git commit -m "Deployed to github pages"
    git push -f -q "https://${GH_TOKEN}@github.com/${TRAVIS_REPO_SLUG}" master:master
)
