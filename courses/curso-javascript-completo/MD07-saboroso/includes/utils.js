module.exports = {

    convertDate(date){

        let newDate = date.split('/').reverse().join('/');
        return newDate;

    }

}