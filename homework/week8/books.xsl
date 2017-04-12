<?xml version = "1.0"?>

<!-- test.xsl -->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match = "/">

  <html>

    <body>

      <h1>My catalog</h1>

      <table border="2">

        <tr><th>Title</th><th>Author</th><th>Publication details</th><th>ISBN</th></tr>

        <xsl:for-each select="catalog/book">

          <tr>

            <td><span style = "font_style:italic">

                <xsl:value-of select="title"/></span></td>

            <td><xsl:value-of select="author_forenames"/>

                <xsl:value-of select="author_surname"/></td>

            <td><xsl:value-of select="year"/>,

                <xsl:value-of select="publisher"/>,

                <xsl:value-of select="location/city"/>,

                <xsl:value-of select="location/country"/></td>

            <td><xsl:value-of select="isbn"/></td>

          </tr>

        </xsl:for-each>

      </table>

    </body>

  </html>

  </xsl:template>

</xsl:stylesheet>