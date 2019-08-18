package interfaces;

import java.util.*;
import java.sql.*;

import entities.*;

public interface IOrderRepo {
    Order getOrder(int id) throws SQLException;

    ArrayList<Order> getOrders() throws SQLException;

    ArrayList<Order> getOrdersOf(User user) throws SQLException;

    void CreateOrder(User user, Item item, String comment, int amount) throws SQLException;
}