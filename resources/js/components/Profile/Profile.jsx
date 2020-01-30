import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Profile extends Component{

    constructor(props){
        super(props);

        this.state = {
            name: props.name,
            prezime: props.prezime
        }
    }

    render(){

        return(
            <div id='profile-container'>
                <h4>Profile</h4>
                <p>Ime: {name}</p>
                <p>Prezime: {last_name}</p>
                <p>Email: {email}</p>
            </div>
        );
    };

}

export default Profile;