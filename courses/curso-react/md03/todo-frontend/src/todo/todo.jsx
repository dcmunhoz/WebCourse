import React from 'react';
import PageHeader from './../template/PageHeader';
import TodoForm from './TodoForm';
import TodoList from './TodoList';

export default class Todo extends React.Component {

    constructor(props){
        super(props);

        this.handleAdd = this.handleAdd.bind(this);
    }

    handleAdd() {
        console.log('Add')
    }

    render(){
        return(

            <div>
                <PageHeader name="Tarefas" small="Cadastro" />
                <TodoForm handleAdd={this.handleAdd} />
                <TodoList />
            </div>

        )
    }

}