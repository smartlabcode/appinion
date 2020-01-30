import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './registration.css';

const styles = {
    display: 'block'
}

class Registration extends Component{

    render(){
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        return(
            <div className='registration-container' >
                <form className='registration-form' method='POST' action='/register'>
                    <input type="hidden" name="_token" value={token}/>
                    <div className='form-group'>
                        <label htmlFor='name'>Ime:</label>
                        <input type='text' className='form-control' id='name' name='name' required></input>
                    </div>
                    <div className='form-group'>
                        <label htmlFor='last_name'>Prezime:</label>
                        <input type='text' className='form-control' id='last_name' name='last_name' required></input>
                    </div>
                    <div className='form-group'>
                        <label htmlFor='email'>Email:</label>
                        <input type='email' className='form-control' id='email' name='email' required></input>
                    </div>
                    <div className='form-group'>
                        <label htmlFor='password'>Password:</label>
                        <input type='password' className='form-control' id='password' name='password' required></input>
                    </div>
                    <div className='form-group'>
                        <label htmlFor='password'>Confirm password:</label>
                        <input type='password' className='form-control' id='confirm_password' name='confirm_password' required></input>
                    </div>
                    <div className='form-group'>
                        <input type='submit' className='form-control' id='submit' name='submit' value="Registruj se"></input>
                    </div>
                </form>
            </div>
        );
    }
}

export default Registration;