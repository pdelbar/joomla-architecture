<?php
trait DynamicRendererImplementation {
	private $handlers = array();

	public function registerContentType($type, Callable $handler) {
		$this->handlers[strtolower($type)] = $handler;
	}

	public function __call($method, $arguments) {
		if (preg_match('~^visit(.+)~', $method, $match)) {
			$type = strtolower($match[1]);
			if (!isset($this->handlers[$type])) {
				$type = 'default';
			}
			if (isset($this->handlers[$type])) {
				$handler = $this->handlers[$type];
				$this->output .= $handler($arguments[0]);
			} else {
				echo "\nLogWarn: Unknown content type {$match[1]}, no default\n";
			}
		}
	}
}

class Renderer {
	protected $output = '';

	use DynamicRendererImplementation;

	public function visitContent(ContentType $content) {
		$this->output .= __METHOD__ . ': ' . $content->getContents() . "\n";
	}

	public function getOutput() {
		return $this->output;
	}
}

abstract class Content {
	protected $content = 'undefined';
	public function __construct($content) {
		$this->content = $content;
	}
	abstract public function accept(Renderer $renderer);
	public function getContents() {
		return $this->content;
	}
}

class ContentType extends Content {
	public function accept(Renderer $renderer) {
		$renderer->visitContent($this);
	}
}

class NewContentType extends Content {
	public function accept(Renderer $renderer) {
		$renderer->visitNewContent($this);
	}
	public function asHtml(NewContentType $content) {
		return __METHOD__ . ': ' . $content->getContents() . "\n";
	}
}

class OtherContentType extends Content {
	public function accept(Renderer $renderer) {
		$renderer->visitOtherContent($this);
	}
}

class UnregisteredContentType extends Content {
	public function accept(Renderer $renderer) {
		$renderer->visitUnregisteredContent($this);
	}
}

$renderer = new Renderer;

$renderer->registerContentType('NewContent', array('NewContentType', 'asHtml'));
$renderer->registerContentType('OtherContent', function(OtherContentType $content) {
	return __METHOD__ . '(1): ' . $content->getContents() . "\n";
});
$renderer->registerContentType('Default', function (Content $content) {
	return __METHOD__ . '(default): ' . $content->getContents() . "\n";
});

/** @var Content[] $content */
$content = array(
	new ContentType('I am Content'),
	new NewContentType('I am NewContent'),
	new OtherContentType('I am OtherContent'),
	new UnregisteredContentType('I am UnregisteredContent'),
);

foreach ($content as $c) {
	$c->accept($renderer);
}

echo "<pre>\nOutput:\n" . $renderer->getOutput() . '</pre>';
