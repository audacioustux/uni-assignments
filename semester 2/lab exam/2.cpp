#include<bits/stdc++.h>
using namespace std;
#define SIZE 3

int stak[SIZE];
int top = 0;

void push(int data){
    if(top == SIZE){
        cout << "full" << endl;
    } else {
        stak[top] = data;
        cout << data << " pushed to stack" << endl;
        top++;
    }
}
void pop(){
    if(top != 0){
        top--;
        cout << stak[top] << " popped" << endl;
    } else {
        cout << "already empty!" << endl;
    }
}
void display(){
    for(int i = 0; i < top; i++){
        cout << stak[i] << " ";
    }
}
int main(){
pop();
push(10);
push(20);
push(30);
push(40);
pop();
push(50);
push(60);
pop();
pop();
pop();
push(70);
display();
return 0;
}
