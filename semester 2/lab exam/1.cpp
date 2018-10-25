#include<bits/stdc++.h>
using namespace std;

void pushAtFirst(int arr[], int no_of_elem, int data){
    for(int i = no_of_elem; i >= 1; i--){
        arr[i] = arr[i-1];
    }
    arr[0] = data;
}
int main(){
    int arr[20] = {11,12,13,15,16,17};
    int no_of_elem = 6;
    for(int i = 0; i < no_of_elem; i++){
        cout << arr[i] << " ";
    }
    cout << endl;
    pushAtFirst(arr, no_of_elem, 14);
    no_of_elem++;
    for(int i = 0; i < no_of_elem; i++){
        cout << arr[i] << " ";
    }
return 0;
}
