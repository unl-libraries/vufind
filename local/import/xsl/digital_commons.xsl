<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:php="http://php.net/xsl"
    xmlns:xlink="http://www.w3.org/2001/XMLSchema-instance">
    <xsl:output method="xml" indent="yes" encoding="utf-8"/>
	<xsl:param name="track_changes">1</xsl:param>
	<xsl:param name="solr_core">biblio</xsl:param>
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
                <field name="recordtype">
                	<xsl:value-of select="dc:format"/>
                </field>

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
                <xsl:for-each select="collection">
                	<field name="collection">
		    			<xsl:value-of select="normalize-space()" />
                	</field>
                </xsl:for-each>

                <!-- LANGUAGE -->
                <xsl:if test="dc:language">
                    <xsl:for-each select="dc:language"> 
                    	<xsl:choose>           
                        	<xsl:when test="normalize-space() = 'EN'">
                        		   <field name="language">
                                		<xsl:value-of select="'English'" />
                            		</field>
                            	</xsl:when>
                            	<xsl:when test="normalize-space() = 'SP'">
                        		   <field name="language">
                                		<xsl:value-of select="'Spanish'" />
                            		</field>
                            	</xsl:when>               		                	
                            	<xsl:when test="normalize-space() = 'GE'">
                        		   <field name="language">
                                		<xsl:value-of select="'German'" />
                            		</field>
                            	</xsl:when>
                            	<xsl:when test="normalize-space() = 'FR'">
                        		   <field name="language">
                                		<xsl:value-of select="'French'" />
                            		</field>
                            	</xsl:when>
                            	<xsl:when test="normalize-space() = 'LA'">
                        		   <field name="language">
                                		<xsl:value-of select="'Latin'" />
                            		</field>
                            	</xsl:when>
                            		<xsl:when test="normalize-space() = 'ES'">
                        		   <field name="language">
                                		<xsl:value-of select="'Spanish'" />
                            		</field>
                            	</xsl:when>
                            		<xsl:when test="normalize-space() = 'GR'">
                        		   <field name="language">
                                		<xsl:value-of select="'Greek'" />
                            		</field>
                            	</xsl:when>
                            		<xsl:when test="normalize-space() = 'JE'">
                        		   <field name="language">
                                		<xsl:value-of select="'Japanese'" />
                            		</field>
                            	</xsl:when>
                            		<xsl:when test="normalize-space() = 'SE'">
                        		   <field name="language">
                                		<xsl:value-of select="'Spanish'" />
                            		</field>
                            	</xsl:when>
                            	<xsl:otherwise>
                            		<field name="language">
                                		<xsl:value-of select="normalize-space()" />
                            		</field>
                            	</xsl:otherwise>
                            </xsl:choose>
                    </xsl:for-each>
                </xsl:if>

                <!-- FORMAT -->
                <field name="format"><xsl:value-of select="substring-after(dc:format,'application/')"/></field>

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
                        <xsl:value-of select="dc:title[normalize-space()]" />
                    </field>
                    <field name="title_short">
                        <xsl:value-of select="dc:title[normalize-space()]" />
                    </field>
                    <field name="title_full">
                        <xsl:value-of select="dc:title[normalize-space()]" />
                    </field>
     				<field name="title_sort">
                        <xsl:value-of select="php:function('VuFind::stripArticles', string(dc:title[normalize-space()]))"/>
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
                        <xsl:value-of select="dc:date"/>
                    </field>
                    <field name="publishDateSort">
                        <xsl:value-of select="substring(dc:date, 1, 4)"/>
                    </field>
                </xsl:if>
                
                <!-- Subjects -->
				<xsl:if test="dc:subject">
                    <xsl:for-each select="dc:subject">
                    	<field name="topic">
                    		<xsl:value-of select="normalize-space()"/>
                    	</field>
                    </xsl:for-each>
                 </xsl:if>
                 
                 <!-- SERIES -->
                <xsl:if test="dc:source">
                    <field name="series">
                        <xsl:value-of select="dc:source[normalize-space()]"/>
                    </field>
                </xsl:if>
                 
                <!-- URL -->
                <xsl:for-each select="dc:identifier">
                	<xsl:if test="contains(normalize-space(),'viewcontent.cgi')">
                   		<!--  gets only the identifier that goes through the content viewer -->
                    	<field name="url">
                        	<xsl:value-of select="normalize-space()"/>
                    	</field>
                	</xsl:if>
                </xsl:for-each>
                
                <xsl:if test="$track_changes != 0">
				    <field name="first_indexed">
				        <xsl:value-of select="php:function('VuFind::getFirstIndexed', $solr_core, string(identifier), string(datestamp))"/>
				    </field>
				    <field name="last_indexed">
				        <xsl:value-of select="php:function('VuFind::getLastIndexed', $solr_core, string(identifier), string(datestamp))"/>
				    </field>
				</xsl:if>
            </doc>
	</xsl:for-each>
	</add>
    </xsl:template>
</xsl:stylesheet>
