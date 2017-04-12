import java.applet.Applet;
import java.awt.Graphics;
public class MoveBall extends Applet{ 
	private int xPos = 0;  
	private int xFrame = 1;  
	int counter = 0; 
	public void paint(Graphics g){  
		int width = getSize().width;  
		int height = getSize().height;  
		int yPos = height/2;  
		int diameter = 10;  
		g.fillOval(xPos,yPos,diameter,diameter);  
		if(xPos>width) 
			xFrame = -xFrame;  
		if(xPos<0) 
			xFrame = -xFrame;  
		xPos += xFrame;  
		counter++;  
		if(counter<200000) 
			repaint();  
		else 
			stop();  
	}  
}  