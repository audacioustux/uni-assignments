#include<bits/stdc++.h>
using namespace std;

void bubble_sort(int arr[], int saiz){
    for(int i = 0; i < saiz; i++){
        bool swapped = false;
        for(int j = 0; j < saiz-i-1; j++){
            if(arr[j] > arr[j+1]){
                swap(arr[j], arr[j+1]);
                swapped = true;
            }
        }
        if(!swapped){
            break;
        }
    }
}
int binary_sarch(int arr[], int q){
    int mid;
    int l = 0, r = sizeof(arr)/sizeof(arr[0])-1;
    while(l >= r){
        mid = (l+r)/2;
        if(arr[mid] == q){
            return mid;
        } else if (q < arr[mid]){
            r--;
        } else {
            l++;
        }
    }
    return -1;
}
int main(){
cout << " How many numbers: ";
int n;
cin >> n;
int arr[n];
for(int i = 0; i < n; i++){
    cin >> arr[i];
}
int saiz = sizeof(arr)/ sizeof(arr[0]);
bubble_sort(arr, saiz);
cout << "sorted array: " << endl;
for(int data: arr){
    cout << data << " ";
}
cout << endl;
cout << "element to search: ";
int q;
cin >> q;
int pos = binary_sarch(arr, q);
if(pos != -1){
    cout << "found at: " << pos+1 << endl;
} else {
    cout << "not found" << endl;
}
return 0;
}

