// Datos de ejemplo en memoria
const contenedores = [
  { id: 1, nombre: "CONT-001", tipo: "vidrio", ubicacion: "Calle Mayor, 12", fechaInstalacion: "2026-09-20",
    color: "#2e7d32", estado: "operativo" , llenado: 70},
  { id: 2, nombre: "CONT-002", tipo: "plastico", ubicacion: "Plaza Mayor", fechaInstalacion: "2026-10-21",
    color: "#1565c0", estado: "operativo" , llenado: 30},
  { id: 3, nombre: "CONT-003", tipo: "organico", ubicacion: "Padre Esteban Pernet", fechaInstalacion: "2026-08-11",
    color: "#f8e40c", estado: "operativo" , llenado: 20},
  { id: 4, nombre: "CONT-004", tipo: "papel", ubicacion: "Santutxu", fechaInstalacion: "2026-07-18",
    color: "#cf6e24", estado: "operativo" , llenado: 50}
];

// Contador para asignar ids a los nuevos
let siguienteId = 5;

module.exports = {contenedores, siguienteId};