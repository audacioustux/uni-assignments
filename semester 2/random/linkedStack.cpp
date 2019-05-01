#include <iostream>
using namespace std;

struct node {
  node *prev = nullptr;
  int data;
};
node *first = nullptr;
node *last = nullptr;

void push(int n) {
  node *new_node = new node;
  new_node->data = n;
  if (first == nullptr) {
    first = new_node;
    last = new_node;
    return;
  }
  new_node->prev = last;
  last = new_node;
}

void pop() {
  node *curr_node = last;
  if (curr_node == nullptr) {
    cout << "Empty Stack!" << endl;
    return;
  }
  cout << "popped: " << last->data << endl;
  node *temp = last;
  last = last->prev;
  delete (temp);
}

node *search(int q) {
  if (last == nullptr) {
    cout << "not found" << endl;
    return nullptr;
  }
  node *temp = last;
  while (temp->prev != nullptr) {
    if (temp->data == q) {
      cout << "found" << endl;
      return temp;
    } else {
      temp = temp->prev;
    }
  }
  if (temp->data == q) {
    cout << "found" << endl;
    return temp;
  }
  return nullptr;
}

void show_stack() {
  node *curr_node = last;
  if (curr_node == nullptr) {
    cout << "Empty Stack!" << endl;
    return;
  }
  while (1) {
    cout << curr_node->data << " ";
    curr_node = curr_node->prev;
    if (curr_node == nullptr)
      break;
  }
  cout << endl;
}

void avg() {
  node *curr_node = last;
  if (curr_node == nullptr) {
    cout << "0" << endl;
    return;
  }
  int sum = 0, no = 0;
  while (1) {
    sum += curr_node->data;
    no += 1;
    curr_node = curr_node->prev;
    if (curr_node == nullptr)
      break;
  }
  cout << sum / no << endl;
}

int main() {
  cout << "(+): push" << endl
       << "(-): pop" << endl
       << "(a): average" << endl
       << "(s): search number"
       << "(o): print stack" << endl;

  char i;
  int temp;
  while (1) {
    cin >> i;
    if (i == '+') {
      cout << "enter number: ";
      cin >> temp;
      push(temp);
    } else if (i == '-') {
      pop();
    } else if (i == 'a') {
      avg();
    } else if (i == 's') {
      cout << "number to search: ";
      cin >> temp;
      search(temp);
    } else if (i == 'o') {
      show_stack();
    } else {
      cout << "wrong input" << endl;
    }
  }
  return 0;
}
