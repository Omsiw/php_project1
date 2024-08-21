import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from './assets/Header';
import Footer from './assets/Footer';
import './assets/bootstrap.min.css';
import './AddGame.css';


const Login = () => {
    const [login, setLogin] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        if (error){
            setError(" ");
        }
        e.preventDefault();

        console.log(JSON.stringify({login, password}));

        const response = await fetch('http://project.loc/api/login', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'Accept': 'application/json',
            },
            body: JSON.stringify({login, password})
            });
        console.log(response);
        if (response.status == 200){
            var data = await response.json();
            console.log(data);
            localStorage.setItem('authToken', data.token);
            localStorage.setItem('id', data.id);
            navigate('/');
        } else{
            setError(await response.json());
            console.log(error);
        }
        
    }

    return (
    <div className='body flex-body'>
        <Header/>
        <div className="add-game-container">
            <form className='form-container' onSubmit={handleSubmit}>
                <div class="input-group mb-3">
                    <input className="form-control" type="text" onChange={(e) => setLogin(e.target.value)}/>
                    <span class="input-group-text" id="inputGroup-sizing-default">login</span>
                </div>
                <div class="input-group mb-3">
                    <input className="form-control" type="text" onChange={(e) => setPassword(e.target.value)}/>
                    <span class="input-group-text" id="inputGroup-sizing-default">password</span>
                </div>
                <div className="buttons-container">
                    <a href='/register' className='back-button'>Register</a>
                    <button type="submit" className='create-button'>Login</button>
                </div>
                {error && <div className="error-message">{error.message}</div>}
            </form>
        </div>
        <div style={{marginTop: "8vh", width: "100%"}}>
            <Footer />
        </div>
    </div>
    );
};

export default Login;
