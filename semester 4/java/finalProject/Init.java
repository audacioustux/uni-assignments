
// import repositories.*;
import java.sql.*;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import frames.*;
import entities.*;

public class Init {
    static User loggedUser;

    public static void main(String args[]) {
        WelcomeFrame welcomeFrame = new WelcomeFrame();
        loggedUser = welcomeFrame.showFrame();
        // java.sql.Date CreatedDate = new java.sql.Date(System.currentTimeMillis());
        // java.sql.Time CreatedTime = new java.sql.Time(System.currentTimeMillis());
        // System.out.println(CreatedDate.toString()+ "%%"+ CreatedTime.toString());
    }
}