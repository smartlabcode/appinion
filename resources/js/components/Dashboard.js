import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Body from './Body/Body';
import Profile from './Profile/Profile';

import './dashboard.css'

class Dashboard extends Component{

    constructor(props){
        super(props);

        this.state = {
            idprezentacije: props.idprezentacije
        }
    }

    render(){
        return(
            [
            <Body key='1' />
            ]
        );
    };
}

if (document.getElementById('profile-container')) {
    ReactDOM.render(<Profile />, document.getElementById('profile-container'));
}

if (document.getElementById('dashboard-container')) {
    ReactDOM.render(<Dashboard />, document.getElementById('dashboard-container'));
}
