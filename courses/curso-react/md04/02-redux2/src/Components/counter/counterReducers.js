const INITIAL_STATE = {steep: 1, value: 0};

export default function(state = INITIAL_STATE, action){
    
    switch(action.type){
        case "INC":
            return { ...state, value: state.value + state.steep };
        case "DEC":
            return { ...state, value: state.value - state.steep }
        case "STEEP_CHANGED":
            return { ...state, steep: +action.payload}
        default:
            return state;    
    }

}