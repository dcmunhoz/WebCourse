import React from 'react';
import IconButton from './../template/iconButton';
import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';
import { markAsDone, markAsPendind, remove } from '../todo/todoActions';

const TodoList = props=>{

    const renderRows = () =>{

        const list = props.list || []

        return(
    
            list.map(todo=>(
                <tr key={todo._id}>
                    <td className={todo.done ? "markedAsDone" : ""}>
                        {todo.description}
                    </td>
                    <td className="tableActions">
                        <IconButton hide={todo.done}  style="success" icon="check"   onClick={() => props.markAsDone(todo)} />
                        <IconButton hide={!todo.done} style="warning" icon="undo"    onClick={() => props.markAsPendind(todo)} />
                        <IconButton hide={!todo.done} style="danger"  icon="trash-o" onClick={() => props.remove(todo)}/>
                    </td>
                </tr>
            ))
        )
    }

    return(
        <table className="table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                {renderRows()}
            </tbody>
        </table>
    )
}

const mapStateToProps = state => ({list: state.todo.list});
const mapDispatchToProps = dispatch => bindActionCreators({markAsDone, markAsPendind, remove}, dispatch);
export default connect(mapStateToProps, mapDispatchToProps)(TodoList);