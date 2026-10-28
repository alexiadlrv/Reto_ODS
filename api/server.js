const express = require('express');
const app = express();

// Para poder leer JSON en el body de las peticiones
app.use(express.json());

// Datos de ejemplo en memoria
const contenedores = [
  { id: 1, nombre: "CONT-001", tipo: "vidrio", ubicacion: "Calle Mayor, 12",
    capacidad: 120, llenado: 76, fechaInstalacion: "2026-10-20",
    color: "#2e7d32", estado: "operativo" },
  { id: 2, nombre: "CONT-002", tipo: "plastico", ubicacion: "Plaza Mayor",
    capacidad: 240, llenado: 40, fechaInstalacion: "2026-10-21",
    color: "#1565c0", estado: "operativo" }
];

// Contador para asignar ids a los nuevos
let siguienteId = 3;

app.get('/api/contenedores', (req, res) => {
  res.json(contenedores);
});

// Consultar un contenedor por su id
app.get('/api/contenedores/:id', (req, res) => {
  const id = Number(req.params.id);
  const contenedor = contenedores.find(c => c.id === id);
  if (!contenedor) {
    return res.status(404).json({ error: 'Contenedor no encontrado' });
  }
  res.json(contenedor);
});

// Crear un contenedor
app.post('/api/contenedores', (req, res) => {
  const datos = req.body;

  if (!datos.nombre || !datos.tipo || !datos.ubicacion || !datos.capacidad ||
      datos.llenado === undefined || !datos.fechaInstalacion ||
      !datos.color || !datos.estado) {
    return res.status(400).json({ error: 'Faltan datos obligatorios' });
  }

  const nuevo = {
    id: siguienteId,
    nombre: datos.nombre,
    tipo: datos.tipo,
    ubicacion: datos.ubicacion,
    capacidad: Number(datos.capacidad),
    llenado: Number(datos.llenado),
    fechaInstalacion: datos.fechaInstalacion,
    color: datos.color,
    estado: datos.estado
  };
  siguienteId++;
  contenedores.push(nuevo);
  res.status(201).json(nuevo);
});

app.listen(3000, () => {
  console.log('API en http://localhost:3000');
});