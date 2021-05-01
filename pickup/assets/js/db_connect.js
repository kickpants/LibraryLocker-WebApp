const {
    createPool
} = require('mysql');

const pool = createPool({
    host: "fau-lpl.cluster-cly8gnirvokz.us-east-1.rds.amazonaws.com",
    user: "admin",
    password: "Group8pass",
    database: "lockers"
})

pool.query(`select lockerNum from lockers_info`, (err, result, fields) => {
    if(err) {
        return console.log(err);
    }
    return console.log(result);
})