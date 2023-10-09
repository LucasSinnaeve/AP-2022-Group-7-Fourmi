package DAO;

import java.sql.PreparedStatement;
	import java.sql.ResultSet;
	import java.sql.SQLException;
	
	import C.Jconnector;

public class DAOprincipale {
	public static ResultSet appelsql1() {
	   	 Jconnector conn = new Jconnector();
	   	 PreparedStatement stmt = null;
	   	 try {
				stmt = conn.getConnection().prepareStatement("SELECT * From boxes");
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	   	 
	   	 try {
				return stmt.executeQuery();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}    	 
	   	 return null;
	    }

	public static ResultSet appelsql2(String unecote, String uneallee) {
   	 Jconnector conn = new Jconnector();
   	 PreparedStatement stmt2 = null;
   	 if(unecote == "Gauche") {
   		 unecote = "g";
   	 }else {
   		 unecote = "d";
   	 }
   	 System.out.println(unecote);
   	 try {
			stmt2 = conn.getConnection().prepareStatement("SELECT * From boxes WHERE allee = ? AND cote = ?");
			stmt2.setString(1, uneallee);
			stmt2.setString(2, unecote);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
   	 
   	 try {
			return stmt2.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}    	 
   	 return null;
    }
	
	
}
