const express = require('express');
require('dotenv').config();
const app = express();

const PORT = process.env.PORT || 3000;

// Para poder leer JSON en el body de las peticiones
app.use(express.json());

// Importamos los datos desde datos.js
const datos = require("./datos");
let contenedores = datos.contenedores;
let idActual = datos.siguienteId;

// Ruta de bienvenida
app.get('/', (req, res) => {
  res.json({ mensaje: 'API REST ODS Funcionando' });
});

// Obtener todos los contenedores (con soporte de filtros básicos por URL si quieres)
app.get('/api/contenedores', (req, res) => {
    let resultados = contenedores;

    if(req.query.id){
        resultados = resultados.filter(c => c.id == req.query.id);
    }

    if(req.query.ubicacion){
        resultados = resultados.filter(c => c.ubicacion.toLowerCase().includes(req.query.ubicacion.toLowerCase()));
    }

    if (req.query.tipo) {
        resultados = resultados.filter(c => c.tipo.toLowerCase() === req.query.tipo.toLowerCase());
    }

    if (req.query.estado) {
        resultados = resultados.filter(c => c.estado.toLowerCase() === req.query.estado.toLowerCase());
    }

    res.json(resultados);
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
  const cuerpo = req.body;

  if (!cuerpo.nombre || !cuerpo.tipo || !cuerpo.ubicacion || !cuerpo.fechaInstalacion ||
      !cuerpo.color || !cuerpo.estado || cuerpo.llenado === undefined) {
    return res.status(400).json({ error: 'Faltan datos obligatorios' });
  }

  const nuevo = {
    id: idActual,
    nombre: cuerpo.nombre,
    tipo: cuerpo.tipo,
    ubicacion: cuerpo.ubicacion,
    fechaInstalacion: cuerpo.fechaInstalacion,
    color: cuerpo.color,
    estado: cuerpo.estado,
    llenado: cuerpo.llenado
  };

  idActual++;
  contenedores.push(nuevo);
  res.status(201).json(nuevo);
});

// Editar un contenedor existente
app.put('/api/contenedores/:id', (req, res) => {
  const id = Number(req.params.id);
  const contenedor = contenedores.find(c => c.id === id);

  if (!contenedor) {
    return res.status(404).json({ error: 'Contenedor no encontrado' });
  }

  const datosReq = req.body;
  if (datosReq.nombre !== undefined) contenedor.nombre = datosReq.nombre;
  if (datosReq.tipo !== undefined) contenedor.tipo = datosReq.tipo;
  if (datosReq.ubicacion !== undefined) contenedor.ubicacion = datosReq.ubicacion;
  if (datosReq.fechaInstalacion !== undefined) contenedor.fechaInstalacion = datosReq.fechaInstalacion;
  if (datosReq.color !== undefined) contenedor.color = datosReq.color;
  if (datosReq.estado !== undefined) contenedor.estado = datosReq.estado;
  if (datosReq.llenado !== undefined) contenedor.llenado = datosReq.llenado;

  res.json(contenedor);
});

app.listen(PORT, () => {
  console.log(`Servidor corriendo en el puerto ${PORT}`);
});