let mysql = require('mysql');
let db = mysql.createConnection({
    host: '127.0.0.1'
  , database: 'projet_progwebserv_lambert_giron'
  , username: 'root'
  , password: ''});

let initial_result;

db.connect(function(err){
    if (err) console.log(err)
})

db.query('SELECT * FROM `question`', function(err, result){
    if (err) throw err;
    initial_result = result;
});

console.log(initial_result);