package frames;

import java.awt.*;
import java.awt.event.*;
import java.sql.SQLException;
import java.util.ArrayList;

import javax.swing.*;
import javax.swing.border.*;
import javax.swing.table.DefaultTableModel;

import entities.*;
import repositories.*;
import interfaces.*;

public class OrderManagerFrame extends JFrame implements IFrame<Void> {
    JTable menuTB;

    public OrderManagerFrame(User user) {
        super("Snap and Serve - Manager");
        setSize(1280, 720);
        setResizable(false);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        OrderRepo ordRepo = new OrderRepo();
        try {
            ArrayList<Order> orderObjs = ordRepo.getOrders();
            String column[] = { "Item", "User ID", "Comment", "Ammount", "Ordered At" };

            Object[][] orders = new Object[orderObjs.size()][5];

            for (int i = 0; i < orderObjs.size(); i++) {
                Order order = orderObjs.get(i);
                orders[i][0] = order.getItem().getName();
                orders[i][1] = order.getOrdered_by().getId();
                orders[i][2] = order.getComment();
                orders[i][3] = order.getAmount();
                orders[i][4] = order.getOrdered_at().toLocalTime();
                // items[i][0] = item.getName();
            }
            menuTB = new JTable(orders, column);
            menuTB.setFont(new Font(Font.MONOSPACED, Font.BOLD, 14));
            setLayout(new BorderLayout());
            add(menuTB.getTableHeader(), BorderLayout.PAGE_START);
            add(menuTB, BorderLayout.CENTER);
        } catch (SQLException e) {
            e.printStackTrace();
        }
        add(menuTB);
    }

    public Void showFrame() {
        setVisible(true);
        return null;
    }
}
