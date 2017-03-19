
	import java.sql.Connection;
	import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
	import java.sql.SQLException;
	import java.sql.Statement;
	
public class Database {

	public Connection conn = null;
	 
		public Database() {
			try {
				Class.forName("com.mysql.jdbc.Driver");
				String url = "jdbc:mysql://localhost:3306/searchengine?useUnicode=yes&characterEncoding=UTF-8";
				conn = DriverManager.getConnection(url, "root", "");
				//System.out.println("conn built");
			} catch (SQLException e) {
				e.printStackTrace();
			} catch (ClassNotFoundException e) {
				e.printStackTrace();
			}
		}
	 
		public ResultSet runSql(String sql) throws SQLException {
			Statement sta = conn.createStatement();
			return sta.executeQuery(sql);
		}
	 
		public boolean runSql2(String sql) throws SQLException {
			Statement sta = conn.createStatement();
			return sta.execute(sql);
		}
	 
		@Override
		protected void finalize() throws Throwable {
			if (conn != null || !conn.isClosed()) {
				conn.close();
			}
		}
		public int updateSql(String sql) throws SQLException {
			Statement sta = conn.createStatement();
			return sta.executeUpdate(sql);
		}
	
		//SQL Insert in indexer
		public void insertIndexer(String Keyword,int ID,int count) throws SQLException
		{
			String query = " insert into indexer (UrlID,count,Keyword)"  + " values (?,?,?)";
			try
			{
			PreparedStatement sqlStatement= conn.prepareStatement(query);
			sqlStatement.setInt (1, ID);
			sqlStatement.setInt (2, count);
			sqlStatement.setString (3, Keyword);
			sqlStatement.execute();
			}
			catch(SQLException s)
			{
				return;
			}
		}
		public void isIndexed(int ID)
		{
			String query = " Update visitedpages set Indexed = 1 where ID = ?" ;
			PreparedStatement preparedStmt = null;
			try {
				preparedStmt = conn.prepareStatement(query);
				preparedStmt.setInt(1,ID);
				preparedStmt.executeUpdate();
			    
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
		}
	
	public String getStratingURL()
	{
		String startingURL="" ;
		String countURLS = "SELECT * FROM visitedpages";
		try {
			ResultSet emptyDBResult =this.runSql(countURLS);
			if(emptyDBResult.next())
			{
				boolean x=emptyDBResult.last();
				if(x)
				{
				startingURL=emptyDBResult.getString("Url");
				}
			}
			else
			{
				startingURL= "https://www.youtube.com/";
			}
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		return startingURL;
	}
	
	public String getIndexingURL()
	{
		String startingURL="" ;
		String notIndexedURLS = "SELECT * FROM visitedpages where Indexed=0";
		try {
			ResultSet DBResult =this.runSql(notIndexedURLS);
			if(DBResult.next())
			{
				startingURL=DBResult.getString(1);
			}
			
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		return startingURL;
	}
	
}

