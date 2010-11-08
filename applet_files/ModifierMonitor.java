/**
 * Observes which modifier have been pressed when the key pressed
 *
 * @author  	Jinah Adam
 * @version     0.1
 * @date	11/08/2009
 */


import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.util.Vector;



public class ModifierMonitor extends Monitor implements KeyListener 
{
	
	
	Vector<String> modifiers = new Vector<String>();

	/** 
	* Creates a ModifierMonitor Object
	*
	* @param tf  TextField to add KeyListener
	*/
	public ModifierMonitor(TextField tf)
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
		modifiers.add(getMod(e));
   	}
	
	private String getMod(KeyEvent e){
	
		int modifiersEx = e.getModifiersEx();
		String modString = "";// + modifiersEx;
		String tmpString = KeyEvent.getModifiersExText(modifiersEx);
		if (tmpString.length() > 0) {
		    modString +=  tmpString;
		} else {
		    modString += "none";
		}
		
		//for trace

		return modString;
		
	}

	

	/** 
	* Returns in an array . Modifiers of all the Keys typed
	* None for no modifiers, Shift or Caps Lock or even control
	*
	* @return  Returns in an array . Modifiers of all the Keys typed
	*/
	public String[] getModifiers()
	{	
		String[] arr = new String[modifiers.size()];
		modifiers.toArray(arr);
		return arr;
	}

}
