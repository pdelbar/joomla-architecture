<?php

  require_once "renderer.php";
  require_once "content.php";

  /**
   * Class ContentTypeNote
   *
   * its content should really be a DTO, right ?
   */
  class ContentTypeNote extends Content
  {
    protected $title;
    protected $body;
    protected $when;

    public function __construct($title, $when, $body)
    {
      $this->title = $title;
      $this->when  = $when;
      $this->body  = $body;
    }

    public function accept(Renderer $renderer)
    {
      $renderer->visitContentTypeNote($this);
    }

    public static function asHtml(ContentTypeNote $content)
    {
      $color = (strtotime($content->when) < strtotime('now')) ? 'red' : 'black';
      $s     = '<div style="border: 1px solid ' . $color . '; margin: 10px; padding: 0 10px;">';
      $s .= '<h2>' . $content->title . '</h2>';
      $s .= '<p>' . $content->body . "</p>";
      $s .= '</div>';

      return $s;

    }
  }
