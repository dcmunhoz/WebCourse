const INITIAL_STATE = { description: "", list: [] };

export default function(state = INITIAL_STATE, action){

    switch(action.type){
        case 'DESCRIPTION_CHANGED':
            return state = {...state, description: action.payload}
        case 'TODO_SEARCHED':
            return state = {...state, list: action.payload.data}
        case 'TODO_ADDED':
            return state = { ...state, description: '' }
        default:
            return state;
    }

}