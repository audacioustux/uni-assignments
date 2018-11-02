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
int binary_search(int data[], int q, int l, int r){
  while(l!=r){
    int mid = data[(l+r)/2];
    if(data[mid]){
      return mid;
    } else if (data[mid] > q){
      binary_search(data, q, l, q-1);
    } else {
      binary_search(data, q, l+1, q);
    }
  }
  return -1;
}
int main(){
  int numbers[] = {2,1,4,3,747,34,53,25,2,4,324,23,4,23,4,32,4,2,34,23,4,2,4,3,654,6,5,6,5,576,8,67,9879,7,8,6};
  int saiz = sizeof(numbers)/sizeof(numbers[0]);
  bubble_sort(numbers, saiz);
  for(int i = 0; i < saiz; i++){
    cout << numbers[i] << " ";
  }
  cout << endl;
  int query = 7;
  int sizeOfArray = sizeof(numbers)/sizeof(numbers[0]);
  cout << binary_search(numbers, query, 0, sizeOfArray-1);
}
