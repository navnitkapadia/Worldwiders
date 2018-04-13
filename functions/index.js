const angularUnivarsal = require('angular-universal-express-firebase');
const express = require('express');
const path = require('path');
const http = require('http');
const bodyParser = require('body-parser');

// Get our API routes
const api = require('./routes/api');

const app = express();

// Parsers for POST data
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// Set our api routes
app.use('/api', api);

exports.ssrapp = angularUnivarsal.trigger({
    index: __dirname + 'index.html',
    main: __dirname  + 'dist-server/main-bundle',
    enableProdMode: true,
    cdnCacheExpiry: 1200,
    browserCacheExpiry: 600
})