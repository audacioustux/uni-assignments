using System;
using System.IO;

namespace FileApplication
{
    class Employee
    {
        private string _name, _id;
        private int _age;
        private double _salary;

        public string name
        {
            get { return _name; }
            set { _name = value; }
        }
        public string id
        {
            get { return _id; }
            set { _id = value; }
        }
        public int age
        {
            get { return _age; }
            set { _age = value; }
        }
        public double salary
        {
            get { return _salary; }
            set { _salary = value; }
        }

        public string toString() {
            return String.Format(
                "name: {1}{0}id: {2}{0}age: {3}{0}salary: {4}{0}",
                Environment.NewLine, name, id, age, salary
            );
        }
    }
    class Program
    {
        static void Main(string[] args)
        {
            Employee[] e = new Employee[3];
            for (int i = 0; i < e.Length; i++) {
                e[i] = new Employee();
                Console.Write("name: ");
                e[i].name = Console.ReadLine();
                Console.Write("id: ");
                e[i].id = Console.ReadLine();
                Console.Write("age: ");
                e[i].age = Convert.ToInt16(Console.ReadLine());
                Console.Write("salary: ");
                e[i].salary = Convert.ToDouble(Console.ReadLine());
            }

            for (int i = 0; i < e.Length; i++)
            {
                using (StreamWriter sw = new StreamWriter("MyFile.txt"))
                {

                    foreach (Employee emp in e)
                    {
                        sw.WriteLine(emp.toString());
                    }
                }
            }

            Console.WriteLine("From File: ");
            using (StreamReader sr = new StreamReader("MyFile.txt"))
            {
                string line;
                while ((line = sr.ReadLine()) != null)
                {
                    Console.WriteLine(line);
                }
            }

            Console.ReadKey();
        }
    }
}
