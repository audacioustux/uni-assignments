package frames;

import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import entities.*;
import interfaces.*;

public class WelcomeFrame extends JFrame implements IFrame<User> {
	JPanel panel;
	JLabel imgLabel;
	JButton managerBtn, customerBtn;
	ImageIcon snapImg;
	Color snapColor;

	User _user;

	public WelcomeFrame() {
		super("Welcome to Snap and Serve");
		this.setSize(1366, 748);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		snapColor = new Color(112, 89, 217);

		panel = new JPanel();
		panel.setLayout(null);
		panel.setBackground(snapColor);

		snapImg = new ImageIcon("Snap and serve logo.jpg");
		imgLabel = new JLabel(snapImg);
		imgLabel.setBounds(430, 50, 500, 350);
		panel.add(imgLabel);

		managerBtn = new JButton("Manager Login");
		managerBtn.setBounds(400, 500, 170, 50);
		managerBtn.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				_user = new LoginFrame(WelcomeFrame.this, true).showFrame();
				if(_user != null){
					setVisible(false);
					new OrderManagerFrame(_user).showFrame();
					dispose();
				}
			}
		});
		panel.add(managerBtn);

		customerBtn = new JButton("Customer Login");
		customerBtn.setBounds(800, 500, 170, 50);
		customerBtn.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				_user = new LoginFrame(WelcomeFrame.this).showFrame();
				if(_user != null){
					setVisible(false);
					new MenuFrame(_user).showFrame();
					dispose();
				}
			}
		});
		panel.add(customerBtn);

		this.add(panel);
	}

	public User showFrame() {
		setVisible(true);
		return _user;
	}
}