<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">
<html>
<head>
<title>My Cookbook</title>
<style type="text/css">
	body {
		background-color: AliceBlue;
		font-family: Klee; 
		text-align: center;
		overflow: auto;
		margin-top: 5%;
		margin-bottom: 5%;
	}
	h1 { 
		font-style: italic; 
		color: plum;
	} 
	td.prep { 
		font-style: italic; 
		bgcolor: orange; 
		colspan: 2;
		text-align: left;
	}
	td.cooking {
		text-align: left;
	}
	td {
		text-align: center;
	}
</style>
</head>
<body>
<h1>My Recipe Collection</h1>
<table border="1" style="margin:auto; width: 45%">
<xsl:for-each select="cookbook/recipe">
<tr bgcolor="#9acd32">
<th bgcolor="MistyRose" colspan="2">
<xsl:value-of select="name"/>
</th>
</tr>
<xsl:for-each select="ingredient">
<tr>
<td>
<xsl:value-of select="name"/>
</td>
<td>
<xsl:value-of select="amount"/>
<xsl:value-of select="unit"/>
</td>
</tr>
</xsl:for-each>
<tr>
<td class="prep" colspan="2">
<xsl:value-of select="preparation"/>
</td>
</tr>
<tr>
<td class="cooking" bgcolor="lightyellow" colspan="2">
<xsl:value-of select="cooking"/>
</td>
</tr>
<tr>
<td>Total time</td>
<td>
<xsl:value-of select="cooktime"/>
</td>
</tr>
</xsl:for-each>
</table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>