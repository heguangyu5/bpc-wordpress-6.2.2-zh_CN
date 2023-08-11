#!/bin/bash

[[ "$1" == "" ]] && {
    echo "Usage: ./bpc-prepare.sh src.list"
    exit
}

rm -rf ./wordpress
rsync -a                        \
      --exclude=".*"            \
      -f"+ */"                  \
      -f"- *"                   \
      .                         \
      ./wordpress
for i in `cat $1`
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
cp bpc.conf $1 Makefile ./wordpress/
