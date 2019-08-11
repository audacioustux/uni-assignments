package interfaces;

import java.sql.SQLException;

import entities.*;

public interface IUserRepo {
    int getUserId(String ph_number) throws SQLException;

    User getUser(int userId, String rawPassword) throws SQLException;

    void insertUser(User u) throws SQLException;

    void updateUser(User u) throws SQLException;

    void deleteUser(String userId) throws SQLException;
}