package entities;

import java.sql.*;

public class User {
    private int id;
    private String ph_number;
    private Time last_login;
    private Boolean is_manager;

    public User(int id) {
        this.id = id;
    }

    public User(int id, String ph_number, boolean is_manager) {
        this(id);
        this.ph_number = ph_number;
        this.is_manager = is_manager;
    }

    public void setIs_manager(Boolean is_manager) {
        this.is_manager = is_manager;
    }

    public Boolean getIs_manager() {
        return is_manager;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setLast_login(Time last_login) {
        this.last_login = last_login;
    }

    public Time getLast_login() {
        return last_login;
    }

    public void setPh_number(String ph_number) {
        this.ph_number = ph_number;
    }

    public String getPh_number() {
        return ph_number;
    }
}