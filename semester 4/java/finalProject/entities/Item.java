package entities;

import java.sql.*;

public class Item {
    private int id;
    private double price;
    private String detail;
    private Time processing_time;
    private String name;

    public Item(int id) {
        this.id = id;
    }

    public Item(int id, double price, String name) {
        this(id);
        this.price = price;
        this.name = name;
    }

    public String getDetail() {
        return detail;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public double getPrice() {
        return price;
    }

    public Time getProcessing_time() {
        return processing_time;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setDetail(String detail) {
        this.detail = detail;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public void setProcessing_time(Time processing_time) {
        this.processing_time = processing_time;
    }
}