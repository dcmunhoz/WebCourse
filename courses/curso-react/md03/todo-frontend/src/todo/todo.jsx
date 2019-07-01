import React from 'react';
import PageHeader from './../template/PageHeader';
import TodoForm from './TodoForm';
import TodoList from './TodoList';

export default class Todo extends React.Component {

    constructor(props){
        super(props);

        this.state = {
            description: '',
            list: []
        }

        this.handleAdd = this.handleAdd.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    handleAdd() {
        console.log(this.state);
    }

    handleChange(e){
        this.setState({
            ...this.state,
            description: e.target.value
        });
    }

    render(){
        return(

            <div>
                <PageHeader name="Tarefas" small="Cadastro" />
                <TodoForm description={this.state.description} handleChange={this.handleChange} handleAdd={this.handleAdd} />
                <TodoList />
            </div>

        )
    }

}