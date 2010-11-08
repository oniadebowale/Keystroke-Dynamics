
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.util.*;

public class MainController extends Applet implements ActionListener
{
	
	TimeMonitor TimeMon;
	LocationMonitor LocMon;
	ModifierMonitor ModMon;
	ErrorMonitor ErrorMon;
	MouseMonitor MouseMon;
	Monitor entryField;
	String password;
	
	public void init()
	{
				
		entryField = new Monitor();
		add(entryField.inputLine);
		TimeMon = new TimeMonitor(entryField.inputLine);
		LocMon = new LocationMonitor(entryField.inputLine);
		ModMon = new ModifierMonitor(entryField.inputLine);
		ErrorMon = new ErrorMonitor(entryField.inputLine);
		MouseMon = new MouseMonitor(entryField.inputLine);
		entryField.inputLine.addActionListener(this);

		
	}


	public void actionPerformed(ActionEvent e) { 
	      this.password = entryField.inputLine.getText();
              Pattern p = createPattern();
	      //validate Pattern before sending to Adapter (i.e database)
	      PatternValidator v = new PatternValidator(p);
	      if(v.Validate()) {
	       // printPattern(p);
		      Adapter a = new Adapter(p); //create a new adapter object and pass pattern to it
		      a.Send(); //send pattern to database via adapter
	      }
	      remove(entryField.inputLine); //remove the textfield so further modification is not possible.
		
          }

	public Pattern createPattern()
	{
		Integer PatternId = 1;
		Integer DoubleClickCount = MouseMon.getDoubleClickCount();
		Integer SingleClickCount = MouseMon.getSingleClickCount();
		Integer HoverCount = MouseMon.getHoverCount();
		Integer TotalErrors = ErrorMon.getTotalErrors();
		Integer BackspaceCount = ErrorMon.getBackspaceCount();
		Integer DeleteCount = ErrorMon.getDeleteCount();
		Integer RightArrowCount = ErrorMon.getRighArrowCount();
		Integer LeftArrowCount = ErrorMon.getLeftArrowCount();
	
		Double TotalTime = TimeMon.getTotalTime();
		Double AverageFlightTime = TimeMon.getAverageFlightTime();
		Double AverageHoldTime = TimeMon.getAverageHoldTime();
		Double TotalFlightTime = TimeMon.getTotalFlightTime();
		Double TotalHoldTime = TimeMon.getTotalHoldTime();
	
		Double[] FlightTimes = TimeMon.getFlightTimes();
		Double[] HoldTimes = TimeMon.getHoldTimes();
		String[] KeyLocations = LocMon.getLocation();
		String[] KeyModifiers = ModMon.getModifiers();
		Integer[] AllErrors = ErrorMon.getAllErrors();
		Integer[] Backspaces = ErrorMon.getBackspaces();
		Integer[] Deletes = ErrorMon.getDeletes();
		Integer[] RightArrows = ErrorMon.getRightArrows();
		Integer[] LeftArrows = ErrorMon.getLeftArrows();
		String[] Keys = LocMon.getKeys();
		String password = this.password;

		String PatternName = this.getParameter("Name"); 

		
		Pattern p = new Pattern(PatternId,DoubleClickCount,SingleClickCount,HoverCount,TotalErrors,BackspaceCount, DeleteCount,RightArrowCount,LeftArrowCount,TotalTime,
				 AverageFlightTime, AverageHoldTime, TotalFlightTime,TotalHoldTime,FlightTimes,HoldTimes,KeyLocations,KeyModifiers, AllErrors,Backspaces,
				 Deletes,RightArrows,LeftArrows,PatternName,Keys,password);
		return p;

	}

	public void printPattern(Pattern t)
	{
		
		
		System.out.println("id = " + t.getPatternId());
		System.out.println("PatternName = " + t.getPatternName());
		System.out.println("Double Click Count = " + t.getDoubleClickCount());
		System.out.println("Single Click Count = " + t.getSingleClickCount());
		System.out.println("HoverCount = " +  t.getHoverCount());
		System.out.println("TotalErrors =  " + t.getTotalErrors());
		System.out.println("BackspaceCount = " +  t.getBackspaceCount());
		System.out.println("DeleteCount = "  + t.getDeleteCount());
		System.out.println("RightArrowCount = " + t.getRightArrowCount());
		System.out.println("LeftArrowCount =  " + t.getLeftArrowCount());
	
		System.out.println("TotalTime = " + t.getTotalTime());
		System.out.println("AverageFlightTime = " + t.getAverageFlightTime());
		System.out.println("AverageHoldTime = " + t.getAverageHoldTime());
		System.out.println("TotalFlightTime = " + t.getTotalFlightTime());
		System.out.println("TotalHoldTime = " + t.getTotalHoldTime());
	
			
		Double[] FlightTimes = TimeMon.getFlightTimes();
		System.out.print("Flight Time: ");
		for(int i=0;i<FlightTimes.length;i++)
			{ System.out.print(FlightTimes[i] + "::"); }
		System.out.println();

	
		Double[] HoldTimes = TimeMon.getHoldTimes();
		System.out.print("Hold Times: ");
		for(int i=0;i<HoldTimes.length;i++)
			{ System.out.print(HoldTimes[i] + "::"); }
		System.out.println();

		String[] KeyLocations = LocMon.getLocation();
		System.out.print("Key Locations: ");
		for(int i=0;i<KeyLocations.length;i++)
			{ System.out.print(KeyLocations[i] + "::"); }
		System.out.println();

		String[] KeyModifiers = ModMon.getModifiers();
		System.out.print("Key Modifiers: ");
		for(int i=0;i<KeyModifiers.length;i++)
			{ System.out.print(KeyModifiers[i] + "::"); }
		System.out.println();

		Integer[] AllErrors = ErrorMon.getAllErrors();
		System.out.print("All Errors: ");
		for(int i=0;i<AllErrors.length;i++)
			{ System.out.print(AllErrors[i] + "::"); }
		System.out.println();

		Integer[] Backspaces = ErrorMon.getBackspaces();
		System.out.print("Backspaces : ");
		for(int i=0;i<Backspaces.length;i++)
			{ System.out.print(Backspaces[i] + "::"); }
		System.out.println();

		Integer[] Deletes = ErrorMon.getDeletes();
		System.out.print("Deletes : ");
		for(int i=0;i<Deletes.length;i++)
			{ System.out.print(Deletes[i] + "::"); }
		System.out.println();

		Integer[] RightArrows = ErrorMon.getRightArrows();
		System.out.print("Right Arrows  : ");
		for(int i=0;i<RightArrows.length;i++)
			{ System.out.print(RightArrows[i] + "::"); }
		System.out.println();

		Integer[] LeftArrows = ErrorMon.getLeftArrows();
		System.out.print("Left Arrows  : ");
		for(int i=0;i<LeftArrows.length;i++)
			{ System.out.print(LeftArrows[i] + "::"); }
		System.out.println();

		
		String[] Keys = LocMon.getKeys();
		System.out.print("Keys : ");
		for(int i=0;i<Keys.length;i++)
			{ System.out.print(Keys[i] + "::"); }
		System.out.println();
	
		
	}


	
}
