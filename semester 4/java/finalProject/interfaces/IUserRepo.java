package interfaces;

import java.sql.SQLException;

import entities.*;

public interface IUserRepo {
    User getUserOrInsert(String ph_number) throws SQLException;

    User getUser(String ph_number) throws SQLException;

    User insertUser(String ph_number) throws SQLException;

    boolean authenticate(User user, String rawPassword) throws SQLException;

    User insertManager(String userId) throws SQLException;

    void setPassword(User user, String rawPassword) throws SQLException;

    void setPassword(User user) throws SQLException;
}