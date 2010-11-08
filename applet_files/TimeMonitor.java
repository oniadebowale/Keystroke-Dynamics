/**
 * This is handles the time monitoring functions
 * 
 * @author  	Jinah Adam
 * @version     0.2
 * @date	09/08/2009
 */
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.util.Vector;

public class TimeMonitor extends Monitor implements KeyListener,ActionListener
{
	private double KeyHoldTime;
	private double KeyFlightTime;
	private double TotalTime = 0;
	private double TotalFlightTime = 0;
	private double AverageFlightTime = 0;
	private double AverageHoldTime = 0;
	private double TotalHoldTime = 0;
	private double sTotalTime;	
        private int releaseCount = 0;
	private long startTime,startTime2; //for key hold time and flight time calculation
	private static final String newline = System.getProperty("line.separator");
	Vector<Double> HoldTimeVector = new Vector<Double>();
	Vector<Double> FlightTimeVector = new Vector<Double>();


	/** 
	* Creates a Time monitoring object.
	*
	* @param tf       The TextField to attache the mouseListener 
	*/
	public TimeMonitor(TextField tf)
	{
		tf.addKeyListener(this);
		tf.addActionListener(this);
		
	}

	//KeyListener Implementation
	
  	  /** Handle the key typed event from the text field. */
        public void keyTyped(KeyEvent e) {
    	  //  displayInfo(e, "KEY TYPED: ");
    	}
    
   	 /** Handle the key pressed event from the text field. */
 	public void keyPressed(KeyEvent e) {
        //	displayInfo(e, "KEY PRESSED: ");
	        startTime = e.getWhen();
    	}
    
    	/** Handle the key released event from the text field. */
        public void keyReleased(KeyEvent e) {
		

        	
	        long endTime = e.getWhen();
                KeyHoldTime = (endTime - startTime);
		this.AddHoldTime(KeyHoldTime);
		//calcualtes flight time .. i.e. the measurement is in reverse order	

		if(releaseCount > 0) {
 			KeyFlightTime = (endTime - startTime2);
			this.AddFlightTime(KeyFlightTime);
			TotalFlightTime = TotalFlightTime + KeyFlightTime;
			//average flight time
			AverageFlightTime = TotalFlightTime / releaseCount;
		}
		else
		{
			//start calculate Total times		
			sTotalTime = e.getWhen();
		}


		startTime2 = e.getWhen(); 
		
		

		TotalHoldTime += KeyHoldTime;	
		AverageHoldTime = TotalHoldTime / releaseCount;

		releaseCount++;
			

    	}
	
	//action listener implementeted to mearusre the total time
	public void actionPerformed(ActionEvent e) { 
             TotalTime = (e.getWhen() - sTotalTime);
        }

	
	//vector manipulation
	private void AddFlightTime(double FlightTime)
	{
		FlightTimeVector.add(FlightTime);
	}

	/** 
	* Returns the flight time
	*
	* @return  Array of flight times in milliseconds
	*/
	public Double[] getFlightTimes()
	{	
		Double[] arr = new Double[FlightTimeVector.size()];
		FlightTimeVector.toArray(arr);
		return arr;
	}


	private void AddHoldTime(double HoldTime)
	{
		HoldTimeVector.add(HoldTime);
	}

	/** 
	* Returns the Hold time
	*
	* @return  Array of Hold times in milliseconds
	*/
	public Double[] getHoldTimes()
	{	
		Double[] arr = new Double[HoldTimeVector.size()];
		HoldTimeVector.toArray(arr);
		return arr;
	}

	
	/** 
	* Returns the total time taken for the password to be typed.
	*
	* @return  TotalTime in milliseconds
	*/
	public double getTotalTime()
	{
		return TotalTime;
	}

	/** 
	* Returns the total Holdtime
	*
	* @return  Total Hold time in milliseconds
	*/
	public double getTotalHoldTime()
	{
		return TotalHoldTime;
	}

	/** 
	* Returns the total Flight Time
	*
	* @return  Total Flight time in milliseconds
	*/
	public double getTotalFlightTime()
	{
		return TotalFlightTime;
	}

	/** 
	* Returns the average flight time
	*
	* @return  Average flight time in milliseconds
	*/
	public double getAverageFlightTime()
	{
		return AverageFlightTime;
	}

	/** 
	* Returns the average Hold time
	*
	* @return  Average Hold time in milliseconds
	*/
	public double getAverageHoldTime()
	{
		return AverageHoldTime;
	}
	
	
}
