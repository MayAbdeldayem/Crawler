import java.io.IOException;

public class Main {

	public static void main(String[] args) throws IOException {
		
		String startingURL = "https://www.google.com/";
		webCrawler Spider = new webCrawler(startingURL,5);
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
			Spider = new webCrawler(startingURL);
			countThreads++;
			Spider.setName("Thread" + (1+countThreads));
			
		}while(startingURL != "" && countThreads < Spider.getmaxNumberOfThreads());

		try {
			Spider.join();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
		

}
	
