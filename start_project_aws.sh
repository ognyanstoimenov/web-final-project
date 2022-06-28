#!/bin/zsh

aws ec2 start-instances --instance-ids i-06efdf0e181226ea6 &> /dev/null

ip=`aws ec2 describe-instances --instance-ids i-06efdf0e181226ea6 --query 'Reservations[0].Instances[0].PublicIpAddress' | xargs`

open http://$ip




