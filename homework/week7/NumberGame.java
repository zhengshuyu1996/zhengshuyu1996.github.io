import java.applet.*;  
import java.awt.*;  
import java.awt.event.*;  
public class NumberGame extends Applet  
{  
    TextField text1,text2;  
    Button button1,button2,button3;  
    int key=(int)(Math.random()*200)+1;  
    int time=0;  
    public void init()  
    {  
        text1=new TextField(10);  
        text2=new TextField(25);  
        button1=new Button("Guess");  
        button2=new Button("Truth");  
        button3=new Button("New Game");
        add(text1);  
        add(button1); 
        add(text2);  
        add(button2);  
        add(button3);
        text1.addActionListener(new TextAct());  
        text2.addActionListener(new TextAct());  
        button1.addActionListener(new ButtonAct());  
        button2.addActionListener(new ButtonAct());  
        button3.addActionListener(new ButtonAct());  
    }  
    class TextAct implements ActionListener  
    {  
        public void actionPerformed(ActionEvent e)  
        {  
            TextField text;  
            int operand;  
            text=(TextField)(e.getSource());  
            operand=Integer.parseInt(text.getText());  
            if(operand<0|operand>200)  
                text.setText("输入数据越界");  
        }  
    }  
    class ButtonAct implements ActionListener  
    {  
        public void actionPerformed(ActionEvent e)  
        {  
            int input;  
            if(e.getSource()==button1)  
            {  
                input=Integer.parseInt(text1.getText());  
                if(key==input)  
                {  
                    text2.setText("goodluck! "+"you have used "+Integer.toString(time)+" times!");  
                }  
                else  
                {  
                    time++;  
                    if(key>input)  
                        text2.setText("you are small!");  
                    else text2.setText("you are large!");  
                }  
            }  
            else if (e.getSource()==button2)  
            {  
                text2.setText("you are so foolish....");  
                text1.setText(Integer.toString(key));  
            } 
            else 
            {
                key=(int)(Math.random()*200)+1; 
                time=0;  
                text1.setText("");
                text2.setText("");
            } 
        }  
    }  
      
}  