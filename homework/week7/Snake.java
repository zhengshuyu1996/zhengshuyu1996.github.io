import java.awt.*; 
import java.awt.event.*; 
import java.applet.*;  
  
public class Snake extends Applet implements Runnable
{  
 Image     offI;  
 Graphics  offG; 
 Dimension d; 
   
 int x[]= new int[400];  
 int y[]= new int[400];  
 int rtemp=1;  
 int game=1;  
 int level;  
 int z;  
 int n;  
 int count=0;  
 int score=0;  
 int add=1;  
   
 Button b = new Button("Beginner");  
 Button i = new Button("Intermediate");  
 Button p = new Button("Professional");  
 Button X = new Button("Xtreamest");  
   
 String stemp;  
 String s;  
 String t;  
   
 boolean go[]=new boolean[400];  
 boolean left=false;  
 boolean right=false;  
 boolean up=false;  
 boolean down=false;  
 boolean started=false ;  
 boolean me=false;  
   
 Thread setTime;  
   
 public void init()  
 {  
  add(b);  
  add(i);  
  add(p);  
  add(X);  
  d = this.getSize();
  setBackground(Color.black);
 }  
   
 public void update(Graphics g)  
 {  
  if(offI == null)  
  {  
   offI = createImage(d.width, d.height);  
   offG = offI.getGraphics();  
  }  
  offG.clearRect(0, 0, d.width, d.height);  
  paint(offG);  
  g.drawImage(offI, 0, 0, null);  
 }  
   
 public void paint(Graphics g)  
 {  
  g.setColor(Color.white);  
    
  if(started)  
  {  
   g.setFont(new Font("Verdana", 1, 30));  
   t = "Score "+score+"";  
   g.drawString(t, d.width/5*2, d.height/7*6);  
  }  
    
  if(game==1)  
  {  
   g.setFont(new Font("Arial", 1, 30));  
   s = "Set Mode";  
   g.drawString(s, d.width/5*2, d.height/7);  
     
   b.setLocation(d.width/5*2, d.height/7*2);  
   i.setLocation(d.width/5*2, d.height/7*3);  
   p.setLocation(d.width/5*2, d.height/7*4);  
   X.setLocation(d.width/5*2, d.height/7*5);  
  }  
    
  if((game==2)||(game==3))  
  {  
   if(!started)  
   {  
    g.setFont(new Font("Verdana", 1, 40));  
    t = "Use the key board arrows to move!";  
    g.drawString(t, 40, d.height/2);  
   }  
   for (z=0 ; z <= n ; z++)  
   {   
    g.fillOval(x[z],y[z],10,10);
   }  
   me=true;  
  }  
    
  if(!me)  
  {  
   g.setFont(new Font("Verdana", 1, 11));  
   // t = "by ali";  
   g.drawString(t, 5, 215);   
  }  
    
  if(game==3)  
  {  
   g.setFont(new Font("Verdana", 1, 50));  
   s="Game Over";  
   g.drawString(s, d.width/5*2, d.height/2);  
  }  
 }  
   
 public void run()  
 {  
  for(z=4 ;z <400 ; z++)  
  {  
   go[z]=false;  
  }  
  for(z=0 ; z<4 ; z++)  
  {  
   go[z]=true;  
   x[z]=91;  
   y[z]=91;  
  }  
  n=3;  
  game=2;  
  score=0;  
  b.setLocation(70, -100);  
  i.setLocation(70, -100);  
  p.setLocation(70, -100);  
  X.setLocation(70, -100);  
  left=false;  
  right=false;  
  up=false;  
  down=false;  
  locateRandom(4);  
    
  while(true)  
  {  
   if (game==2)  
   {  
    if ((x[0]==x[n])&&(y[0]==y[n]))  
    {  
     go[n]=true;  
     locateRandom((n+1));  
     score+=add;  
    }  
    for(z = 399 ; z > 0 ; z--)  
    {  
     if (go[z])  
     {  
      x[z] = x[(z-1)]; y[z] = y[(z-1)];  
      if ((z>4)&&(x[0]==x[z])&&(y[0]==y[z]))  
      {  
       game=3;  
      }  
     }  
    }  
    if(left)  
    {  
     x[0]-=10;  
    }  
    if(right)  
    {  
     x[0]+=10;  
    }  
    if(up)  
    {  
     y[0]-=10;  
    }  
    if(down)  
    {  
     y[0]+=10;  
    }  
   }  
     
   if(y[0]>d.height)  
   {  
    y[0]=d.height;  
    game=3;  
   }  
   if(y[0]<1)  
   {  
    y[0]=1;  
    game=3;  
   }  
   if(x[0]>d.width)  
   {  
    x[0]=d.width;  
    game=3;  
   }  
   if(x[0]<1)  
   {  
    x[0]=1;  
    game=3;  
   }  
     
   if (game==3)  
   {  
    if (count <(1500/level))  
    {  
     count++;  
    }  
    else  
    {  
     count=0;  
     game=1;  
     repaint();  
     setTime.stop();  
    }  
   }  
     
   repaint();  
   try{  
    setTime.sleep(level);  
   }  
   catch(InterruptedException e)  
   {}  
  }  
 }  
   
 public void locateRandom(int turn)  
 {  
  rtemp=(int)(Math.random()*50);  
  x[turn]=((rtemp*10)+1);  
  rtemp=(int)(Math.random()*50);  
  y[turn]=((rtemp*10)+1);  
  n++;  
 } 

 public boolean keyDown(Event e, int key)  
 {  
  if ((key == Event.LEFT) &&(!right))  
  {  
   left = true;  
   up = false;  
   down = false;  
   if(!started)  
    started=true;  
  }  
  if ((key == Event.RIGHT) && (!left))  
  {  
   right = true;  
   up = false;  
   down = false;  
   if(!started)  
    started=true;  
  }  
  if ((key == Event.UP) && (!down))  
  {  
   up = true;  
   right = false;  
   left = false;  
   if(!started)  
    started=true;  
  }  
  if ((key == Event.DOWN) && (!up))  
  {  
   down = true;  
   right = false;  
   left = false;  
   if(!started)  
    started=true;  
  }  
  return true;  
 }  
   
 public boolean action(Event event, Object obj)  
 {  
  stemp = (String) obj;  
    
  if(stemp.equals("Beginner"))  
  {  
   add=2;  
   level=250;  
   setTime = new Thread(this);  
   setTime.start();  
   return true;  
  }  
    
  if(stemp.equals("Intermediate"))  
  {  
   add=5;  
   level=150;  
   setTime = new Thread(this);  
   setTime.start();  
   return true;  
  }  
    
  if(stemp.equals("Professional"))  
  {  
   add=10;  
   level=100;  
   setTime = new Thread(this);  
   setTime.start();  
   return true;  
  }  
    
  if(stemp.equals("Xtreamest"))  
  {  
   add=20;  
   level=50;  
   setTime = new Thread(this);  
   setTime.start();  
   return true;  
  }  
  return false;  
 }                 
} 