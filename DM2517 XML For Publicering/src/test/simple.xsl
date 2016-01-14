<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="xml" version="1.0" encoding="UTF-8" indent="yes"/>
<xsl:template match="/">
<xmp><xsl:copy-of select="*"/><xsl:text>&#xa;</xsl:text></xmp>
</xsl:template>
</xsl:stylesheet>