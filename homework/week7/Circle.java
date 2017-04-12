import java.applet.*;
import java.awt.*;
 
public class Circle extends Applet
{
    public void paint(Graphics g)
    {
        Color redColor = new Color(255,0,0), greenColor = new Color(0,255,0);
        g.setColor(greenColor);
        g.fillOval(50,50,400,400);
        g.setColor(redColor);
        g.fillRect(200,200,100,100);
    }    
}