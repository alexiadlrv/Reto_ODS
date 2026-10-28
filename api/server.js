const express = require('express');
const app = express();

// Datos de ejemplo en memoria
const contenedores = [
  { id: 1, nombre: "CONT-001", tipo: "vidrio", ubicacion: "Calle Mayor, 12",
    capacidad: 120, llenado: 76, fechaInstalacion: "2026-10-20",
    color: "#2e7d32", estado: "operativo" },
  { id: 2, nombre: "CONT-002", tipo: "plastico", ubicacion: "Plaza Mayor",
    capacidad: 240, llenado: 40, fechaInstalacion: "2026-10-21",
    color: "#1565c0", estado: "operativo" }
];

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

app.listen(3000, () => {
  console.log('API en http://localhost:3000');
});