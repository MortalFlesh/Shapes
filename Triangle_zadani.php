<?php

interface Shape {
	function getPerimeter();
	function getArea();
	function draw();
}

class Drawer {
	public function drawShape(Shape $Shape) {
		$Shape->draw();
		echo ' | Area: ' . $Shape->getArea();
		echo ' | Perimeter: ' . $Shape->getPerimeter();
		echo '<br />';
		return $this;
	}
}

// ***************** odsud se může kód měnit *****************

class Triangle {
	
}

// ***************** odsud se už nemůže kód měnit *****************

$Drawer = new Drawer();
$Drawer
	->drawShape($Triangle)				// a = 3, b = 4, c = 5
	->drawShape($RedTriangle)			// a = 3, b = 4, c = 5 | red
	->drawShape($RoundedTriangle)		// a = 3, b = 4, c = 5, roundCoeficient = 0.5
	->drawShape($RedRoundedTriangle)	// a = 3, b = 4, c = 5, roundCoeficient = 0.5 | red
	->drawShape($BlueRedTriangle);		// a = 3, b = 4, c = 5 | blue | red

/*
 * output:
triangle(3, 4, 5) | Area: 6 | Perimeter: 12
red-triangle(3, 4, 5) | Area: 6 | Perimeter: 12
rounded-triangle(3, 4, 5, 0.5) | Area: 3 | Perimeter: 6
red-rounded-triangle(3, 4, 5, 0.5) | Area: 3 | Perimeter: 6
blue-red-triangle(3, 4, 5) | Area: 6 | Perimeter: 12
 */
