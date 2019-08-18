package frames;

import java.awt.*;
import java.awt.event.*;
import java.sql.SQLException;

import javax.swing.*;
import javax.swing.border.*;

import entities.*;
import repositories.*;
import interfaces.*;

public class OrderFrame extends JDialog implements IFrame<Void> {
    Order order;
    JPanel panel, amountJP, commentJP, buttJP;
    JTextArea commentTF;
    JButton orderButt, cancelButt;
    JLabel amountLabel, commentLabel;

    public OrderFrame(JFrame parent, Item item, User user) {
        super(parent, "Order", true);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);

        amountLabel = new JLabel("Amount: ");

        SpinnerModel amountSpinnerModel = new SpinnerNumberModel(1, 1, 100, 1);
        JSpinner amountSpinner = new JSpinner(amountSpinnerModel);

        commentTF = new JTextArea("", 3, 20);
        commentLabel = new JLabel("Comment: ");

        orderButt = new JButton("Order");
        cancelButt = new JButton("Cancel");

        orderButt.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                try {
                    OrderRepo ordRepo = new OrderRepo();
                    ordRepo.CreateOrder(user, item, commentTF.getText(), (int) amountSpinner.getValue());
                    setVisible(false);
                    dispose();
                } catch (SQLException e) {
                    JOptionPane.showMessageDialog(OrderFrame.this, "hmmm.. sumthing's fishy", "Order Creation failed",
                            JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        cancelButt.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                setVisible(false);
                dispose();
            }
        });

        panel = new JPanel();
        panel.setBorder(new EmptyBorder(40, 80, 40, 80));
        panel.setLayout(new BoxLayout(panel, BoxLayout.Y_AXIS));

        amountJP = new JPanel(new FlowLayout(FlowLayout.LEFT));
        amountJP.add(amountLabel);
        amountJP.add(amountSpinner);

        commentJP = new JPanel(new FlowLayout(FlowLayout.LEFT));
        commentJP.add(commentLabel);
        commentJP.add(commentTF);

        buttJP = new JPanel(new FlowLayout(FlowLayout.CENTER, 10, 5));
        buttJP.add(orderButt);
        buttJP.add(cancelButt);

        panel.add(amountJP);
        panel.add(Box.createRigidArea(new Dimension(0, 10)));
        panel.add(commentJP);
        panel.add(Box.createRigidArea(new Dimension(0, 10)));
        panel.add(buttJP);

        add(panel);
        pack();

        setLocationByPlatform(true);
    }

    public Void showFrame() {
        setVisible(true);
        return null;
    }
}
