#include <fstream>
#include <iostream>
#include <regex>
#include <sstream>
#include <string>
#include <utility>

#define DELIMITERS "., ;-"

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
  const string operators[] = {"+", "-", "*", "/", "=", "+=", "++"};

  for (string const &op : operators) {
    if (word == op) {
      return true;
    }
  }

  return false;
}

bool isDelimeter(char ch) {
  const char delimiters[] = DELIMITERS;

  for (char const &delimiter : delimiters) {
    if (ch == delimiter) {
      return true;
    }
  }

  return false;
}

bool isKeyword(string word) {
  const string keywords[] = {"int", "float", "const", "string", "return"};

  for (string const &kw : keywords) {
    if (word == kw) {
      return true;
    }
  }

  return false;
}

void parse_token(string token) {
  if (isKeyword(token)) {
    cout << "keyword: " << token << endl;
    return;
  }
  if (isNumericConstant(token)) {
    cout << "numeric constant: " << token << endl;
    return;
  }
  if (isOperator(token)) {
    cout << "operator: " << token << endl;
    return;
  }
  if (token.length() == 1 && isDelimeter(token[0])) {
    auto _token = token;

    switch (token[0]) {
    case ' ':
      _token = "<space>";
      break;
    }
    cout << "delimiter: " << _token << endl;
  }
}

int main() {
  fstream input;
  input.open("input.txt", ios::in);
  if (input.is_open()) {
    string line;
    while (getline(input, line)) {
      regex re(string("([") + DELIMITERS + "]" + "|[^" + DELIMITERS + "]+)");

      regex_iterator<string::iterator> re_iter(line.begin(), line.end(), re);
      regex_iterator<string::iterator> rend;

      while (re_iter != rend) {
        parse_token(re_iter->str());
        ++re_iter;
      }
    }
    input.close();
  }

  return 0;
}
