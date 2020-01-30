import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Registration from './Registration/Registration';
import Login from './Login/Login';

import './index.css'

class Index extends Component{

    constructor(props){
        super(props);
        this.state = {
            login: false,
            register: true
        }
    }


    render(){

        if(this.state.login){
            return[<button key="1" onClick={() => this.showForm("register")}>Registracija</button>,
            <Login key="2" active={this.state.login}/>]
        }
        else{
            return [<button key="0" onClick={() => this.showForm("login")}>Log in</button>, 
            <Registration key="3" active={this.state.register}/>]
        }
    };

    showForm(Button){

        if(Button == "login"){
            this.setState({
                login: true,
                register: false

            })
        }
        else if (Button == "register"){
            this.setState({
                register: true,
                login: false
            })
        }

    }

}

if (document.getElementById('auth-container')) {
    ReactDOM.render(<Index />, document.getElementById('auth-container'));
}