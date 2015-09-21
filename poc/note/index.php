<?php

  error_reporting(E_ALL);
  ini_set('display_errors',1);

  require_once "renderer.php";
  require_once "content.php";
  require_once "contentgroup.php";
  require_once "note.php";

  // the renderer would be instantiated by the Application
  $renderer = new Renderer;

  // the type registration could be lazy (on loading a component) or other
  $renderer->registerContentType('ContentTypeNote', array('ContentTypeNote', 'asHtml'));

  // we should really use a ModelNote to create the actual domain model Note instances, and then
  // wrap them in DTO wrappers, so the following would be a list-style ContentGroup containing
  // items for each Note
  $content = array(
    new ContentTypeNote('First note', '2015-06-15', 'This here is my first note.'),
    new ContentTypeNote('Second note', '2015-10-16', 'Another note!'),
  );

  // here, we are doing the work of the View I believe
  foreach ($content as $c) {
    $c->accept($renderer);
  }

  echo $renderer->getOutput();

