<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:php="http://php.net/xsl"
    xmlns:xlink="http://www.w3.org/2001/XMLSchema-instance">
    <xsl:output method="xml" indent="yes" encoding="utf-8"/>
    <xsl:template match="/records">
	<add>
	   <xsl:for-each select="//eresource">
            <doc>
                <!-- ID -->
                <!-- Important: This relies on an <identifier> tag being injected by the OAI-PMH harvester. -->
                <field name="id">
                    <xsl:value-of select="concat('e',record_id)"/>
                </field>

                <!-- RECORDTYPE -->
                <field name="recordtype">XML</field>
                      

                <!-- FULLRECORD -->
                <!-- disabled for now; records are so large that they cause memory problems!
                <field name="fullrecord">
                    <xsl:copy-of select="php:function('VuFind::xmlAsText', //oai_dc:dc)"/>
                </field>
                  -->

                <!-- ALLFIELDS -->
                <field name="allfields">
                    <xsl:value-of select="normalize-space(string(resource))"/>
                </field>

                <!-- INSTITUTION -->
                <field name="institution">
                    <xsl:value-of select="$institution" />
                </field>

				  <!-- COLLECTION -->
                <field name="collection">
		    		<xsl:value-of select="$collection" />
                </field>

                <!-- FORMAT -->
                <field name="format">Electronic Resource</field>

                <!-- AUTHOR -->
                <xsl:if test="author">
                    <xsl:for-each select="author">
                        <xsl:if test="normalize-space()">
                            <!-- author is not a multi-valued field, so we'll put
                                 first value there and subsequent values in author2.
                             -->
                            <xsl:if test="position()=1">
                                <field name="author">
                                    <xsl:value-of select="normalize-space()"/>
                                </field>
                                <field name="author-letter">
                                    <xsl:value-of select="normalize-space()"/>
                                </field>
                            </xsl:if>
                            <xsl:if test="position()>1">
                                <field name="author2">
                                    <xsl:value-of select="normalize-space()"/>
                                </field>
                            </xsl:if>
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>

                <!-- TITLE -->
                <xsl:if test="title[normalize-space()]">
                    <field name="title">
                        <xsl:value-of select="title[normalize-space()]"/>
                    </field>
                    <field name="title_short">
                        <xsl:value-of select="title[normalize-space()]"/>
                    </field>
                    <field name="title_full">
                        <xsl:value-of select="title[normalize-space()]"/>
                    </field>
                </xsl:if>
                
                <!-- alternate titles -->
                <xsl:if test="alternate_name[normalize-space()]">
                	<xsl:for-each select="alternate_name">
                		<field name="title_alt">
                			<xsl:value-of select="normalize-space()"/>
                		</field>
                	</xsl:for-each>
                </xsl:if>
                
                <!-- DESCRIPTION -->
                <xsl:if test="description">
                    <field name="description">
                        <xsl:value-of select="description" />
                    </field>
                </xsl:if>

                <!-- coverage -->
                <xsl:if test="coverage[normalize-space()]">
                    <field name="dateSpan">
                        <xsl:value-of select="coverage[normalize-space()]"/>
                    </field>
                </xsl:if>


                <!-- URL -->
                <xsl:for-each select="resource_url">
                	<field name="url">
                   		<xsl:value-of select="normalize-space()"/>
                 	</field>
                 </xsl:for-each>
                
                <!--  SUBJECTS -->
                <xsl:if test="subject[normalize-space()]">
                	<xsl:for-each select="subject">
                		<field name="topic">
                			<xsl:value-of select="normalize-space()"/>
                		</field>
                    	<field name="topic_facet">
                			<xsl:value-of select="normalize-space()"/>
                		</field>
                	</xsl:for-each>
                </xsl:if>
                
                <!--  public notes -->
                <xsl:if test="note[normalize-space()]">
                	<xsl:for-each select="note">
                		<field name="publicNote_str_mv">
                			<xsl:value-of select="normalize-space()"/>
                		</field>
                	</xsl:for-each>
                </xsl:if>
                
                <!-- Authorized users -->
                <xsl:if test="access_level[normalize-space()]">
                	<field name="authUsers_str">
                		<xsl:value-of select = "access_level[normalize-space()]"/>	
                	</field>
                </xsl:if>
            </doc>
	</xsl:for-each>
	</add>
    </xsl:template>
</xsl:stylesheet>
