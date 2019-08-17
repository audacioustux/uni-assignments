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

public class MenuFrame extends JFrame {
    JTable menuTB;

    public MenuFrame(User user) {
        super("Snap and Serve - Food List");
        setSize(1280, 720);
        setResizable(false);
        setLayout(new BorderLayout());
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        ItemRepo iRepo = new ItemRepo();
        try {
            ArrayList<Item> itemObjs = iRepo.getItems();
            String columns[] = { "Name", "Detail", "Price" };

            Object[][] items = new Object[itemObjs.size()][3];

            for (int i = 0; i < itemObjs.size() - 1; i++) {
                Item item = itemObjs.get(i);
                items[i][0] = item.getName();
                items[i][1] = item.getDetail();
                items[i][2] = item.getPrice();
                // items[i][0] = item.getName();
            }
            menuTB = new JTable(items, columns);
            JScrollPane sp = new JScrollPane(menuTB);
            add(sp);
        } catch (SQLException e) {
            e.printStackTrace();
        }
        add(menuTB);
    }

    public void showFrame() {
        setVisible(true);
    }
}
