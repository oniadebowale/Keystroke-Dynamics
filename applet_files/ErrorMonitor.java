/**
 * This class monitors the errors user encounters. by counting how many time user press delete /backspace. and when.
 *
 * @author  	Jinah Adam
 * @version     0.1
 * @date	11/08/2009
 */


import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.util.Vector;



public class ErrorMonitor extends Monitor implements KeyListener 
{
	
	Vector<Integer> allerrors = new Vector<Integer>();
	Vector<Integer> deletes = new Vector<Integer>();
	Vector<Integer> backspaces = new Vector<Integer>();
	Vector<Integer> rightarrows = new Vector<Integer>();
	Vector<Integer> leftarrows = new Vector<Integer>();
	
	private int releaseCount = 0;
	private int TotalErrors = 0;
	private int DeleteCount = 0;
	private int BackspaceCount = 0;
	private int RightArrowCount = 0;
	private int LeftArrowCount = 0;
	
	/** 
	* Creates a ErrorMonitoring Object
	*
	* @param tf  TextField to add KeyListener
	*/
	public ErrorMonitor(TextField tf)
	{
		tf.addKeyListener(this);
	}

	
  	  /** Handle the key typed event from the text field. */
        public void keyTyped(KeyEvent e) {
   		//do nothing
    	}
    
   	 /** Handle the key pressed event from the text field. */
 	public void keyPressed(KeyEvent e) {
		//do nothing
    	}
    
    	/** Handle the key released event from the text field. */
        public void keyReleased(KeyEvent e) {
		
        	int r = getKey(e);
		releaseCount++;		
		updateCount(r);
	
		//System.out.println(TotalErrors);
		//System.out.println(RightArrowCount);
		//System.out.println(LeftArrowCount);
		//System.out.println(DeleteCount);
		//System.out.println(BackspaceCount);
		
   	}
	
	
	private void updateCount(int keyCode)
	{
		// Keycodes		
		// 8   backspace
		// 127 delete
		// 37  left arrow 
		// 39  right arrow
		switch(keyCode)
		{
			case 8:
				BackspaceCount++;
				TotalErrors++;
				allerrors.add(releaseCount);
				backspaces.add(releaseCount);
				break;
			case 127:
				DeleteCount++;
				TotalErrors++;
				allerrors.add(releaseCount);
				deletes.add(releaseCount);
				break;
			case 37:	
				RightArrowCount++;
				TotalErrors++;
				allerrors.add(releaseCount);
				rightarrows.add(releaseCount);
				break;
			case 39:
				LeftArrowCount++;
				TotalErrors++;
				allerrors.add(releaseCount);
				leftarrows.add(releaseCount);
				break;
			default:
				//do nothing for other keys
				break;
			
		}
	}
	
	private int getKey(KeyEvent e){

		//You should only rely on the key char if the event
		//is a key typed event.
		int id = e.getID();
		String keyString;
		int keyCode = 0;
		if (id == KeyEvent.KEY_TYPED) {
		    Character c = e.getKeyChar();
		    keyString = c.toString();
		    
		} else {
		    keyCode = e.getKeyCode();
		    keyString = KeyEvent.getKeyText(keyCode);
		}

		return keyCode;
		
	}
	
	//getters

	/** 
	* Returns in an array . List of All Errors
	*
	* @return  List of all errors ( measured by how they are corrected).
	*/
	public Integer[] getAllErrors()
	{	
		Integer[] arr = new Integer[allerrors.size()];
		allerrors.toArray(arr);
		return arr;
	}

	/** 
	* Returns in an array . List of all the deletes and which character was deleted
	*
	* @return  Array of Number of all the characters that were deleted wit the Delete key
	*/
	public Integer[] getDeletes()
	{	
		Integer[] arr = new Integer[deletes.size()];
		deletes.toArray(arr);
		return arr;
	}

	/** 
	* Returns in an array . List of all the deletes and which character was deleted
	*
	* @return  Array of Number of all the characters that were deleted wit the backspace key
	*/
	public Integer[] getBackspaces()
	{	
		Integer[] arr = new Integer[backspaces.size()];
		backspaces.toArray(arr);
		return arr;
	}

	/** 
	* Measure right arrow key usage for error Correction
	*
	* @return  Array of Number of times the right arrow key have been used for error correction
	*/
	public Integer[] getRightArrows()
	{	
		Integer[] arr = new Integer[rightarrows.size()];
		rightarrows.toArray(arr);
		return arr;
	}

	/** 
	* Measure left arrow key usage for error Correction
	*
	* @return  Array of Number of times the left arrow key have been used for error correction
	*/
	public Integer[] getLeftArrows()
	{	
		Integer[] arr = new Integer[leftarrows.size()];
		leftarrows.toArray(arr);
		return arr;
	}
	
	/** 
	* Total Number of Errors
	*
	* @return  Total number of Errors
	*/
	public int getTotalErrors()
	{
		return TotalErrors;
	}

	/** 
	* Measure the number of times the Delete Key was pressed 
	*
	* @return  The number of times the delete key was pressed.
	*/
	public int getDeleteCount()
	{
		return DeleteCount;
	}

	/** 
	* Measure the number of times the backspace Key was pressed 
	*
	* @return  The number of times the backspace key was pressed.
	*/
	public int getBackspaceCount()
	{
		return BackspaceCount;
	}

	/** 
	* Measure the number of times the Right Arrow Key was pressed 
	*
	* @return  The number of times the Right Arrow key was pressed.
	*/
	public int getRighArrowCount()
	{
		return RightArrowCount;
	}

	/** 
	* Measure the number of times the Left Arrow Key was pressed 
	*
	* @return  The number of times the Left Arrow key was pressed.
	*/
	public int getLeftArrowCount()
	{
	 	return LeftArrowCount;
	}
}
