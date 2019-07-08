export function inc(){
    return({
        type: "INC"
    });
}

export function dec(){
    return({
        type: "DEC"
    });
}


export function changeSteep(e){

    return({
        type: "STEEP_CHANGED",
        payload: e.target.value
    });

}