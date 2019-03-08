# Buto-Plugin-BootstrapBootswatch_v431

Add theme from Bootswatch to your Buto project.

## Theme settings

Set param data/theme to one of www.bootswatch.com themes for version 4.3.1.

```
type: widget
data:
  plugin: bootstrap/bootswatch_v431
  method: include
  data:
    theme: Lux
```


```
- Cerulean
- Cosmo
- Cyborg
- Darkly
- Flatly
- Journal
- Litera
- Lumen
- Lux
- Materia
- Minty
- Pulse
- Sandstone
- Simplex
- Sketchy
- Slate
- Solar
- Spacelab
- Superhero
- United
- Yeti
```

## Select theme by user

Add an selectbox to let user change theme. Good for test purpose.

```
type: widget
data:
  plugin: bootstrap/bootswatch_v431
  method: selectbox
```


