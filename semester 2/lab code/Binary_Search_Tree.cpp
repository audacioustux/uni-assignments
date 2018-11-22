#include<bits/stdc++.h>
using namespace std;

struct node{
    int key;
    node *left, *right;
};

node *newNode(int item){
    struct node *temp = new node;
    temp->key = item;
    temp->left = temp->right = nullptr;
    return temp;
}

void inorder(node *root){
    if (root != nullptr){
        inorder(root->left);
        cout << root->key << " ";
        inorder(root->right);
    }
}
void postorder(node *root){
    if (root != nullptr){
        postorder(root->left);
        postorder(root->right);
        cout << root->key << " ";
    }
}

void preorder(node *root){
    if (root != nullptr){
        cout << root->key << " ";
        preorder(root->left);
        preorder(root->right);
    }
}

node* insert(node* node, int key){
    if (node == nullptr) return newNode(key);
    if (key < node->key)
        node->left  = insert(node->left, key);
    else if (key > node->key)
        node->right = insert(node->right, key);
    return node;
}

int main(){
    node *root = nullptr;
    int data;
    cin >> data;
    root = insert(root, data);
    while(1){
        cin >> data;
        if(data == 0)
            break;
        insert(root, data);
    }
    cout << "inorder: ";
    inorder(root);
    cout << endl << "preorder: ";
    preorder(root);
    cout << endl << "postorder: ";
    postorder(root);
    return 0;
}
