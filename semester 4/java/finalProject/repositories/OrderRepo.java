package repositories;

import java.sql.*;
import java.util.*;

import entities.*;
import interfaces.*;

public class OrderRepo implements IOrderRepo {
    public Order getOrder(int id) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT ordered_by, ordered_at, comment, amount, item FROM orders WHERE id=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, id);

                try (ResultSet rs = ps.executeQuery()) {
                    if (rs.next()) {
                        Order order = new Order(id, new User(rs.getInt("ordered_by")), rs.getTime("ordered_at"),
                                rs.getInt("amount"), new Item(rs.getInt("item")));
                        order.setComment(rs.getString("comment"));
                        return order;
                    }
                    return null;
                }
            }
        }
    }

    public ArrayList<Order> getOrders() throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT * FROM orders ORDER BY ordered_at DESC;";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                try (ResultSet rs = ps.executeQuery()) {
                    ArrayList<Order> orders = new ArrayList<Order>();
                    while (rs.next()) {
                        ItemRepo iRepo = new ItemRepo();
                        Order order = new Order(rs.getInt("id"), new User(rs.getInt("ordered_by")),
                                rs.getTime("ordered_at"), rs.getInt("amount"), iRepo.getItem(rs.getInt("item")));
                        order.setComment(rs.getString("comment"));
                        orders.add(order);
                    }
                    return orders;
                }
            }
        }
    }

    public ArrayList<Order> getOrdersOf(User user) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT ordered_at, comment, amount, item FROM orders WHERE ordered_by=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, user.getId());

                try (ResultSet rs = ps.executeQuery()) {
                    ArrayList<Order> orders = new ArrayList<Order>();
                    while (rs.next()) {
                        Order order = new Order(rs.getInt("id"), new User(user.getId()), rs.getTime("ordered_at"),
                                rs.getInt("amount"), new Item(rs.getInt("item")));
                        order.setComment(rs.getString("comment"));
                        orders.add(order);
                    }
                    return orders;
                }
            }
        }
    }

    public void CreateOrder(User user, Item item, String comment, int amount) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String Usql = "INSERT INTO orders (ordered_by, ordered_at, comment, amount, item) VALUES (?,?,?,?,?)";

            try (PreparedStatement Ups = dbc.connection.prepareStatement(Usql)) {
                Ups.setInt(1, user.getId());

                java.sql.Date CreatedDate = new java.sql.Date(System.currentTimeMillis());
                java.sql.Time CreatedTime = new java.sql.Time(System.currentTimeMillis());
                Ups.setString(2, CreatedDate.toString() + " " + CreatedTime.toString());
                Ups.setString(3, comment);
                Ups.setInt(4, amount);
                Ups.setInt(5, item.getId());

                Ups.executeUpdate();
            }
        }
    }
}
