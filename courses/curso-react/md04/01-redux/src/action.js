export function changeValue(e) {

    console.log("Valor mudou");

    return{
        type:'VALUE_CHANGE',
        payload: e.target.value
    }

}