CSV2JSON
========

What is it?
-----------

A tool that convert CSV files to JSON Lines

[Learn about JSON Lines](http://jsonlines.org)


How to use it
-------------

Help:
        
        ./csv2json --help
        
        
Example:

        ./csv2json file.csv --output=file.jsonl --delimiter=comma --text-enclosure=none --decimal-sep=point
        
        

How to build
------------

A build is availale at "releases", however if you want build by yourself:

1. Download "[caveman](https://github.com/Mamuph/caveman/releases)" (The Mamuph Framework Helper tool)
2. Inside the project directory execute:

        caveman build . -x -r
        
     

