const mongoose = require('mongoose');
mongoose.Promise = global.Promise;
module.exports = mongoose.connect('mongodb+srv://mymoney:mymoney@cluster0-jiamz.mongodb.net/MyMcleoney?retryWrites=true&w=majority', { useNewUrlParser: true, useUnifiedTopology: true });