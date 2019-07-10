const INITIAL_STATE = {
    description: "Ler Livro",
    list: [{
        _id: 1,
        description: 'Pagar fatura do cartão',
        done: true
    },{
        _id: 2,
        description: "Reunião com equipe as 10",
        done: false
    },{
        _id:3,
        description: "Consulta Médica",
        done: false
    }]
};

export default function(state = INITIAL_STATE, action){

    switch(action.type){
        case 'DESCRIPTION_CHANGED':
            return state = {...state, description: action.payload}
        case 'TODO_SEARCHED':
            return state = {...state, list: action.payload.data}
        default:
            return state;
    }

}