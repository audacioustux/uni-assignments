package interfaces;

import java.util.*;
import java.sql.*;

import entities.*;

public interface IItemRepo {
    Item getItem(int id) throws SQLException;

    ArrayList<Item> getItems() throws SQLException;
}