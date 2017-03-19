import java.io.IOException;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;

import org.jsoup.Connection;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;

public class webIndexer {
	private String indexingURL = "";
	private Database DB;
	public webIndexer(String indexingURL,Database DB)
	{
		this.indexingURL = indexingURL;
		this.DB = DB;
	}
	
	public void indexing()
	{
		String bodyText = "";
		boolean valid = true;
		Document webPage = null;
		HashMap <String,Integer>keywordsCount=new HashMap<String ,Integer>();
		Connection conn = Jsoup.connect(indexingURL);
		try {
			webPage = conn.get();
				
		} catch (IOException e) {
				valid = false;
		}
		if(valid)
		{
			bodyText = webPage.body().text();
			 String [] enterSplit = bodyText.split("\r\n");
			 String [] keywords = null;
			 int URLID = 0;
			 String sql="Select ID From visitedpages where Url = '"+indexingURL+"'";
			 try {
				ResultSet Result = DB.runSql(sql);
				Result.next();
				URLID = Result.getInt(1);
			 	} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			 }
			 for( int i = 0 ; i < enterSplit.length ; i++ )
			 {
				 keywords = enterSplit[i].split(" ");
			 }
			  
			 for(int i = 0 ; i < keywords.length ; i++ )
			 {		 
				 if(keywordsCount.containsKey(keywords[i]))
				
				 {
					int c = keywordsCount.get(keywords[i]);
					keywordsCount.put(keywords[i], ++c);		
				 }
			   
				else
				
				{
					keywordsCount.put(keywords[i], 1);
				}

			 }
			 for(int i = 0; i<keywordsCount.size();i++)
			 {
				 try {
					DB.insertIndexer(keywordsCount.keySet().toArray()[i].toString(),URLID,keywordsCount.get(keywordsCount.keySet().toArray()[i]));
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			 }
			 
			 DB.isIndexed(URLID);
		}
			 
	}

	
	public void insertKeyword(String keyword) throws SQLException
	{
		String query = " insert into keyword (keyword)"  + " values (?)";
		try
		{
		PreparedStatement sqlStatement= DB.conn.prepareStatement(query);
		sqlStatement.setString (1, keyword);
		sqlStatement.execute();
		}
		catch(SQLException s)
		{
			return;
		}
	}
}
