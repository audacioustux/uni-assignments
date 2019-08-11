package entities;

import java.sql.*;

public class User {
    private int id;
    private String ph_number;
    private Time last_login;

    public User(int id) {
        this.id = id;
    }

    public User(int id, String ph_number) {
        this(id);
        this.ph_number = ph_number;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setPhNumber(String ph_number) {
        this.ph_number = ph_number;
    }

    public String getPhNumber() {
        return ph_number;
    }

    public void setLastPassLogin(Time last_login) {
        this.last_login = last_login;
    }

    public Time getLastLogin() {
        return last_login;
    }
}