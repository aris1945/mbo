#! /bin/bash
for (( i = 0; i <= 9999999; i++ )); do
  php absencok.php
  printf "Sleep"
  sleep 5
done
