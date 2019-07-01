import React from 'react';
import PageHeader from './../template/PageHeader';
import TodoForm from './TodoForm';
import TodoList from './TodoList';
import axios from 'axios';

const URL = 'http://localhost:3003/api/todos'

export default class Todo extends React.Component {

    constructor(props){
        super(props);

        this.state = {
            description: '',
            list: []
        }

        this.handleAdd = this.handleAdd.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleRemove = this.handleRemove.bind(this);

        this.refresh();
    }

    refresh(){

        axios.get(`${URL}?sort=-createdAt`)
            .then(response=>{
                this.setState({...this.state, description: '', list: response.data})
                console.log(response.data)
            })

    }

    handleAdd() {
        const description = this.state.description;
        axios.post(URL, { description } ).then(response=>{
            this.refresh();
        })
    }

    handleChange(e){
        this.setState({
            ...this.state,
            description: e.target.value
        });
    }

    handleRemove(todo){

        axios.delete(`${URL}/${todo._id}`).then(resolve=>{
            this.refresh();
        })

    }

    render(){
        return(

            <div>
                <PageHeader name="Tarefas" small="Cadastro" />
                <TodoForm description={this.state.description} handleChange={this.handleChange} handleAdd={this.handleAdd} />
                <TodoList list={this.state.list} handleRemove={this.handleRemove} />
            </div>

        )
    }

}