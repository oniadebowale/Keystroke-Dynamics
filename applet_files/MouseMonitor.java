/**
 * Monitors Mouse related events in the text box
 *
 * @author  	Jinah Adam
 * @version     0.1
 * @date	11/08/2009
 */

import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.util.Vector;



public class MouseMonitor extends Monitor implements MouseListener 
{
	
	private int hoverCount = 0;
	private int singleClickCount = 0;
	private int doubleClickCount = 0;

	/** 
	* Creates a mouse monitoring object.
	*
	* @param tf       The TextField to attache the mouseListener 
	*/
	public MouseMonitor(TextField tf)
	{
		tf.addMouseListener(this);
	}
	
	public void mousePressed(MouseEvent e) {
        }

        public void mouseReleased(MouseEvent e) {
	}

        public void mouseEntered(MouseEvent e) {
 		hoverCount++;
        }

    	public void mouseExited(MouseEvent e) {
       	}

    	public void mouseClicked(MouseEvent e) {
       		if(e.getClickCount() == 1) 
		{
			singleClickCount++;
		}
		else if(e.getClickCount() == 2) 
		{
			doubleClickCount++;
		}
    	}
	
	/** 
	* 
	* @return   Total time the mouse hovers over the textfield
	**/
	public int getHoverCount()
	{
		return hoverCount;
	}
	
	/** 
	* 
	* @return   Total single clicks within the textfield
	**/
	public int getSingleClickCount()
	{
		return singleClickCount;
	}

	/** 
	* 
	* @return   Total double clicks within the textfield
	**/
	public int getDoubleClickCount()
	{
		return doubleClickCount;
	}

    	


}
