# Mars Rover API

## Descripción

La NASA va a aterrizar un escuadrón de robots exploradores en una meseta de Marte. Esta meseta, de forma rectangular, debe ser recorrida por los robots para que sus cámaras obtengan una vista completa del terreno y la envíen a la Tierra.

Tu tarea es desarrollar una API que permita movilizar a los robots sobre la meseta.

## Características

La API simula una cuadrícula de 10x10 donde los robots se desplazan y orientan en una dirección específica (N, S, E, W). La API debe manejar comandos de movimiento y notificar si el robot encuentra algún obstáculo.

## Reglas de Movimiento

- **Posición inicial**: La posición del robot en la cuadrícula se representa como una pareja de coordenadas (X, Y) junto con una dirección de orientación (N, S, E, W).
- **Comandos**:
    - `L` y `R`: Rotan la orientación del robot.
    - `M`: Mueve el robot una casilla hacia adelante en su dirección actual.
- **Límites de la cuadrícula**: Si el robot alcanza el borde de la cuadrícula, reaparece en el lado opuesto (por ejemplo, si está en el borde derecho y avanza, aparecerá en el borde izquierdo).

## Input y Output

### Input

El programa recibe una cadena de comandos de un solo carácter:

- **L**: Gira el robot 90° a la izquierda.
- **R**: Gira el robot 90° a la derecha.
- **M**: Avanza una casilla en la dirección actual del robot.

### Output

La salida es la posición final del robot, representada como una cadena con el formato `X:Y:D`, donde `X` e `Y` son las coordenadas y `D` la dirección (N, S, E, W).

### Ejemplo de Resultados

- **Input**: `MMRMMLM` → **Output**: `2:3:N`
- **Input**: `MMMMMMMMMM` → **Output**: `0:0:N` (debido a la vuelta en el borde)
- **Con Obstáculo en (0, 3)**:
    - **Input**: `MMMM` → **Output**: `O:0:2:N` (el robot se detiene antes del obstáculo)

## Obstáculos

La cuadrícula puede contener obstáculos. Si un comando de movimiento encuentra un obstáculo, el robot se detiene en la última posición posible y devuelve el mensaje anteponiendo `O:` al resultado. Por ejemplo, `O:1:1:N` indica un obstáculo encontrado en la posición `(1, 2)`.

## Interfaz Pública

```java
class MarsRover {
    public MarsRover(Grid grid);
    public String execute(String command);
}