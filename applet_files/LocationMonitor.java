/**
 * This is handles give the Keylocations of every key pressed
 * Where in the keyboard the key is located. example. numpad.   
 * Location of the keys right or left
 *
 * @author  	Jinah Adam
 * @version     0.1
 * @date	11/08/2009
 */


import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.util.Vector;



public class LocationMonitor extends Monitor implements KeyListener 
{
	
	Vector<String> locations = new Vector<String>();
	Vector<String> keys = new Vector<String>();

	/** 
	* Creates a KeyParameters Object
	*
	* @param tf  TextField to add KeyListener
	*/
	public LocationMonitor(TextField tf)
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
    		locations.add(getLoc(e));
		keys.add(getKey(e));
   	}
	//gets key locations
	private String getLoc(KeyEvent e){

		
		String locationString = "";
		int location = e.getKeyLocation();
		if (location == KeyEvent.KEY_LOCATION_STANDARD) {
		    locationString += "standard";
		} else if (location == KeyEvent.KEY_LOCATION_LEFT) {
		    locationString += "left";
		} else if (location == KeyEvent.KEY_LOCATION_RIGHT) {
		    locationString += "right";
		} else if (location == KeyEvent.KEY_LOCATION_NUMPAD) {
		    locationString += "numpad";
		} else {  //(location == KeyEvent.KEY_LOCATION_UNKNOWN)
		    locationString += "unknown";
		}
		
		//for trace

		return locationString;
		
	}

	private String getKey(KeyEvent e){

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

		return keyString;
		
	}

	/** 
	* Returns in an array . Location of all the Keys typed
	* Standard, Numpad, left or Right
	*
	* @return  Returns in an array . Location of all the Keys typed
	*/
	public String[] getLocation()
	{	
		String[] arr = new String[locations.size()];
		locations.toArray(arr);
		return arr;
	}
	public String[] getKeys()
	{	
		String[] arr = new String[keys.size()];
		keys.toArray(arr);
		return arr;
	}




}
