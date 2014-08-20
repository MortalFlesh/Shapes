<?php

interface Shape {
	function getPerimeter();
	function getArea();
	function draw();
}

class ColoredShape implements Shape {
	/** @var Shape */
	private $Shape;

	private $color;

	/**
	 * @param Shape $Shape
	 * @param string $color
	 */
	public function __construct(Shape $Shape, $color) {
		$this->Shape = $Shape;
		$this->color = $color;
	}

	public function draw() {
		echo $this->color . '-';
		$this->Shape->draw();
	}

	public function getArea() {
		return $this->Shape->getArea();
	}

	public function getPerimeter() {
		return $this->Shape->getPerimeter();
	}

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

class RedTrianlge extends Triangle {
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
	private $roundCoeficient;

	public function __construct($roundCoeficient, $a, $b, $c) {
		$this->roundCoeficient = $roundCoeficient;
		parent::__construct($a, $b, $c);
	}

	public function getArea() {
		return parent::getArea() * $this->roundCoeficient;
	}

	public function getPerimeter() {
		return parent::getPerimeter() * $this->roundCoeficient;
	}

	public function draw() {
		echo 'rounded-triangle(' . $this->a . ', ' . $this->b . ', ' . $this->c . ', ' . $this->roundCoeficient . ')';
	}
}

//***

class Drawer {
	public function drawShape(Shape $Shape) {
		$Shape->draw();
		echo ' | Area: ' . $Shape->getArea();
		echo ' | Perimeter: ' . $Shape->getPerimeter();
		echo '<br />';
		return $this;
	}
}

$Triangle = new Triangle(3, 4, 5);
$RedTriangle = new RedTrianlge($Triangle);

$RoundedTriangle = new RoundedTriangle(0.5, 3, 4, 5);
$RedRoundedTriangle = new RedTrianlge($RoundedTriangle);

$BlueRedTriangle = new ColoredShape($RedTriangle, 'blue');

$Drawer = new Drawer();
$Drawer
	->drawShape($Triangle)
	->drawShape($RedTriangle)
	->drawShape($RoundedTriangle)
	->drawShape($RedRoundedTriangle)
	->drawShape($BlueRedTriangle);

/*
 * output:
triangle(3, 4, 5) | obsah: 77.768888380894 | obvod: 12
red-triangle(3, 4, 5) | obsah: 77.768888380894 | obvod: 12
rounded-triangle(3, 4, 5, 0.5) | obsah: 38.884444190447 | obvod: 6
red-rounded-triangle(3, 4, 5, 0.5) | obsah: 38.884444190447 | obvod: 6
blue-red-triangle(3, 4, 5) | obsah: 77.768888380894 | obvod: 12
 */
