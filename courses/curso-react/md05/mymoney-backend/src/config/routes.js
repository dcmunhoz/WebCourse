const express = require('express');

module.exports = function(server) {

    // Url base
    const router = express.Router();
    server.use('/api', router);

    // Rotas
    const BillingCycles = require('./../api/billingCycle/billingCycleService');
    BillingCycles.register(router, '/billingCycles');


}
