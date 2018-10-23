#include<bits/stdc++.h>
using namespace std;

void bubble_sort(int arr[], int saiz){
  bool swaped;
  for(int i = 0; i < saiz-1; i++){
    swaped = false;
    for(int j = 0; j < saiz - i - 1; j++){
      if(arr[j] > arr[j+1]){
        swap(arr[j], arr[j+1]);
        swaped = true;
      }
    }
    if(swaped){
      break;
    }
  }
}
int main(){
  int numbers[] = {2,1,4,3,7,5,9,8,4343,2,323,23,32,23,32,32,3,2,532,54,5,2643,26,342,5,35,32,4,23,342432,325,6,46,547,34,53,25,2,4,324,23,4,23,4,32,4,2,34,23,4,2,4,3,654,6,5,6,5,576,8,67,9879,7,8,6};
  int saiz = sizeof(numbers)/sizeof(numbers[0]);
  bubble_sort(numbers, saiz);
  for(int i = 0; i < saiz; i++){
    cout << numbers[i];
  }
}
