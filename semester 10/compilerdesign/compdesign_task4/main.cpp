#include <cctype>
#include <fstream>
#include <iostream>
#include <regex>
#include <sstream>
#include <string>
#include <utility>

using namespace std;

string removeComments(string input) {
  static bool isParsingComment = false;
  string output = isParsingComment ? "" : input;

  for (int i = 0; i < input.length(); i++) {
    if (input.substr(i, 2) == "//") {
      output = input.substr(0, i);
      break;
    }
    if (input.substr(i, 2) == "*/" && isParsingComment) {
      isParsingComment = false;
      output = input.substr(0, i);
    }
    if (input.substr(i, 2) == "/*") {
      isParsingComment = true;
      output = input.substr(0, i);
    }
  }
  return output;
}

int main(int argc, char **argv) {
  fstream input;
  input.open(argv[1], ios::in);
  fstream out;
  out.open(argv[2], ios::out);

  if (input.is_open()) {
    string line;

    while (getline(input, line)) {
      string outString = removeComments(line);
      if (outString.empty())
        continue;

      out << outString << endl;
    }
    input.close();
  }

  return 0;
}
