#!/bin/sh

read -p "Welcome to the AIUB portal. Please enter your name: " name

if [ $name == "tanjim" ]
then
  read -p "subject name: " os
  if [ $os == "OS" ]
  then
    read -p "os mid mark: " mark
    if [ $mark -lt 0 -o $mark -gt 100 ]
    then
      echo "the input is invalid"
      exit 1
    fi
    if [ $mark -lt 50 ]
    then
      read -p "what is the recommendation of your faculty (Yes/No): " rec
      if [ $rec == "Yes" ]
      then
        echo "you can sit for the exam"
      elif [ $rec == "No" ]
      then
        echo "you can not sit for the exam"
      fi
    fi
  fi
fi

