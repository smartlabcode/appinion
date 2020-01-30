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

class Pitanje extends Component{

    constructor(props){
        super(props);
    }

    render(){
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 
        return(
            <form id='addQuestionForm' className='question-form' method='POST' action='/addQuestion'>
                <input type="hidden" name="_token" value={token}/>
                <input id='key-value-id' type="hidden" name="_key" value=''/>
                <div className='question-group'>
                    <label htmlFor='question'>Dodaj pitanje za prezentaciju: <p id='dom-id-prezentacije'></p></label>
                </div>
                <div className='question-group'>
                    <label htmlFor='question'>Pitanje:</label>
                    <input type='text' className='form-control' id='question' name='question' required></input>
                </div>
                <div className='question-group'>
                    <label htmlFor='odgovor'>Odgovor:</label>
                    <input type='text' className='form-control' id='odgovor1' name='odgovor1' required></input>
                </div>
                <div className='question-group'>
                    <label htmlFor='odgovor'>Odgovor:</label>
                    <input type='text' className='form-control' id='odgovor2' name='odgovor2' required></input>
                </div>
                <div className='question-group'>
                    <label htmlFor='odgovor'>Odgovor:</label>
                    <input type='text' className='form-control' id='odgovor3' name='odgovor3'></input>
                </div>
                <div className='question-group'>
                    <label htmlFor='odgovor'>Odgovor:</label>
                    <input type='text' className='form-control' id='odgovor4' name='odgovor4'></input>
                </div>
                <div className='form-group'>
                    <input type='submit' className='form-control' id='submit' name='submit' value="Dodaj"></input>
                </div>
            </form>
        );
    };

}

ReactDOM.render(<Profile />, document.getElementById('profile-container'));
ReactDOM.render(<Dashboard />, document.getElementById('dashboard-container'));
ReactDOM.render(<Pitanje />, document.getElementById('pitanje-container'));