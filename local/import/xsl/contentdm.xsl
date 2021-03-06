<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:php="http://php.net/xsl"
    xmlns:xlink="http://www.w3.org/2001/XMLSchema-instance">
    <xsl:output method="xml" indent="yes" encoding="utf-8"/>
    <xsl:param name="institution">Image and Multimedia Collections</xsl:param>
    <xsl:param name="collection">contentDM</xsl:param>
    <xsl:template match="/collection">
	<add>
	   <xsl:for-each select="//oai_dc:dc">
            <doc>
                <!-- ID -->
                <!-- Important: This relies on an <identifier> tag being injected by the OAI-PMH harvester. -->
                <field name="id">
                    <xsl:value-of select="identifier"/>
                </field>

                <!-- RECORDTYPE -->
                <field name="recordtype">contentDM</field>

                <!-- FULLRECORD -->
                <!-- disabled for now; records are so large that they cause memory problems!
                <field name="fullrecord">
                    <xsl:copy-of select="php:function('VuFind::xmlAsText', //oai_dc:dc)"/>
                </field>
                  -->

                <!-- ALLFIELDS -->
                <field name="allfields">
                    <xsl:value-of select="normalize-space(string(oai_dc:dc))"/>
                </field>

                <!-- INSTITUTION -->
                <field name="institution">
                    <xsl:value-of select="$institution" />
                </field>

                <!-- COLLECTION -->
                <field name="collection">
		    <xsl:value-of select="collection" />
                </field>

                <!-- LANGUAGE -->
                <xsl:if test="dc:language">
                    <xsl:for-each select="dc:language">
                        <xsl:if test="string-length() > 0">
                            <field name="language">
                                <xsl:value-of select="normalize-space()" />
                            </field>
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>

                <!-- FORMAT -->
                <field name="format">Online Multimedia</field>

                <!-- AUTHOR -->
                <xsl:if test="dc:creator">
                    <xsl:for-each select="dc:creator">
                        <xsl:if test="normalize-space()">
                        	<field name="author">
                                <xsl:value-of select="normalize-space()"/>
                            </field>                   
                            <xsl:if test="position()=1">
                                <field name="author_sort">
                                    <xsl:value-of select="normalize-space()"/>
                                </field>                                
                            </xsl:if>                            
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>

                <!-- TITLE -->
                <xsl:if test="dc:title[normalize-space()]">
                    <field name="title">
                        <xsl:value-of select="dc:title[normalize-space()]"/>
                    </field>
                    <field name="title_short">
                        <xsl:value-of select="dc:title[normalize-space()]"/>
                    </field>
                    <field name="title_full">
                        <xsl:value-of select="dc:title[normalize-space()]"/>
                    </field>
                    <field name="title_sort">
                        <xsl:value-of select="php:function('VuFind::stripArticles', string(//dc:title[normalize-space()]))"/>
                    </field>
  
                </xsl:if>
                
                <!-- DESCRIPTION -->
                <xsl:if test="dc:description">
                    <field name="description">
                        <xsl:value-of select="dc:description" />
                    </field>
                </xsl:if>

                <!-- PUBLISHER -->
                <xsl:if test="dc:publisher[normalize-space()]">
                    <field name="publisher">
                        <xsl:value-of select="dc:publisher[normalize-space()]"/>
                    </field>
                </xsl:if>

                <!-- PUBLISHDATE -->
                <xsl:if test="dc:date">
                    <field name="publishDate">
                        <xsl:value-of select="substring(dc:date, 1, 4)"/>
                    </field>
                    <field name="publishDateSort">
                        <xsl:value-of select="substring(dc:date, 1, 4)"/>
                    </field>
                </xsl:if>

                <!-- URL -->
                <xsl:choose>
                   <xsl:when test="contains(dc:identifier,'http://')">
                    <field name="url">
                        <xsl:value-of select="dc:identifier[normalize-space()]"/>
                    </field>
                </xsl:when>
                <xsl:otherwise>
           <!--      	<field name="identifier">
                		<xsl:value-of select="dc:identifier[normalize-space()]"/>
                		</field> -->
                </xsl:otherwise>
                </xsl:choose>
                <field name="thumbnail">
                	<xsl:value-of select="concat('http://contentdm.unl.edu/cgi-bin/thumbnail.exe?CISOROOT=/',set,'&amp;CISOPTR=',substring-after(identifier,'_'))"/>
                </field>
            </doc>
	</xsl:for-each>
	</add>
    </xsl:template>
</xsl:stylesheet>
