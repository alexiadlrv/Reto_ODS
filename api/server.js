const express = require('express');
const app = express();

app.get('/api/contenedores', (req, res) => {
  res.send('API de contenedores funcionando');
});

app.listen(3000, () => {
  console.log('API en http://localhost:3000');
});