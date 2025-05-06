function circle(radius) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = radius * 2;
    canvas.height = radius * 2;
    ctx.fillStyle = 'black';
    ctx.beginPath();
    ctx.arc(radius, radius, radius, 0, Math.PI * 2);
    ctx.fill();
    return canvas;
}

function drawCircle(radius) {
    const canvas = circle(radius);
    return canvas;
}

class SystemManager {
    constructor() {
        this.system = [];
        this.distance = {};
    }

    setDistance(n, distance, x) {
        if (this.distance[n] < distance) {
            this.distance[n] = distance;
        }
    }

    requestAnimationFrame(callback) {
        requestAnimationFrame(callback.bind(this));
    }

    calculateBoundaries() {
        this.system.forEach(system => system.calculateBoundaries());
    }

    addSystem(system) {
        this.system.push(system);
    }

    removeSystem(system) {
        const index = this.system.indexOf(system);
        if (index !== -1) {
            this.system.splice(index, 1);
        }
    }

    getSystems() {
        return this.system;
    }

    getSystem(index) {
        return this.system[index];
    }

    getDistance() {
        return this.distance;
    }

    getMatter(systemIndex = 0) {
        return this.system[systemIndex].matter;
    }

    getMatterByIndex(index, systemIndex = 0) {
        return this.system[systemIndex].matter[index];
    }

    getMatterById(id) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.id === id) {
                    return matter;
                }
            }
        }
        return null;
    }

    getMatterByName(name) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.name === name) {
                    return matter;
                }
            }
        }
        return null;
    }

    getMatterByType(type) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.type === type) {
                    return matter;
                }
            }
        }
        return null;
    }

    getMatterByPosition(position) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.position === position) {
                    return matter;
                }
            }
        }
        return null;
    }

    getMatterByVelocity(velocity) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.velocity === velocity) {
                    return matter;
                }
            }
        }
        return null;
    }

    getMatterByAcceleration(acceleration) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.acceleration === acceleration) {
                    return matter;
                }
            }
        }
        return null;
    }

    getMatterByMass(mass) {
        for (const system of this.system) {
            for (const matter of system.matter) {
                if (matter.mass === mass) {
                    return matter;
                }
            }
        }
        return null;
    }
}