const express = require('express');
const router = express.Router();
const admin = require("../db-config/db-config");
var db = admin.firestore();

/* GET api listing. */
router.get('/get-conversations', (req, res) => {
  });


module.exports = router;