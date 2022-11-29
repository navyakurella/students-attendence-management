import java.sql.*;  
class db_conn{  
public static void main(String args[])
{  
try{  
Class.forName("oracle.jdbc.driver.OracleDriver");   
Connection con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:xe","system","system");  
Statement stmt=con.createStatement();
stmt.execute("CREATE TABLE ITSTUDENT(NAME VARCHAR(32),ID INTEGER,ADDRESS VARCHAR(20))");
System.out.println("Table created");
stmt.executeUpdate ( "INSERT INTO ITSTUDENT VALUES ('AKAASH',1201,'Hyderabad')"); 
stmt.executeUpdate ( "INSERT INTO ITSTUDENT VALUES ('AASHIR',1202,'WARANGAL')");
stmt.executeUpdate ( "INSERT INTO ITSTUDENT VALUES ('Rithik',1205,'VIJAYAWADA')");
stmt.executeUpdate ( "INSERT INTO ITSTUDENT VALUES ('HARSHA',1224,'KHAMMAM')");
System.out.println("records inserted");
int n=stmt.executeUpdate("delete from ITSTUDENT where id=1201");
System.out.println(n+" records affected");
n=stmt.executeUpdate("update ITSTUDENT set name='Ahmed',address='VIZAG' where id=1202");    
System.out.println(n+" records affected");
ResultSet rs=stmt.executeQuery("select * from itstudent");  
while(rs.next()){  
System.out.println(rs.getString(1)+" "+rs.getInt(2)+" "+rs.getString(3));  
}  
}  
catch(Exception e)
{ 
System.out.println(e);
}
  }
}
