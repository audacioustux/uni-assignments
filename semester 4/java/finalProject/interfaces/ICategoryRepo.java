package interfaces;

import java.util.*;
import java.sql.*;

import entities.*;

public interface ICategoryRepo {
    Category getCategory(int id) throws SQLException;

    ArrayList<Category> getCategories() throws SQLException;

    ArrayList<Category> getCategoriesOf(Item item) throws SQLException;

    ArrayList<Item> getItems(Category category) throws SQLException;
}