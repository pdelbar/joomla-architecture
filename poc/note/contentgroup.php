<?php

  class ContentGroup extends Content
  {
    public function __construct($content) {
      parent::__construct($content);
    }

    public function getChildren()
    {
      return $this->content;
    }

    public function addChild(Content $content)
    {
      $this->content[] = $content;
    }

    public function accept(Renderer $renderer)
    {
      foreach ($this->content as $child) {
        $child->accept($renderer);
      }
    }
  }

  class ContentGroupBlog extends ContentGroup
  {
    public function __construct($content) {
      parent::__construct($content);
    }

  }
