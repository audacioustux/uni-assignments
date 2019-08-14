package entities;

import java.sql.*;

public class Order {
    private User ordered_by;
    private Time ordered_at;
    private int id;
    private int amount;
    private Item item;
    private String comment;

    public Order(int id) {
        this.id = id;
    }

    public Order(int id, User ordered_by, Time ordered_at, int amount, Item item) {
        this(id);
        this.ordered_at = ordered_at;
        this.ordered_by = ordered_by;
        this.amount = amount;
        this.item = item;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }

    public String getComment() {
        return comment;
    }

    public void setItem(Item item) {
        this.item = item;
    }

    public Item getItem() {
        return item;
    }

    public void setAmount(int amount) {
        this.amount = amount;
    }

    public int getAmount() {
        return amount;
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
