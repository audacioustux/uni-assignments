package repositories;

import java.sql.*;
import java.util.*;

import entities.*;

public class UserRepo {
    public User getUser(String ph_number) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT id, last_login FROM user WHERE ph_number=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setString(1, ph_number);

                try (ResultSet rs = ps.executeQuery()) {
                    if (rs.next()) {
                        User user = new User(rs.getInt("id"), ph_number);
                        user.setLast_login(rs.getTime("last_login"));
                        return user;
                    }
                    return insertUser(ph_number);
                }
            }
        }
    }

    public boolean authenticate(User user, String rawPassword) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "SELECT password FROM user WHERE id=?";

            try (PreparedStatement ps = dbc.connection.prepareStatement(sql)) {
                ps.setInt(1, user.getId());

                try (ResultSet rs = ps.executeQuery()) {
                    if (rs.next()) {
                        return rs.getString("password") == rawPassword ? true : false;
                    }
                    return false;
                }
            }
        }
    }

    public User insertUser(String ph_number) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String Usql = "INSERT INTO user (ph_number, password) VALUES (?,?)";

            try (PreparedStatement Ups = dbc.connection.prepareStatement(Usql, Statement.RETURN_GENERATED_KEYS)) {
                Ups.setString(1, ph_number);
                Ups.setString(2, genRandomAlphanumStr(6));

                Ups.executeUpdate();

                try (ResultSet rs = Ups.getGeneratedKeys()) {
                    rs.next();
                    return new User(rs.getInt(1), ph_number);
                }
            }
        }
    }

    // TODO: should be in a seperate utils package
    public static String genRandomAlphanumStr(int length) {
        String upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        String lower = upper.toLowerCase();
        String digits = "0123456789";
        String alphanum = upper + lower + digits;

        Random rd = new Random();

        String str = "";

        for (int i = 0; i < length; i++) {
            str += alphanum.charAt(rd.nextInt(alphanum.length() - 1));
        }

        return str;
    }

    public void setPassword(User user, String rawPassword) throws SQLException {
        try (DatabaseConnection dbc = new DatabaseConnection()) {
            String sql = "UPDATE user SET password=? WHERE id=?";

            PreparedStatement ps = dbc.connection.prepareStatement(sql);
            ps.setString(1, rawPassword);
            ps.setInt(2, user.getId());

            ps.executeUpdate();
        }

        System.out.println(rawPassword);
        // TODO: send to user phone number
    }

    public void setPassword(User user) throws SQLException {
        setPassword(user, genRandomAlphanumStr(6));
    }
}