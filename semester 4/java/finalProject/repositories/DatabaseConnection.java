package repositories;

import java.sql.*;
import java.util.Properties;

public class DatabaseConnection implements AutoCloseable {
    private static final String DATABASE_DRIVER = "com.mysql.cj.jdbc.Driver";
    private static final String DATABASE_URL = "jdbc:mysql://localhost:3306/final_project";
    private static final String USERNAME = "root";
    private static final String PASSWORD = "password";

    Connection connection;
    private static Properties properties;

    private static Properties getProperties() {
        if (properties == null) {
            properties = new Properties();
            properties.setProperty("user", USERNAME);
            properties.setProperty("password", PASSWORD);
        }
        return properties;
    }

    public DatabaseConnection() throws SQLException {
        try {
            Class.forName(DATABASE_DRIVER);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            System.exit(1);
        }
        connection = DriverManager.getConnection(DATABASE_URL, getProperties());
    }

    public void close() {
        if (connection != null) {
            try {
                connection.close();
                connection = null;
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }
}