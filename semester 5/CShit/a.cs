using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exam
{
    class Faculty {
        int fId;
        string fName, designation;
        public Faculty(){}
        public Faculty(int fId, string fName, string designation) {
            this.designation = designation;
            this.fName = fName;
            this.fId = fId;
        }
        public int getFId()
        {
            return fId;
        }
        public string getFName() {
            return fName;
        }
        public string getDesignation() {
            return designation;
        }
    }
    class Course {
        string cId, cName;
        int credit;
        Faculty f;

        public Course() { }
        public Course(string cId, string cName, int credit, Faculty f){
            this.cId = cId;
            this.cName = cName;
            this.credit = credit;
            this.f = f;
        }
        public void setCId(string cId)
        {
            this.cId = cId;
        }
        public void setCName(string cName)
        {
            this.cName = cName;
        }
        public void setCredit(int credit)
        {
            this.credit = credit;
        }
        public void setFaculty(Faculty f) { this.f = f; }
        public string getCId() { return cId; }
        public string getCName() { return cName; }
        public int getCredit() { return credit; }
        public Faculty getFaculty() { return f; }
    }

    class Student {
        int sId;
        string sName;
        string sRegistrationNo;
        Course c;

        public Student() { }
        public Student(int sId, string sName, string sRegistrationNo, Course c) {
            this.sId = sId;
            this.sName = sName;
            this.sRegistrationNo = sRegistrationNo;
            this.c = c;
        }
        public void showDetails() {
            Console.WriteLine("id: {1}{0}name: {2}{0}reg no: {3}{0}", Environment.NewLine, sId, sName, sRegistrationNo);
            Console.WriteLine("Course: {1}{0}Credit: {2}{0}", Environment.NewLine, c.getCName(), c.getCredit());
            Console.WriteLine("Faculty: {1}{0}Designation{2}{0}", Environment.NewLine, c.getFaculty().getFName(), c.getFaculty().getDesignation());
        }

    }
    class Program
    {
        static void Main(string[] args)
        {
            Faculty[] fS = new Faculty[3];
            Course[] cS = new Course[3];
            Student[] stS = new Student[3];

            for (int i = 0; i < 3; i++) {
                Console.WriteLine("Faculty id(number) name(string) designation(string)");
                fS[i] = new Faculty(Convert.ToInt32(Console.ReadLine()), Console.ReadLine(), Console.ReadLine());
                
                cS[i] = new Course();
                Console.WriteLine("Course id(string) name(string) credit(number)");
                cS[i].setCId(Console.ReadLine());
                cS[i].setCName(Console.ReadLine());
                cS[i].setCredit(Convert.ToInt16(Console.ReadLine()));
                cS[i].setFaculty(fS[i]);

                Console.WriteLine("Student id(number) name(string) reg NO.(string)");
                stS[i] = new Student(Convert.ToInt32(Console.ReadLine()), Console.ReadLine(), Console.ReadLine(), cS[0]);
            }

            for (int i = 0; i < 3; i++)
            {
                stS[i].showDetails();
            }

            Console.ReadKey();
        }
    }
}
