const express = require('express');
require('dotenv').config();
const app = express();
const PORT = process.env.PORT || 3000;
app.use(express.json());
app.get('/',(req,res) => res.json({mensaje: 'API REST ODS Funcionando' }));
app.listen(PORT, () => {
    console.log(`Servidor corriendo en el puerto ${PORT}`);
});