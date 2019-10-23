using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace LabTask
{
    class Student
    {
        private String firstName, lastName, addressLine1, addressLine2, city, state, country;
        private int zipCode;
        private DateTime birthDate;

        public void setZipCode(int zipCode) { this.zipCode = zipCode; }
        public void setBirthDate(DateTime birthDate) { this.birthDate = birthDate; }
        public void setFirstName(String firstName)
        {
            this.firstName = firstName;
        }
        public void setLastName(String lastName)
        {
            this.lastName = lastName;
        }
        public void setAddressLine1(String addressLine1)
        {
            this.addressLine1 = addressLine1;
        }
        public void setAddressLine2(String addressLine2)
        {
            this.addressLine2 = addressLine2;
        }
        public void setCity(String city)
        {
            this.city = city;
        }
        public void setState(String state)
        {
            this.state = state;
        }
        public void setCountry(String country)
        {
            this.country = country;
        }

        public int getZipCode() { return zipCode; }
        public DateTime getBirthDate() { return birthDate; }
        public String getFirstName()
        {
            return firstName;
        }
        public String getLastName()
        {
            return lastName;
        }
        public String getAddressLine1()
        {
            return addressLine1;
        }
        public String getAddressLine2()
        {
            return addressLine2;
        }
        public String getCity()
        {
            return city;
        }
        public String getState()
        {
            return state;
        }
        public String getCountry()
        {
            return country;
        }
    }
    class Teacher
    {
        String firstName, lastName, addressLine1, addressLine2, city, state, country;
        int zipCode;
        DateTime birthDate;

        public void setZipCode(int zipCode) { this.zipCode = zipCode; }
        public void setBirthDate(DateTime birthDate) { this.birthDate = birthDate; }
        public void setFirstName(String firstName)
        {
            this.firstName = firstName;
        }
        public void setLastName(String lastName)
        {
            this.lastName = lastName;
        }
        public void setAddressLine1(String addressLine1)
        {
            this.addressLine1 = addressLine1;
        }
        public void setAddressLine2(String addressLine2)
        {
            this.addressLine2 = addressLine2;
        }
        public void setCity(String city)
        {
            this.city = city;
        }
        public void setState(String state)
        {
            this.state = state;
        }
        public void setCountry(String country)
        {
            this.country = country;
        }

        public int getZipCode() { return zipCode; }
        public DateTime getBirthDate() { return birthDate; }
        public String getFirstName()
        {
            return firstName;
        }
        public String getLastName()
        {
            return lastName;
        }
        public String getAddressLine1()
        {
            return addressLine1;
        }
        public String getAddressLine2()
        {
            return addressLine2;
        }
        public String getCity()
        {
            return city;
        }
        public String getState()
        {
            return state;
        }
        public String getCountry()
        {
            return country;
        }
    }
    class UProgram
    {
        String programName;
        Teacher deptHead;
        String[] degrees;

        public void setProgramName(String programName) { this.programName = programName; }
        public void setDeptHead(Teacher deptHead) { this.deptHead = deptHead; }
        public void setDegrees(String[] degrees) { this.degrees = degrees; }

        public String getProgramName() { return programName; }
        public Teacher getDeptHead() { return  deptHead; }
        public String[] getDegrees() { return degrees; }
    }
    class Program
    {
        static void Main(string[] args)
        {
            Teacher tea = new Teacher();
            UProgram up = new UProgram();
            up.setProgramName("blabla");
            up.setDeptHead(tea);
            up.setDegrees(new String[]{"bla", "blla"});

            Console.Read();
        }
    }
}
