import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;
import java.util.Vector;



public class robotParser {
	
	
	
	public void robot(URL URL, Vector<String> disallowedURLS, Vector<String> allowedURLS) throws IOException
	{
		
		String host = URL.getHost();
		// form URL of the robots.txt file
	    String robotUrl = "https://" + host + "/robots.txt";
	    
	    URL robotUrlObj = new URL(robotUrl);
	    HttpURLConnection connection = (HttpURLConnection)  robotUrlObj.openConnection();
		try{
			connection.connect();
		}catch(IOException e)
		{
			return;
		}
		
		//validation
		String contentType = connection.getContentType();
		
		int indexOf = 0;
		
	   if(contentType == null || contentType.contains("text/plain"))
	    {
	    	Scanner scan = null;
	    	try{
	    		scan = new Scanner(robotUrlObj.openStream());
	    	}
	    	catch (FileNotFoundException e)
	    	{
	    		return;
	    	}
	    	
	    	
	    	if(scan.hasNextLine()) //to check if isEmpty
	    	{
	    		String lineString = null;
	    		do{
	    			lineString = scan.nextLine();
	    		}while(!lineString.toLowerCase().contains("user-agent: *") && scan.hasNextLine());
	    	
	    		lineString = scan.nextLine();
	    		while(scan.hasNextLine() || lineString.contains("Disallow:") || lineString.contains("Allow:"))  //Check if the robots.txt has finished or more disallow and allow
	    		{
	    			indexOf = lineString.indexOf(":");
	    			if(lineString.contains("Disallow"))
	    			{
	    				if(!lineString.substring(indexOf+2).equals(""))
	    					disallowedURLS.add(lineString.substring(indexOf+2));
	    					
	    			}
	    			else if(lineString.contains("Allow"))
	    			{
	    				allowedURLS.add(lineString.substring(indexOf+2));
	    			}
	    			
	    			if(scan.hasNextLine())
	    				lineString = scan.nextLine();
	    			else lineString = "";
	    		}
	    	}    
	    	scan.close();
	    }
	   
	}
}