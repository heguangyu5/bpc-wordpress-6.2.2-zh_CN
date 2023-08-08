#!/bin/bash

rm -rf ./wordpress
rsync -a                        \
      --exclude=".*"            \
      -f"+ */"                  \
      -f"- *"                   \
      .                         \
      ./wordpress
for i in `cat src.list`
do
    if [[ "$i" == \#* ]]
    then
        echo $i
    else
        filename=`basename -- $i`
        if [ "${filename##*.}" == "php" ]
        then
            echo "phptobpc $i"
            phptobpc $i > ./wordpress/$i
        else
            echo "cp       $i"
            cp $i ./wordpress/$i
        fi
    fi
done
cp bpc.conf src.list Makefile ./wordpress/
