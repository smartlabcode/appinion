import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './body.css';

class Body extends Component{

    render(){
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        return(
            <div className='dashboard-container' >
                <form className='dashboard-form' method='POST' action='/addpresentation'>
                    <input type="hidden" name="_token" value={token}/>
                    <div className='presentation-form-group'>
                        <label htmlFor='name'>Ime prezentacije:</label>
                        <input type='text' className='form-control' id='presentation-name' name='presentationname' required></input>
                    </div>
                    <div className='presentation-form-group'>
                        <input type='submit' className='form-control' id='submit' name='submit' value="Dodaj prezentaciju"></input>
                    </div>
                </form>
            </div>
        );
    }

}

export default Body;