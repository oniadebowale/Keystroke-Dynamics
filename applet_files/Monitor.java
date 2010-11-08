/**
 * Monitoring super class. creates the initial Monitor. allowing client to attach several of the derived monitoring classes.
 * 
 * @author  	Jinah Adam
 * @version     0.2
 * @date	09/08/2009
 */

import java.awt.*;


public class Monitor {
     
     public TextField inputLine;

     /** 
     * Creates a monitor object, i.e a text box 
     *
     */
     public Monitor()
     {
	 inputLine = new TextField(15);
     }

     
	

}
