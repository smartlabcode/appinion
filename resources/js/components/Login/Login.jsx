import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './login.css';

const styles = {
    display: 'none'
}

class Login extends Component{

    render(){
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(token);
        return(
            <div className='login-container'>
                <form className='login-form' method='POST' action='/login'>
                    <input type="hidden" name="_token" value={token} readOnly={true} />
                    <div className='form-group'>
                        <label htmlFor='email'>Email:</label>
                        <input type='email' className='form-control' id='email' name='email' required></input>
                    </div>
                    <div className='form-group'>
                        <label htmlFor='password'>Password:</label>
                        <input type='password' className='form-control' id='password' name='password' required></input>
                    </div>
                    <div className='form-group'>
                        <input type='submit' className='form-control' id='submit' name='submit' value="Login"></input>
                    </div>
                </form>
            </div>
        );
    }
}

export default Login;