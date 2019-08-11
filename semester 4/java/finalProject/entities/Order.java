package entities;

import java.sql.*;

public class Order {
    private User ordered_by;
    private Time ordered_at;
    private int id;
    private double bill;

    public Order(int id) {
        this.id = id;
    }

    public Order(int id, User ordered_by, Time ordered_at, double bill) {
        this(id);
        this.ordered_at = ordered_at;
        this.bill = bill;
        this.ordered_by = ordered_by;
    }

    public void setBill(double bill) {
        this.bill = bill;
    }

    public double getBill() {
        return bill;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setOrdered_at(Time ordered_at) {
        this.ordered_at = ordered_at;
    }

    public Time getOrdered_at() {
        return ordered_at;
    }

    public void setOrdered_by(User ordered_by) {
        this.ordered_by = ordered_by;
    }

    public User getOrdered_by() {
        return ordered_by;
    }
}
