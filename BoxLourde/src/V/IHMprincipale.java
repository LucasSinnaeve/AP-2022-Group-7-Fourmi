package V;
import java.awt.EventQueue;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;

import DAO.*;

import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.JButton;
import javax.swing.SwingConstants;
import javax.swing.JList;
import javax.swing.JComboBox;


import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
public class IHMprincipale extends JFrame {

	private JPanel contentPane;
	private JTable table;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					IHMprincipale frame = new IHMprincipale();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public IHMprincipale() {
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 830, 521);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JComboBox<String> comboBoxCote = new JComboBox<String>();
		comboBoxCote.setBounds(109, 16, 121, 22);
		contentPane.add(comboBoxCote);
		comboBoxCote.addItem("Gauche");
		comboBoxCote.addItem("Droite");
		
		JComboBox<String> comboBoxAllee = new JComboBox<String>();
		comboBoxAllee.setBounds(277, 16, 121, 22);
		contentPane.add(comboBoxAllee);
		comboBoxAllee.addItem("A");
		comboBoxAllee.addItem("B");
		comboBoxAllee.addItem("C");
		comboBoxAllee.addItem("D");
		comboBoxAllee.addItem("E");
		comboBoxAllee.addItem("F");
		comboBoxAllee.addItem("G");
		comboBoxAllee.addItem("H");
		comboBoxAllee.addItem("I");
		comboBoxAllee.addItem("J");
		comboBoxAllee.addItem("K");
		comboBoxAllee.addItem("L");
		comboBoxAllee.addItem("M");
		comboBoxAllee.addItem("N");
		comboBoxAllee.addItem("O");
		comboBoxAllee.addItem("P");
		
				
		DefaultTableModel model = new DefaultTableModel();
        model.addColumn("idbox");
        model.addColumn("code");
        model.addColumn("allee");
        model.addColumn("cote");
        model.addColumn("travee");
        model.addColumn("taille");
        model.addColumn("prix");
        model.addColumn("disponible");
        model.addColumn("datelocation");
        
        ResultSet rs = DAOprincipale.appelsql1();
        // ... ajouter plus de colonnes si nécessaire
        
        // parcourir le ResultSet et ajouter les valeurs dans le TableModel
        try {
			while (rs.next()) {
			    Object[] row = new Object[8];
			    row[0] = rs.getInt("idbox");
			    row[1] = rs.getString("code");
			    row[2] = rs.getString("allee");
			    row[3] = rs.getString("cote");
			    row[4] = rs.getInt("travee");
			    row[5] = rs.getString("taille");
			    row[6] = rs.getFloat("prix");
			    row[7] = rs.getDate("datelocation");
			    
			    // ... ajouter plus de colonnes si nécessaire
			    model.addRow(row);
			}
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		
        table = new JTable(model);
		table.setBounds(92, 54, 664, 406);
		contentPane.add(table);
        
		
		JButton btnRecherche = new JButton("Recherche");
		btnRecherche.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				model.setRowCount(0);
				System.out.println(comboBoxAllee.getSelectedItem().toString());
				System.out.println(comboBoxCote.getSelectedItem().toString());
				ResultSet rs2 = DAOprincipale.appelsql2(comboBoxCote.getSelectedItem().toString(), comboBoxAllee.getSelectedItem().toString());
				System.out.println(rs2);
		        // ... ajouter plus de colonnes si nécessaire
		        
		        // parcourir le ResultSet et ajouter les valeurs dans le TableModel
		        try {
					while (rs2.next()) {
					    Object[] row2 = new Object[8];
					    row2[0] = rs2.getInt("idbox");
					    row2[1] = rs2.getString("code");
					    row2[2] = rs2.getString("allee");
					    row2[3] = rs2.getString("cote");
					    row2[4] = rs2.getInt("travee");
					    row2[5] = rs2.getString("taille");
					    row2[6] = rs2.getFloat("prix");
					    row2[7] = rs2.getDate("datelocation");
					    
					    // ... ajouter plus de colonnes si nécessaire
					    model.addRow(row2);
					}
				} catch (SQLException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
		        table.setModel(model); // mettre à jour le contenu de la JTable
		       
			}
		});
		
		btnRecherche.setBounds(705, 11, 101, 32);
		contentPane.add(btnRecherche);
		
		

		//JScrollPane scrollPane = new JScrollPane(table);
		//scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
	}
}
