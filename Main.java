import java.io.IOException;
//import java.sql.ResultSet;
//import java.sql.SQLException;

public class Main {

	public static void main(String[] args) throws IOException {
		String indexingURL="";
		Database DB = new Database();
		String startingURL=DB.getStratingURL() ;
		webCrawler Spider = new webCrawler(startingURL,5, DB);
		int countThreads = 0;
		Spider.setName("Thread" + (1+countThreads));
		do{
			
			Spider.start();
			try {
				Thread.currentThread();
				Thread.sleep(10000);
			} catch(InterruptedException e) {

			}
			startingURL = Spider.getNextUrlToVisit();
			Spider = new webCrawler(startingURL, DB);
			countThreads++;
			Spider.setName("Thread" + (1+countThreads));
			
		}while(startingURL != "" && countThreads < Spider.getmaxNumberOfThreads());

		try {
			indexingURL = DB.getIndexingURL();
			do{
			webIndexer indexer=new webIndexer(indexingURL,DB);
			indexer.indexing();
			indexingURL = DB.getIndexingURL();
			} while(indexingURL !="");
			Spider.join();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}