<?php
  echo 'loading Content ...<br/>';

  require_once "renderer.php";

  abstract class Content
  {
    protected $content = 'undefined';

    public function __construct( $content )
    {
      $this->content = $content;
    }

    abstract public function accept(Renderer $renderer);

    public function getContents()
    {
      return $this->content;
    }
  }

  class ContentType extends Content
  {
    public function accept(Renderer $renderer)
    {
      $renderer->visitContent($this);
    }
  }
