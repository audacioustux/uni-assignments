// Question:
// Implement Queue with linked list
// enque, deque function
// search number in queue and return position of that number/node (address)
// add new number after the node found

#include<bits/stdc++.h>
using namespace std;

struct node{
    int data;
    node * next = nullptr;
};

node * head = new node;
node * prev_node = head;

node * enqueue(int data){
    node * new_node = new node;
    prev_node->next = new_node;
    new_node->data = data;
    if(head == nullptr)
        head = new_node;

    prev_node = new_node;
    return new_node;
}

void show_queue(){
    node *curr_node = head;
    if(curr_node == nullptr){
        cout << "Empty Queue!" << endl;
        return;
    }
    while(1){
        cout << curr_node->data << " ";
        curr_node = curr_node->next;
        if(curr_node == nullptr)
            break;
    }
    cout << endl;
}

void dequeue(){
    if(head == nullptr){
        cout << "already empty!" << endl;
    } else {
        delete head;
        head = head->next;
    }
}

void insert_after(node * after, int data){
    if(after!=nullptr){
        node * prev_next = after->next;
        node * new_node = new node;
        new_node->data = data;
        new_node->next = prev_next;
        after->next = new_node;
    } else {
        enqueue(data);
    }
}

node * linear_search(int q){
    if(head == nullptr){
        cout << "ki khujbo!? :)" << endl;
        return nullptr;
    }
    node * temp = head;
    while(temp->next != nullptr){
        if(temp->data == q){
            return temp;
        } else {
            temp = temp->next;
        }
    }
    if(temp->data == q){
            return temp;
    }
    return nullptr;
}

int main(){
    int n;
    cout << "How many data: ";
    cin >> n;
    if(n){
        int temp;
        cin >> head->data;
        while(--n){
            cin >> temp;
            enqueue(temp);
        }
    }
    show_queue();
    dequeue();
    dequeue();
    dequeue();
    dequeue();
    enqueue(69);
    enqueue(45);
    enqueue(49);
    show_queue();
    dequeue();
    enqueue(69);
    show_queue();
    node* q_node = linear_search(69);
    insert_after(q_node, 99);
    show_queue();
    return 0;
}
