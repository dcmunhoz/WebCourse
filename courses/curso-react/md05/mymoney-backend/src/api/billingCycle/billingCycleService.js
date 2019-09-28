const BillingCycle = require('./billingCycle');

BillingCycle.methods(['get', 'post', 'delete', 'put']);
BillingCycle.updateOptions({new: true, runValidator: true});

module.exports = BillingCycle;