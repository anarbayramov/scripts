#!/bin/bash
CPU_USAGE=$(top -b -n1 | grep "Cpu(s)" | awk '{print $2 + $4}')
echo $CPU_USAGE
usage_status=$(echo "${CPU_USAGE} > 75" | bc)
emails=$(head -n 1 emails.txt)

if [ $usage_status -eq 1 ];
then
  if test `find "lasttime.txt" -mmin +1440` #in production it will be 1440
  then
    echo "CPU OVERLOADED" | mailx -v \
    -r "noreply@test.com" \
    -s "Cache Cache Server Overload Alert" \
    -S smtp="smtp.test.com" \
    -S smtp-auth=login \
    -S smtp-auth-user="noreply@test.com" \
    -S smtp-auth-password="test1234" \
    -S ssl-verify=ignore \
    $emails
    touch lasttime.txt
  fi
fi
