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

  $blog = new ContentGroupBlog( array( new ContentTypeNote('First note', '2015-06-15', 'This here is my first note.') ) );
  $blog->addChild( new ContentTypeNote('Second note', '2015-10-16', 'Another note!') );
  $blog->addChild( new ContentTypeNote('third note', '2015-04-16', 'An old note ...') );

//  $renderer->registerContentType('ContentGroupBlog', array('ContentGroupBlog', 'asHtml'));

  $blog->accept($renderer);

  echo $renderer->getOutput();

