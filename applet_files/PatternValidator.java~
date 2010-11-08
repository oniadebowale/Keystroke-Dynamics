import java.io.*;
import java.net.*;

public class PatternValidator {

	Pattern t;
	//define threshold values;
	final Integer maxDoubleClick = 4;
	final Integer maxSingleClick = 4;
	final Integer maxHoverCount = 20;
	final Integer maxTotalErrors = 40;
	final Integer maxBackspaceCount = 10;
	final Integer maxDeleteCount = 10;
	final Integer maxRightArrowCount = 10;
	final Integer maxLeftArrowCount = 10;
	final Double maxTotalTime = 30000.00; //30 secs
	final Double maxFlightTime = 500.00;
	final Double maxHoldTime = 500.00;


	public PatternValidator(Pattern p)	
	{
		this.t = p;
	}

	public boolean Validate()
	{
		//usermessage("Hello from Applet. via Comet.");
		String msg = "Threshod Values not matched. <br />";
		int check = 1;
		//checks double click count	
		Integer DoubleClickCount = t.getDoubleClickCount();
		if(DoubleClickCount > maxDoubleClick) {
			msg+="Double click count";
			check = 0;
		}
		
		//check single count
		Integer SingleClickCount = t.getSingleClickCount();
		if(SingleClickCount > maxSingleClick) 
		{
			msg+=", Single click count";
			check = 0;
		}

		//check hover count
		Integer HoverCount = t.getHoverCount();
		if(HoverCount > maxHoverCount) 
		{
			msg+=", Hover count";
			check = 0;
		}

		//validate total errors
		Integer TotalErrors = t.getTotalErrors();
		if(TotalErrors > maxTotalErrors) 
		{
			msg+=", Total Errors";
			check = 0;
		}

		//validate backspace count
		Integer BackspaceCount = t.getBackspaceCount();
		if(BackspaceCount > maxBackspaceCount) 
		{
			msg+=", Backspace Count";
			check = 0;
		}

		//validate backspace count
		Integer DeleteCount = t.getDeleteCount();
		if(DeleteCount > maxDeleteCount) 
		{
			msg+=", Delete Count";
			check = 0;
		}
		
		//validates right arrow count
		Integer RightArrowCount = t.getRightArrowCount();
		if(RightArrowCount > maxRightArrowCount) 
		{
			msg+=", Right Arrow Count";
			check = 0;
		}

		//validate left arrow count
		Integer LeftArrowCount = t.getLeftArrowCount();
		if(LeftArrowCount > maxLeftArrowCount) 
		{
			msg+=", Left Arrow Count";
			check = 0;
		}
		
		//validate total time
		Double TotalTime = t.getTotalTime();
		if(TotalTime > maxTotalTime) 
		{
			msg+=", Total Time";
			check = 0;
		}

		//validate all flight times. one at a time
		Double[] dFlightTimes = t.getFlightTimes();
		int FlightTimeExceedFlag = 1;
		for(int i=0;i<dFlightTimes.length;i++) {
				if(dFlightTimes[i] > maxFlightTime) FlightTimeExceedFlag = 0;
		}
		if(FlightTimeExceedFlag == 0)
		{
			msg+=", One Flight Time";
			check = 0;
		}

		//validate holdtimes one at a time
		Double[] dHoldTimes = t.getHoldTimes();
		int FlightHoldExceedFlag = 1;
		for(int i=0;i<dHoldTimes.length;i++) {
				if(dHoldTimes[i] > maxHoldTime) FlightHoldExceedFlag = 0;
		}
		if(FlightHoldExceedFlag == 0)
		{
			msg+=", One Hold Time";
			check = 0;
		}

		//process all errros. if any		
		//send message via comet.
		//concludes the validate function
		if(check == 0)
		{
			msg+= " Exceeds Threshold value(s) ";
			usermessage(msg);
			return false;
		} else 
		{
			return true;
		}

	}

	

	private void usermessage(String msg)
	{

		
		
		try {
		    
			// Send data
			String data = URLEncoder.encode("msg", "UTF-8") + "=" + URLEncoder.encode(msg, "UTF-8");
			URL url = new URL("http://localhost/play/sendtoComet.php");
			URLConnection conn = url.openConnection();
			conn.setDoOutput(true);
			OutputStreamWriter wr = new OutputStreamWriter(conn.getOutputStream());
			wr.write(data);
			wr.flush();
		        
			// Get the response
			BufferedReader rd = new BufferedReader(new InputStreamReader(conn.getInputStream()));
			String line;
			while ((line = rd.readLine()) != null) {
			    // Debug Process line...
				System.out.println(line);
			}
			wr.close();
			rd.close();
		} catch (Exception e) {
		}
	}

}
