import { simplexNoise } from "simplex-noise";

class WispNoiseEffect {
  constructor(id, octaves = 2, frequency = 50, amplitude = 100) {
    this.noise = simplexNoise(octaves);
    this.frequency = frequency;
    this.amplitude = amplitude;

    const canvas = document.getElementById(id);
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    this.ctx = canvas.getContext('2d');
  }

  generateNoise(x) {
    return this.noise(x, 10000);
  }

  render() {
    const ctx = this.ctx;
    const width = this.ctx.canvas.width;
    const height = this.ctx.canvas.height;
    ctx.fillStyle = 'black';
    ctx.fillRect(0, 0, width, height);

    const matter = new WispMatter();
    matter.requestAnimationFrame(matter.tick);

    const display = new WispDisplay({
      matter: matter,
      frequency: this.frequency,
      amplitude: this.amplitude,
      width: width,
      height: height,
      ctx: ctx
    });
    display.render();
    display.requestAnimationFrame(display.tick);
  }
}

class WispMatter {
  constructor() {
    this.system = [];
  }

  tick() {
    requestAnimationFrame(this.tick.bind(this));

    for (let system of this.system) {
      system.calculateBoundaries();
      system.matter.forEach(matter => matter.update());
    }
    this.distance = new Array(this.system[0].matter[0].x + this.system[0].matter[0].radius).fill(-Infinity);
    this.system[0].matter.forEach(matter => this.setDistance(matter.material.n, matter.distance, this.system[0].matter[0].x));

    this.system.forEach(system => {
      for (const j of system.matter) {
        for (const distanceN of this.distance) {
          if ((distanceN >= -system.systems[system.index].maxDist && distanceN !== Infinity) || distanceN < -system.systems[system.index].minDist) {
            if (system.systems[system.index].constraints[system.material_BIT.getImageData(j.y, j.distance, this.systems)] === ImageDataObject.createCanvasIOC || j.y === 0) {
              if (distanceN > 0) {
                system.particles.forEach((particle, i) => {
                  particle.math.push(j.velocity * j.mass);
                  particle.mass = j.mass > particle.mass ? j.mass : particle.mass;
                });
              }
            } else {
              determineDeformDistance(system, this.distance[distanceN], this.frequency);
            }
          }
        }
        this.distance[distanceN] = Infinity;
      }
    });
    this.distance = null;

    this.system.forEach(system => system.reverse());

    this.system.forEach(system => {
      for (const matter of system.matter) {
        const magneticForce = 1 / (matter.GetForce() + 1);
        const distance = magneticForce * matter.distance;
        const newDist = matter.maxDist + distance;
        matter.setBoundaries(newDist * 1.2, newDist * 0.8);
      }
    });
  }
}