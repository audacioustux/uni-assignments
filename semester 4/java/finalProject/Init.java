import repositories.*;
import java.sql.*;

// import frames.*;
public class Init {
    public static void main(String args[]) throws SQLException {
        OrderRepo oRep = new OrderRepo();
        System.out.println(oRep.getOrders());
    }
}