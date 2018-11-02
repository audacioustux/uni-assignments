#include<bits/stdc++.h>
using namespace std;

void counting_sort(int arr[], int saiz, int k){
  int i_arr[k] = {0};
  for(int i = 0; i < saiz; i++){
    i_arr[arr[i]]++;
  }
  int pos = 0;
  for(int i = 0; i < k; i++){
    while(i_arr[i]){
      arr[pos] = i;
      pos++;
      i_arr[i]--;
    }
  }
}

int main(){
  int arr[] = {1,3,2,9,5,3,0};
  int saiz = sizeof(arr)/sizeof(arr[0]);
  counting_sort(arr,saiz,10);
  for(auto i:arr){
    cout << i << " ";
  }
  return 0;
}
