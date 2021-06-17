#include <iostream>
#include <string>
#include <utility>
using namespace std;

bool isNumericConstant(string word) {
  for (char const &c : word) {
    if (isdigit(c)) {
      continue;
    }
    return false;
  }
  return true;
}

bool isOperator(string word) {
  const string operators[] = {"+", "-", "="};

  for (string const &op : operators) {
    if (word == op) {
      return true;
    }
  }

  return false;
}

int main() {
  string input1;

  cin >> input1;

  if (isNumericConstant(input1)) {
    cout << "numeric constant" << endl;
  } else {
    cout << "not numeric constant" << endl;
  }

  return 0;
}
