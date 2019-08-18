package frames;

import java.lang.Void;
import java.awt.*;
import java.sql.SQLException;
import java.util.*;

import javax.swing.*;

import entities.*;
import repositories.*;
import interfaces.*;

public class MenuFrame extends JFrame implements IFrame<Void> {
    JTable menuTB;

    public MenuFrame(User user) {
        super("Snap and Serve - Food List");
        setMinimumSize(new Dimension(1280, 720));
        setLayout(new BorderLayout());
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        ItemRepo iRepo = new ItemRepo();
        try {
            ArrayList<Item> itemObjs = iRepo.getItems();
            String column[] = { "Name", "Detail", "Price", "id" };

            Object[][] items = new Object[itemObjs.size()][4];

            for (int i = 0; i < itemObjs.size(); i++) {
                Item item = itemObjs.get(i);
                items[i][0] = item.getName();
                items[i][1] = item.getDetail();
                items[i][2] = item.getPrice();
                items[i][3] = item.getId();
            }
            menuTB = new JTable(items, column);
            menuTB.setDefaultEditor(Object.class, null);
            menuTB.setFont(new Font(Font.MONOSPACED, Font.BOLD, 14));
            menuTB.removeColumn(menuTB.getColumn("id"));

            menuTB.addMouseListener(new java.awt.event.MouseAdapter() {
                public void mouseClicked(java.awt.event.MouseEvent evt) {
                    int row = menuTB.rowAtPoint(evt.getPoint());
                    int col = menuTB.columnAtPoint(evt.getPoint());
                    if (row >= 0 && col >= 0) {
                        new OrderFrame(MenuFrame.this, new Item((int) items[row][3]), user).showFrame();
                    }
                }
            });

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
