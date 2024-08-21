import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from './assets/Header';
import Footer from './assets/Footer';
import './assets/bootstrap.min.css';
import './AddGame.css';


const Register = () => {
    const [login, setLogin] = useState('');
    const [password, setPassword] = useState('');
    const [confitmPassword, setConfirmPassword] = useState('');
    const [email, setEmail] = useState('');
    const [name, setName] = useState('');
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        if (error){
            setError(" ");
        }
        e.preventDefault();

        if(password !== confitmPassword){
            setError({message: "password is't the same"});
        }

        const response = await fetch('http://project.loc/api/register', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'Accept': 'application/json',
            },
            body: JSON.stringify({login: login, name: name, password: password, email: email})
            });
        if (response.status == 201){
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
                    <input className="form-control" type="text" onChange={(e) => setName(e.target.value)}/>
                    <span class="input-group-text" id="inputGroup-sizing-default">name</span>
                </div>
                <div class="input-group mb-3">
                    <input className="form-control" type="text" onChange={(e) => setPassword(e.target.value)}/>
                    <span class="input-group-text" id="inputGroup-sizing-default">password</span>
                </div>
                <div class="input-group mb-3">
                    <input className="form-control" type="text" onChange={(e) => setConfirmPassword(e.target.value)}/>
                    <span class="input-group-text" id="inputGroup-sizing-default">confirm password</span>
                </div>
                <div class="input-group mb-3">
                    <input className="form-control" type="text" onChange={(e) => setEmail(e.target.value)}/>
                    <span class="input-group-text" id="inputGroup-sizing-default">email</span>
                </div>
                <div className="buttons-container">
                    <a href='/login' className='blak-button'>login</a>
                    <button type="submit" className='create-button'>Register</button>
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

export default Register;
