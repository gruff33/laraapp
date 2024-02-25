#!/bin/bash

MyKey=ivRkHGdxBxOEGiul9cdP5mki7241q5QC
MyHost=http://192.168.1.100

H1='Content-type: application/json'
H2='Accept: application/json'
H3='X-tenant: '${MyKey}
HN=`hostname -s`
DN=`hostname -d`

sysuuid=`dmidecode -s system-uuid`
[ -f /etc/os-release ] && {
    . /etc/os-release
}

###############################################################################
# send hostname and uuid, API should return asset ID
###############################################################################
JSON_DATA='{"name": "'${HN}'","domain": "'${DN}'","uuid":"'${sysuuid}'","osname": "'${NAME}'","osversion": "'${VERSION}'"}'

# echo Sending: ${JSON_DATA}

Asset_ID=`curl -s -k -H "${H1}" -H "${H2}" -X POST -d "${JSON_DATA}" ${MyHost}/api/v1/node|cut -d',' -f1|cut -d: -f2`
rc=$?
echo "Asset ID: $Asset_ID "
[ $rc != 0 ] && echo "Error returned: $rc"
###############################################################################
# get list of dmidecode attibutes to send (bios vendor etc..)
###############################################################################
DMI_ATTRIBUTES=`dmidecode -s 2>&1 |grep '^ '|awk '{ print $1 }'`

###############################################################################
# send DMI data to API, setting asset id at top level in json
###############################################################################
AtData='{"compute_id": "'$Asset_ID'","DMI": ['

for i in $DMI_ATTRIBUTES
do
    Attribute_value=`dmidecode -s ${i} |head -1`
    AtData=$AtData'{ "name": "'${i}'","value": "'${Attribute_value}'"},'
done
AtData=`echo $AtData| sed 's/\(.*\),/\1 /'`
AtData=$AtData" ]}"

curl --silent -k -H "${H1}" -H "${H2}" -H "${H3}" -X POST -d "${AtData}" ${MyHost}/api/v1/nodeattr/
rc=$?

## echo "sent ${#AtData} dmi data bytes (${rc})"
###############################################################################
# Build and send package data from current host to API
###############################################################################
echo "Building package list"
count=0

PkgLoopList=`rpm -qa --queryformat '%{NAME}\n'`

echo "Packages to send: "
echo $PkgLoopList|wc -w

for i in $PkgLoopList
do
    [ $count -eq 0 ] && {
        echo "Setting header "
        AtData='{"compute_id": "'$Asset_ID'","Packages": ['
    }

    count=$((count+1))
    AtData=$AtData`rpm -q ${i} --queryformat='\n\{
        "name": "%{NAME}",
        "version": "%{VERSION}",
        "release": "%{RELEASE}",
        "vendor": "%{VENDOR}",
        "arch": "%{ARCH}",
        "buildhost": "%{BUILDHOST}",
        "buildtime": "%{BUILDTIME}",
        "changelogname": "%{CHANGELOGNAME}",
        "distribution": "%{DISTRIBUTION}",
        "license": "%{LICENSE}",
        "installtime": "%{INSTALLTIME}",
        "packager": "%{PACKAGER}"
    \n\},\n'`
    [ $count -eq 100 ] && {
        AtData=`echo $AtData| sed 's/\(.*\),/\1 /'`
        AtData=$AtData" ]}"

        echo $AtData >register.json
        echo "Sending ${count} records"
        #cat register.json|python -m json.tool
        curl --silent -k -H "${H1}" -H "${H2}" -H "${H3}" -X POST -d @register.json ${MyHost}/api/v1/package/
        count=0
    }
    
done
AtData=`echo $AtData| sed 's/\(.*\),/\1 /'`
AtData=$AtData" ]}"

echo $AtData >register.json
echo "Sending ${count} records"

curl --silent -k -H "${H1}" -H "${H2}" -H "${H3}" -X POST -d @register.json ${MyHost}/api/v1/package/
echo "Sent..."
