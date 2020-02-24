import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Pitanje extends Component{

    constructor(props){
        super(props);
    }

    render(){
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 
        return(
            <div id='pitanje-div'>
            
            </div>
        );
    };

}