#include<bits/stdc++.h>
using namespace std;

void insertion_sort(int arr[], int saiz){
  int hole, value;
  for(int i = 1; i < saiz; i++){
    value = arr[i];
    hole = i - 1;
    while(hole >= 0 && arr[hole] > value){
      arr[hole + 1] = arr[hole];
      hole--;
    }
    arr[hole+1] = value;
  }
}
int main(){
  int arr[] = {3,2,7,4,0,1,-3,6,7};
  int saiz = sizeof(arr)/sizeof(arr[0]);
  insertion_sort(arr, saiz);
  for(int n: arr){
    cout << n << " ";
  }
  return 0;
}
