import React from 'react';
import PageHeader from './../template/PageHeader';
import TodoForm from './TodoForm';
import TodoList from './TodoList';

export default class Todo extends React.Component {

    render(){
        return(

            <div>
                <PageHeader name="Tarefas" small="Cadastro" />
                <TodoForm />
                <TodoList />
            </div>

        )
    }

}