package repositories;

import java.sql.*;
import java.util.*;

import entities.*;

public class OrderRepo {
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

    public List<Order> getOrders() throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT * FROM orders ORDER BY ordered_at DESC;";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                try (ResultSet rs = ps.executeQuery()) {
                    List<Order> orders = new ArrayList<Order>();
                    while (rs.next()) {
                        Order order = new Order(rs.getInt("id"), new User(rs.getInt("ordered_by")),
                                rs.getTime("ordered_at"), rs.getInt("amount"), new Item(rs.getInt("item")));
                        order.setComment(rs.getString("comment"));
                        orders.add(order);
                    }
                    return orders;
                }
            }
        }
    }

    public List<Order> getOrdersOf(User user) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT ordered_at, comment, amount, item FROM orders WHERE ordered_by=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, user.getId());

                try (ResultSet rs = ps.executeQuery()) {
                    List<Order> orders = new ArrayList<Order>();
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
}