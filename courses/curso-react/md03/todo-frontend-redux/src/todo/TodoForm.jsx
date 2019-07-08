import React from 'react';
import Grid from './../template/grid';
import IconButton from '../template/iconButton';
import {connect} from 'react-redux';

const TodoForm = props=>{

    const keyHandler = (e) =>{
        if (e.key === 'Enter') {
            e.shiftKey ? props.handleSearch() : props.handleAdd()
        }else if (e.key==="Escape"){
            props.handleClear();
        }
    }

    return(
        <div role="form" className="todoForm" >
            <Grid cols="12 9 10">
                <input onKeyUp={keyHandler} onChange={props.handleChange} value={props.description} type="text" id="description" className="form-control" placeholder="adicione uma tarefa" />
            </Grid>
            
            <Grid cols="12 3 2">
                <IconButton style="primary" icon="plus" onClick={props.handleAdd}></IconButton>
                <IconButton style="info" icon="search" onClick={props.handleSearch} />
                <IconButton style="default" icon="close" onClick={props.handleClear} />
            </Grid>
        </div>
    
    )

}

const mapStateToProps = state => ({description: state.todo.description});
export default connect(mapStateToProps)(TodoForm);