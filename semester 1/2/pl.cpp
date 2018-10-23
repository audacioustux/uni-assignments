// flag: -std=c++11
#include<bits/stdc++.h>
using namespace std;

struct student_info {
  string id, name, dept;
  int semester;
  map <string, float> marks;
}; // bar bar jate na likha lage
string gradify(float mark){
    if(mark >= 90) return "A+";
    else if(mark >= 85) return "A";
    else if(mark >= 80) return "B+";
    else if(mark >= 75) return "B";
    else if(mark >= 70) return "C+";
    else if(mark >= 65) return "C";
    else if(mark >= 60) return "D+";
    else if(mark >= 50) return "D";
    else return "F";
}
int scholarship(float _gpa){
  if(_gpa > 3.94) return 100;
  else if(_gpa > 3.75) return 75;
  else return 0;
}
class Student{
  private:
    student_info info;
  public:
    Student(const student_info& _info){
      info = _info;
    }
    string getID(){
      return info.id;
    }
    string getGrade(string _courseName){
      return gradify(info.marks[_courseName]);
    }
    float getGPA(){
      float sum = 0;
      for(auto _markPair : info.marks){ // range for (C++11)
        float _mark = _markPair.second; // map stores pair
        if(_mark >= 60){
          sum += 4 - (((90 - _mark)/100)*5);
        } else if (_mark >= 50) {
          sum += 2.25;
        }
      }
      return sum / 5;
    }
};
int main(){
  student_info info;
  cout << "Student ID: ";
  cin >> info.id;
  cin.ignore(); // newline character ignore korar jonne
  cout << "Name: ";
  getline(cin, info.name);
  cout << "Department: ";
  getline(cin, info.dept);
  cout << "Semester: ";
  cin >> info.semester;
  cin.ignore();
  string _courseName; float _mark;
  cout << "Enter 5 Course name with mark obtained by student in that course:" << endl;
  for(int i = 0; i < 7; i++){
    cout << i+1 << ". Course Name:\t";
    getline(cin, _courseName);
    cout << "Obtained Mark:\t";
    cin >> _mark;
    cin.ignore();
    info.marks[_courseName] = _mark;
  } // get 5 courseName with number
  Student st(info);
  cout << "student id: " << st.getID() << endl;
  cout << "Grade in math: " << st.getGrade("math") << endl;
  cout << "Total GPA: " << st.getGPA() << endl;
  cout << "Can get " << scholarship(st.getGPA()) << "\% scholarship" << endl;
  return 0;
} // purrfact 80 lines :D
