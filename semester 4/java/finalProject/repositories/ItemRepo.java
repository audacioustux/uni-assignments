package repositories;

import java.sql.*;
import java.util.*;

import entities.*;

public class ItemRepo {
    public Item getItem(int id) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT price, detail, processing_time, name FROM items WHERE id=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, id);

                try (ResultSet rs = ps.executeQuery()) {
                    if (rs.next()) {
                        Item item = new Item(id, rs.getDouble("price"), rs.getString("name"));
                        item.setProcessing_time(rs.getTime("processing_time"));
                        item.setDetail(rs.getString("detail"));
                        return item;
                    }
                    return null;
                }
            }
        }
    }

    public List<Item> getItems() throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT * FROM items DESC";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                try (ResultSet rs = ps.executeQuery()) {
                    List<Item> items = new ArrayList<Item>();
                    while (rs.next()) {
                        Item item = new Item(rs.getInt("id"), rs.getDouble("price"), rs.getString("name"));
                        item.setProcessing_time(rs.getTime("processing_time"));
                        item.setDetail(rs.getString("detail"));
                        items.add(item);
                    }
                    return items;
                }
            }
        }
    }
}