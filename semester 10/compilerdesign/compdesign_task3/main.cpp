#include <cctype>
#include <fstream>
#include <iostream>
#include <regex>
#include <sstream>
#include <string>
#include <utility>

#define DELIMITERS "., ;-"

using namespace std;

bool isNumericConstant(string token) {
  for (char const &c : token) {
    if (isdigit(c)) {
      continue;
    }
    return false;
  }
  return true;
}

bool isOperator(string token) {
  const string operators[] = {"+", "-", "*", "/", "=", "+=", "++"};

  for (string const &op : operators) {
    if (token == op) {
      return true;
    }
  }

  return false;
}

bool isDelimeter(char token) {
  const char delimiters[] = DELIMITERS;

  for (char const &delimiter : delimiters) {
    if (token == delimiter) {
      return true;
    }
  }

  return false;
}

bool isKeyword(string token) {
  const string keywords[] = {"int", "float", "const", "string", "return"};

  for (string const &kw : keywords) {
    if (token == kw) {
      return true;
    }
  }

  return false;
}

bool isIdent(string token) {
  if (!(isalpha(token[0]) || token[0] == '_')) {
    return false;
  }
  for (char const &c : token) {
    if (isalnum(c)) {
      continue;
    }
    return false;
  }
  return true;
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
  if (isIdent(token)) {
    cout << "identifier: " << token << endl;
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
    return;
  }

  cout << "unrecognized: " << token << endl;
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
