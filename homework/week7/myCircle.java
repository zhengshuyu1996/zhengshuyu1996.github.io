import java.applet.*;
import java.awt.*;
 
public class myCircle extends Applet
{
    public void paint(Graphics g)
    {
    	String red = getParameter("r"),
    		   green = getParameter("g"),
    		   blue = getParameter("b"),
    		   shape = getParameter("shape");

    	int cr = Integer.parseInt(red),
    	    cg = Integer.parseInt(green),
    	    cb = Integer.parseInt(blue);

        Color redColor = new Color(255, 0, 0), 
        	  greenColor = new Color(0, 255, 0),
        	  myColor = new Color(cr, cg, cb);

        g.setColor(greenColor);
        g.fillOval(50,50,400,400);

		g.setColor(myColor);
        g.fillRoundRect(125, 125, 250, 250, 50, 50);
        
        g.setColor(redColor);
        g.fillRect(200,200,100,100);
    }    
}