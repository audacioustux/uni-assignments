#!/usr/bin/sh

while true
do
read -p "first number: " a
read -p "second number: " b
read -p "sum, sub, mul, div, mod... watchu wanna duh?: " op
if [ $(echo "$b == 0" |bc -l) -a $op == "div" ];
then
  echo "division by 0 not possible"
  exit 1
fi

case $op in
  sum) echo `expr "scale=2; $a + $b" | bc -l`
    break
    ;;
  sub) echo `expr "scale=2; $a - $b" | bc -l`
    break
    ;;
  mul) echo `expr "scale=2; $a * $b" | bc -l`
    break
    ;;
  div) echo `expr "scale=2; $a / $b" | bc -l`
    break
    ;;
  mod) echo `expr "scale=2; $a / $b" | bc -l`
    break
    ;;
  *) echo "AaAaAaAaAaaaa.... enter again :/" ;;
esac
done

exit 1

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
