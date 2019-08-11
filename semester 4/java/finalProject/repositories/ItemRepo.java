package repositories;

import java.sql.*;

import entities.*;

public class ItemRepo {
    public static Item getItem(int id) throws SQLException {
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
}