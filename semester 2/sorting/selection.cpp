#include<bits/stdc++.h>
using namespace std;

void selection_sort(int arr[], int saiz){
  int pos, i, j;
  for (i = 0; i < saiz - 1; i++){
      pos = i;
      for (j = i + 1; j < saiz; j++){
        if (arr[j] < arr[pos]){
          pos = j;
        }
      }
      swap(arr[i], arr[pos]);
    }
}
int main(){
  int arr[] = {3,1,6,98,0,-2,6,9};
  int saiz = sizeof(arr)/sizeof(arr[0]);

  selection_sort(arr, saiz);

  for(int n: arr){
    cout << n << " ";
  }
  return 0;
}
