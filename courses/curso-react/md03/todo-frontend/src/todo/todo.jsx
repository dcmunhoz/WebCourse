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
        this.handleSearch = this.handleSearch.bind(this);
        this.handleRemove = this.handleRemove.bind(this);
        this.handleMarkAsDone = this.handleMarkAsDone.bind(this);
        this.handleMArkAsPending = this.handleMArkAsPending.bind(this);

        this.refresh();
    }

    refresh(description = ''){
        const search = description ? `&description__regex=/${description}/` : "";
        axios.get(`${URL}?sort=-createdAt${search}`)
            .then(response=>{
                this.setState({...this.state, description, list: response.data})
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

    handleSearch(e){
        this.refresh(this.state.description);
    }

    handleRemove(todo){

        axios.delete(`${URL}/${todo._id}`).then(resolve=>{
            this.refresh(this.state.description);
        })

    }

    handleMarkAsDone(todo){ 
        axios.put(`${URL}/${todo._id}`, {...todo, done:true})
            .then(resp => this.refresh(this.state.description));
    }

    handleMArkAsPending(todo){
        axios.put(`${URL}/${todo._id}`, {...todo, done: false})
            .then(resp => this.refresh(this.state.description))
    }

    render(){
        return(

            <div>
                <PageHeader name="Tarefas" small="Cadastro" />
                <TodoForm description={this.state.description} handleChange={this.handleChange} handleAdd={this.handleAdd} handleSearch={this.handleSearch} />
                <TodoList list={this.state.list} handleRemove={this.handleRemove} handleMarkAsDone={this.handleMarkAsDone} handleMarkAsPending={this.handleMarkAsPending} />
            </div>

        )
    }

}