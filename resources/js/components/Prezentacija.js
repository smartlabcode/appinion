import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Pitanja from './Pitanja/Pitanja';

class Prezentacija extends Component{

    constructor(props){
        super(props);
    }
    render(){
        return(
            [
            <Pitanja key='1' />
            ]
        );
    };
}

if(document.getElementById('pitanje-container')){
    ReactDOM.render(<Prezentacija />, document.getElementById('pitanje-container'));
}
