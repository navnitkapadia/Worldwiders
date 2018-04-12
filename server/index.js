const angularUnivarsal = require('angular-universal-express-firebase');

exports.ssrapp = angularUnivarsal.trigger({
    index: __dirname + 'index.html',
    main: __dirname  + 'dist-server/main-bundle',
    enableProdMode: true,
    cdnCacheExpiry: 1200,
    browserCacheExpiry: 600
})