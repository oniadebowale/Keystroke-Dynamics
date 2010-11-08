import java.io.*;
import java.net.*;

public class Adapter { 

	Pattern t;

	public Adapter(Pattern t) {	
		this.t = t;
	}
	
	public void Send()
	{
		String data = PatternToURLData(t);
		
		try {
		    
			// Send data
			URL url = new URL("http://localhost/play/applet.php");
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

	private String PatternToURLData(Pattern t)
	{
		this.t = t;		
		String data = "";
		try {

			String id  = t.getPatternId().toString();
			data = URLEncoder.encode("PatternID", "UTF-8") + "=" + URLEncoder.encode(id, "UTF-8");

			String TemplateName = t.getPatternName();
			data += "&" + URLEncoder.encode("TemplateName", "UTF-8") + "=" + URLEncoder.encode(TemplateName, "UTF-8");
		
			String DoubleClickCount = t.getDoubleClickCount().toString();
			data += "&" + URLEncoder.encode("DoubleClickCount", "UTF-8") + "=" + URLEncoder.encode(DoubleClickCount, "UTF-8");

			String SingleClickCount = t.getSingleClickCount().toString();
			data += "&" + URLEncoder.encode("SingleClickCount", "UTF-8") + "=" + URLEncoder.encode(SingleClickCount, "UTF-8");

			String HoverCount = t.getHoverCount().toString();
			data += "&" + URLEncoder.encode("HoverCount", "UTF-8") + "=" + URLEncoder.encode(HoverCount, "UTF-8");

			String TotalErrors = t.getTotalErrors().toString();
			data += "&" + URLEncoder.encode("TotalErrors", "UTF-8") + "=" + URLEncoder.encode(TotalErrors, "UTF-8");

			String BackspaceCount = t.getBackspaceCount().toString();
			data += "&" + URLEncoder.encode("BackspaceCount", "UTF-8") + "=" + URLEncoder.encode(BackspaceCount, "UTF-8");

			String DeleteCount = t.getDeleteCount().toString();
			data += "&" + URLEncoder.encode("DeleteCount", "UTF-8") + "=" + URLEncoder.encode(DeleteCount, "UTF-8");

			String RightArrowCount = t.getRightArrowCount().toString();
			data += "&" + URLEncoder.encode("RightArrowCount", "UTF-8") + "=" + URLEncoder.encode(RightArrowCount, "UTF-8");

			String LeftArrowCount = t.getLeftArrowCount().toString();
			data += "&" + URLEncoder.encode("LeftArrowCount", "UTF-8") + "=" + URLEncoder.encode(LeftArrowCount, "UTF-8");
	
			String TotalTime = t.getTotalTime().toString();
			data += "&" + URLEncoder.encode("TotalTime", "UTF-8") + "=" + URLEncoder.encode(TotalTime, "UTF-8");

			String AverageFlightTime = t.getAverageFlightTime().toString();
			data += "&" + URLEncoder.encode("AverageFlightTime", "UTF-8") + "=" + URLEncoder.encode(AverageFlightTime, "UTF-8");

			String AverageHoldTime =  t.getAverageHoldTime().toString();
			data += "&" + URLEncoder.encode("AverageHoldTime", "UTF-8") + "=" + URLEncoder.encode(AverageHoldTime, "UTF-8");

			String TotalFlightTime = t.getTotalFlightTime().toString();
			data += "&" + URLEncoder.encode("TotalFlightTime", "UTF-8") + "=" + URLEncoder.encode(TotalFlightTime, "UTF-8");
	
			String TotalHoldTime =  t.getTotalHoldTime().toString();
			data += "&" + URLEncoder.encode("TotalHoldTime", "UTF-8") + "=" + URLEncoder.encode(TotalHoldTime, "UTF-8");

			String password =  t.getPassword();
			System.out.println(password);
			data += "&" + URLEncoder.encode("password", "UTF-8") + "=" + URLEncoder.encode(password, "UTF-8");
	
			
			Double[] dFlightTimes = t.getFlightTimes();
			String FlightTimes = "";
			for(int i=0;i<dFlightTimes.length;i++) {
				FlightTimes += dFlightTimes[i].toString() + ",";
			}
			data += "&" + URLEncoder.encode("FlightTimes", "UTF-8") + "=" + URLEncoder.encode(FlightTimes, "UTF-8");
	
			Double[] dHoldTimes = t.getHoldTimes();
			String HoldTimes = "";
			for(int i=0;i<dHoldTimes.length;i++) {
				HoldTimes += dHoldTimes[i].toString() + ",";
			}
			data += "&" + URLEncoder.encode("HoldTimes", "UTF-8") + "=" + URLEncoder.encode(HoldTimes, "UTF-8");
		
			String[] sKeyLocations = t.getLocations();
			String KeyLocations = "";
			for(int i=0;i<sKeyLocations.length;i++)
				{ KeyLocations += sKeyLocations[i] + ","; }
			data += "&" + URLEncoder.encode("KeyLocations", "UTF-8") + "=" + URLEncoder.encode(KeyLocations, "UTF-8");
	
			String[] sKeyModifiers = t.getModifiers();
			String KeyModifiers = "";
			for(int i=0;i<sKeyModifiers.length;i++)
				{ KeyModifiers += sKeyModifiers[i] + ","; }
			data += "&" + URLEncoder.encode("KeyModifiers", "UTF-8") + "=" + URLEncoder.encode(KeyModifiers, "UTF-8");

			Integer[] iAllErrors = t.getAllErrors();
			String AllErrors = "";
			for(int i=0;i<iAllErrors.length;i++)
				{ AllErrors += iAllErrors[i].toString() + ","; }
			data += "&" + URLEncoder.encode("AllErrors", "UTF-8") + "=" + URLEncoder.encode(AllErrors, "UTF-8");

			Integer[] iBackspaces = t.getBackspaces();
			String Backspaces = "";
			for(int i=0;i<iBackspaces.length;i++)
				{ Backspaces += iBackspaces[i].toString() + ","; }
			data += "&" + URLEncoder.encode("Backspaces", "UTF-8") + "=" + URLEncoder.encode(Backspaces, "UTF-8");

			Integer[] iDeletes = t.getDeletes();
			String Deletes = "";
			for(int i=0;i<iDeletes.length;i++)
				{ Deletes += iDeletes[i].toString() + ","; }
			data += "&" + URLEncoder.encode("Deletes", "UTF-8") + "=" + URLEncoder.encode(Deletes, "UTF-8");

			Integer[] iRightArrows = t.getRightArrows();
			String RightArrows = "";
			for(int i=0;i<iRightArrows.length;i++)
				{ RightArrows += iRightArrows[i].toString() + ","; }
			data += "&" + URLEncoder.encode("RightArrows", "UTF-8") + "=" + URLEncoder.encode(RightArrows, "UTF-8");

			Integer[] iLeftArrows = t.getLeftArrows();
			String LeftArrows = "";
			for(int i=0;i<iLeftArrows.length;i++)
				{ LeftArrows += iLeftArrows[i].toString() + ","; }
			data += "&" + URLEncoder.encode("LeftArrows", "UTF-8") + "=" + URLEncoder.encode(LeftArrows, "UTF-8");

			String[] sKeys = t.getKeys();
			String Keys = "";
			for(int i=0;i<sKeys.length;i++)
				{ Keys += sKeys[i] + ","; }
			data += "&" + URLEncoder.encode("Keys", "UTF-8") + "=" + URLEncoder.encode(Keys, "UTF-8");

		} catch (Exception e) {
		}

		return data;
		
		
	}

}
