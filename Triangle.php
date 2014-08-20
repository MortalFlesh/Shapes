<?php

interface Shape {
	function getPerimeter();
	function getArea();
	function draw();
}

class Triangle implements Shape {
	protected $a, $b, $c;

	public function __construct($a, $b, $c) {
		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}

	public function getArea() {
		$s = $this->a + $this->b + $this->c;
		return sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c));
	}

	public function getPerimeter() {
		return $this->a + $this->b + $this->c;
	}

	public function draw() {
		echo 'triangle(' . $this->a . ', ' . $this->b . ', ' . $this->c . ')';
	}
}

class RedTrianlge implements Shape {
	/** @var Triangle */
	private $Triangle;

	public function __construct(Triangle $Triangle) {
		$this->Triangle = $Triangle;
	}

	public function draw() {
		echo 'red-';
		$this->Triangle->draw();
	}

	public function getArea() {
		return $this->Triangle->getArea();
	}

	public function getPerimeter() {
		return $this->Triangle->getPerimeter();
	}
}

class RoundedTriangle extends Triangle {
	private $round;

	public function __construct($round, $a, $b, $c) {
		$this->round = $round;
		parent::__construct($a, $b, $c);
	}

	public function getArea() {
		return parent::getArea() * $this->round;
	}

	public function getPerimeter() {
		return parent::getPerimeter() * $this->round;
	}

	public function draw() {
		echo 'rounded-triangle(' . $this->a . ', ' . $this->b . ', ' . $this->c . ')';
	}
}

//***

class Drawer {
	public function drawShape(Shape $Shape) {
		$Shape->draw();
		echo ' | obsah: ' . $Shape->getArea();
		echo ' | obvod: ' . $Shape->getPerimeter();
		echo '<br />';
		return $this;
	}
}

$Triangle = new Triangle(3, 4, 5);
$RedTriangle = new RedTrianlge($Triangle);

$RoundedTriangle = new RoundedTriangle(5, 3, 4, 5);
$RedRoundedTriangle = new RedTrianlge($RoundedTriangle);

$Drawer = new Drawer();
$Drawer
	->drawShape($Triangle)
	->drawShape($RedTriangle)
	->drawShape($RoundedTriangle)
	->drawShape($RedRoundedTriangle);
