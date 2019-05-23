<?php

$templates = array("archive.twig");
$context = Timber::get_context();
$context["title"] = __("Публікації", "dutchak");
$context["posts"] = new Timber\PostQuery();
Timber::render($templates, $context);
