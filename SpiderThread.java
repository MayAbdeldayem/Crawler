import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.HashSet;
import java.util.LinkedList;
import java.util.Vector;

import org.jsoup.Connection;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class SpiderThread extends Thread {
	private static HashSet<String> visitedPages=new HashSet<String>();
	private static LinkedList<String> pagesToVisit= new LinkedList<String>();
	private static final int maxNumberOfPages = 100;
	private String URL;
	//private String nextUrl;
	
	
	
	public SpiderThread(String startingURL) {
		URL=startingURL;
	}

	

	//Crawl
	public String crawl(String URL) throws IOException
	{
		boolean valid = true;
		Document webPage = null;
		String nextUrl="";
		Connection conn = Jsoup.connect(URL);
		try {
			webPage = conn.get();
		} catch (IOException e) {
				valid = false;
		}
		
		if(valid)
		{
			URL url = new URL(URL);
			HttpURLConnection connection = (HttpURLConnection)  url.openConnection();
			Vector<String> disallowedURLS = new Vector<String>();
			Vector<String> allowedURLS = new Vector<String>();
			connection.setRequestMethod("HEAD");
			connection.connect();
			String contentType = connection.getContentType();
		
			if(contentType == null || contentType.contains("text/html"))
			{
				if( URL.startsWith("https") || URL.startsWith("http" ))
				{
					//robot
					robotParser r = new robotParser();
					r.robot(url, disallowedURLS, allowedURLS);
				
					Elements links = webPage.select("a[href]");
					if(!disallowedURLS.isEmpty()) 
					{
						if(!(disallowedURLS.size()==1 && disallowedURLS.get(0) == "/" ))
						{
							for(Element link:links)
							{
								boolean addLink = true;
								//condition eno mesh hay contain el fel array of string men robot
								for(String disallowedLink: disallowedURLS)
								{
									if( link.toString().contains(disallowedLink))
									{
										addLink = false;
										break;
									}		
								}
								if(addLink)
									pagesToVisit.add(link.absUrl("href"));
							}

							visitedPages.add(URL);
							System.out.println(URL);
						}
					}
				}
			}
		}

		//The crawler must not visit the same URL more than once
		do{
			if(pagesToVisit.isEmpty())
				break;
		nextUrl = pagesToVisit.removeFirst();
		}while(nextUrl == "" || visitedPages.contains(nextUrl));
		return nextUrl;
	}

	//Overriding run method in thread
	public void run() {
		
		String startingUrl=URL;
		do{
			
			try {
				startingUrl=crawl(startingUrl);
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			//System.out.println(startingURL);
		}while(visitedPages.size() < maxNumberOfPages);
		
	}
	
	//get Maximum number of pages
	public int getmaxNumberOfPages()
	{
				return maxNumberOfPages;
	}

	//Returning size of visited pages
	public int getSizeOfVisitedPages()
	{
				return visitedPages.size();
	}

	//Print visited pages
	public void PrintVisitedPages()
	{
				for(String Link : visitedPages)
				{
					System.out.println(Link);
				}
	}
					
	
}

