#!/usr/bin/sh
read a
read b
if (($(echo "$b == 0" |bc -l)))
then
  echo "division by 0 not possible"
  exit 1
fi

sum=`expr "scale=2; $a + $b" | bc -l`
sub=`expr "scale=2; $a - $b" | bc -l`
mul=`expr "scale=2; $a * $b" | bc -l`
div=`expr "scale=2; $a / $b" | bc -l`

is_odd(){
  mod=`expr "$1 % 2" | bc -l`
  if (( $(echo "$mod > 0" |bc -l) ))
  then
    echo "$2 $1 is odd"
  else
    echo "$2 $1 is even"
  fi
}
is_odd "$sum" "sum"
is_odd "$sub" "sub"
is_odd "$div" "div"
is_odd "$mul" "mul"

max=$sub
a="sub"

if (( $(echo "$sum > $sub" | bc -l) ))
then
  max=$sum
  a="sum"
fi

if (( $(echo "$mul > $max" |bc -l) ))
then 
  max=$mul
  a="mul"
fi

if (( $(echo "$div > $max" |bc -l) ))
then 
  max=$div
  a="div"
fi

echo "$a: $max is highest"
