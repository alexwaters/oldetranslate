<?
// docs/index.php

define('SYSTEM_LEVEL','../');
require_once( SYSTEM_LEVEL . 'ote.class.php');
$ote->show_header('Documentation');
?>

<p>The Open Translation Engine (OTE) is a web-based translation dictionary manager.</p>

<p>This is prototype release <?=VERSION?>, on the roadmap to a stable 1.0 release.</p>

<p>Documentation:
<br />- <a href="install.txt">Install Instructions</a>
<br />- <a href="changelog.txt">Change Log</a>
<br />- <a href="roadmap.txt">Development Roadmap</a>
<br />- <a href="developer.documentation.txt">Developer Documentation</a>
<br />- <a href="filesystem.txt">File System</a>
<br />- <a href="license.txt">Open Source License</a>
</p>

<p>OTE Development Sites:
<br />- <a href="http://sourceforge.net/projects/ote/">OTE SourceForge Project Home</a>
<br />- <a href="http://ote.wiki.sourceforge.net/">OTE SourceForge Wiki</a>
</p>

<p>OTE installations:
<br />- <a href="http://ibiblio.org/dbarberi/ote/">demo install: OTE at ibiblio</a>
<br />- <a href="http://ote.trilexnet.com/">demo install: OTE at trilex labs</a>
<br />- <a href="http://ote.2meta.com/">live site: 2meta English &lt;&gt; Dutch</a>
<br />- <a href="http://indo-european.info/dictionary-translator/">live site: Dnghu Indo-European &lt;&gt; English</a>
</p>

<p>Sample dictionaries:
<br />- <a href="http://sourceforge.net/projects/dams/">Dictionary Additions Management System (DAMS)</a>
<br />- <a href="../samples/">local samples</a>
</p>

<? $ote->show_footer(); 
