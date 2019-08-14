package repositories;

import java.sql.*;
import java.util.*;

import entities.*;

public class CategoryRepo {
    public Category getCategory(int id) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT name, description FROM orders WHERE id=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, id);

                try (ResultSet rs = ps.executeQuery()) {
                    if (rs.next()) {
                        Category category = new Category(id, rs.getString("name"));
                        category.setDescription(rs.getString("description"));
                        return category;
                    }
                    return null;
                }
            }
        }
    }

    public List<Category> getCategories() throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT * FROM category";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                try (ResultSet rs = ps.executeQuery()) {
                    List<Category> categories = new ArrayList<Category>();
                    while (rs.next()) {
                        Category category = new Category(rs.getInt("id"), rs.getString("name"));
                        category.setDescription(rs.getString("description"));
                        categories.add(category);
                    }
                    return categories;
                }
            }
        }
    }

    public List<Category> getCategoriesOf(Item item) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT category.* FROM categoryItem, items WHERE item=? and category=id";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, item.getId());

                try (ResultSet rs = ps.executeQuery()) {
                    List<Category> categories = new ArrayList<Category>();
                    while (rs.next()) {
                        Category category = new Category(rs.getInt("id"), rs.getString("name"));
                        category.setDescription(rs.getString("description"));
                        categories.add(category);
                    }
                    return categories;
                }
            }
        }
    }

    public List<Item> getItems(Category category) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT items.* FROM categoryItem, items WHERE item=id and category=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, category.getId());

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