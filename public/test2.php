<?php

$locale = "deu_DEU";

putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);

bindtextdomain("messages", "./locale");
textdomain("messages");

echo _("Hello World!");

?>