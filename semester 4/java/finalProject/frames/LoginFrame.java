package frames;

import java.awt.*;
import java.awt.event.*;
import java.sql.SQLException;

import javax.swing.*;
import javax.swing.border.*;

import entities.*;
import repositories.*;

public class LoginFrame extends JDialog {
    JLabel uLabel, passLabel;
    JPasswordField passTF;
    JTextField uTF;
    JPanel buttJP, panel, userJP, passJP;
    JButton uNextButt, uBackButt, uLoginButt;

    User _user;
    UserRepo uRepo;

    public LoginFrame(JFrame parent, boolean reqManager) {
        super(parent, "Log In", true);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);

        uRepo = new UserRepo();

        uLabel = new JLabel();
        uLabel.setFont(new Font(Font.MONOSPACED, Font.BOLD, 16));
        uLabel.setText("Phone Number: ");
        uLabel.setBorder(new EmptyBorder(0, 0, 5, 0));

        uTF = new JTextField();
        uTF.setPreferredSize(new Dimension(250, 30));
        uTF.setFont(new Font(Font.MONOSPACED, Font.BOLD, 16));
        uTF.setBorder(BorderFactory.createMatteBorder(1, 5, 1, 1, Color.RED));
        uTF.setHorizontalAlignment(JTextField.CENTER);

        passLabel = new JLabel();
        passLabel.setFont(new Font(Font.MONOSPACED, Font.BOLD, 16));
        passLabel.setText("Password: ");
        passLabel.setBorder(new EmptyBorder(0, 0, 5, 0));

        passTF = new JPasswordField();
        passTF.setPreferredSize(new Dimension(250, 30));
        passTF.setFont(new Font(Font.MONOSPACED, Font.BOLD, 16));
        passTF.setBorder(BorderFactory.createMatteBorder(1, 5, 1, 1, Color.RED));
        passTF.setHorizontalAlignment(JTextField.CENTER);

        userJP = new JPanel();
        userJP.setLayout(new BoxLayout(userJP, BoxLayout.Y_AXIS));
        userJP.add(uLabel);
        userJP.add(uTF);

        passJP = new JPanel();
        passJP.setLayout(new BoxLayout(passJP, BoxLayout.Y_AXIS));
        passJP.add(passLabel);
        passJP.add(passTF);

        uNextButt = new JButton();
        uNextButt.setText("Next");
        uBackButt = new JButton();
        uBackButt.setText("Back");
        uLoginButt = new JButton();
        uLoginButt.setText("Login");

        buttJP = new JPanel();
        buttJP.setLayout(new BoxLayout(buttJP, BoxLayout.X_AXIS));
        // buttJP.add(uBackButt);
        buttJP.add(Box.createHorizontalGlue());
        buttJP.add(uNextButt);

        panel = new JPanel();
        panel.setBorder(new EmptyBorder(80, 120, 80, 120));
        panel.setLayout(new BoxLayout(panel, BoxLayout.Y_AXIS));
        panel.add(userJP);
        // panel.add(Box.createRigidArea(new Dimension(0, 15)));
        // panel.add(passJP);
        panel.add(Box.createRigidArea(new Dimension(0, 20)));
        panel.add(buttJP);

        uNextButt.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                try {
                    if (reqManager) {
                        _user = uRepo.getUser(uTF.getText());
                        if (_user == null) {
                            JOptionPane.showMessageDialog(LoginFrame.this, "No Manager is associated with this Number!",
                                    "Not a manager", JOptionPane.ERROR_MESSAGE);
                            return;
                        }
                        if (_user.getIs_manager() == false) {
                            JOptionPane.showMessageDialog(LoginFrame.this, "Please Login as Customer", "Not a manager",
                                    JOptionPane.ERROR_MESSAGE);
                            return;
                        }
                    }
                    _user = uRepo.getUserOrInsert(uTF.getText());
                    uTF.setEditable(false);
                    panel.remove(buttJP);
                    panel.add(passJP);
                    buttJP.removeAll();
                    buttJP.add(uBackButt);
                    buttJP.add(Box.createHorizontalGlue());
                    buttJP.add(uLoginButt);
                    panel.add(Box.createRigidArea(new Dimension(0, 15)));
                    panel.add(buttJP);
                    pack();

                } catch (SQLException err) {
                }
            }
        });

        uBackButt.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                uTF.setEditable(true);
                panel.removeAll();
                buttJP.removeAll();
                buttJP.add(Box.createHorizontalGlue());
                buttJP.add(uNextButt);
                panel.add(userJP);
                panel.add(Box.createRigidArea(new Dimension(0, 20)));
                panel.add(buttJP);
                pack();
            }
        });

        uLoginButt.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                try {
                    if (uRepo.authenticate(_user, String.valueOf(passTF.getPassword()))) {
                        setVisible(false);
                        dispose();
                    } else {
                        JOptionPane.showMessageDialog(LoginFrame.this, "Password Mismatch!", "Login failed",
                                JOptionPane.ERROR_MESSAGE);
                    }
                } catch (SQLException err) {
                }
            }
        });

        add(panel);
        pack();
        setLocationByPlatform(true);
    }

    public LoginFrame(JFrame parent) {
        this(parent, false);
    }

    public User showFrame() {
        setVisible(true);
        return _user;
    }
}
