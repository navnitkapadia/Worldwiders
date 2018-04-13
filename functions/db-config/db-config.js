const express = require('express');
var admin = require("firebase-admin");

var serviceAccount = require("../db-config/worldwiders");

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: "https://worldwiders-d157f.firebaseio.com"
});

module.exports = admin;