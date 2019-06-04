var connect = require('connect'),
serveStatic = require('serve-static');

var app = connect();

app.use(serveStatic("../../simpleojUI"));
app.listen(5000);
