import React, { useEffect, useState } from 'react';
import { redirect, useNavigate } from 'react-router-dom';
import Header from './assets/Header';
import Footer from './assets/Footer';
import './Library.css';
import axios from 'axios';



function GamePage() {  
  const [error, setError] = useState('');
  const [game, setGame] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();
  const queryParameters = new URLSearchParams(window.location.search)
  const id = queryParameters.get("id")


  
  useEffect(() => {
    axios.get('http://project.loc/api/gameSelect/' + id)
    .then(resp => {
        const allGame = resp.data;
        setGame(allGame);
        setLoading(false);
    })
    .catch(error => {
        console.log(error);
    })
  }, [setGame]);

  const handleSubmit = async (e) => {

    var token = localStorage.getItem('authToken');
    var userId = localStorage.getItem('id');

    if(!token){
        navigate('/login');
    }
    e.preventDefault();

    const response = await axios.get('http://project.loc/api/userAddGameInLib/' + userId + '/'+ game.id,{
      headers: {
        'Authorization': `Bearer ${token}`,
      }
    });
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

    if (loading) {
    return <div>Loading...</div>; // Или любой другой индикатор загрузки
  }
  return (
    <div className='body flex-body'>
        <Header/>
        <div className="add-game-container">    
            <div style={{ display: 'flex' }}>
                <div style={{ flex: 1, marginRight: '20px' }}> 
                    <img src={""} alt="Game Image" style={{ width: '100%', height: 'auto' }} /> 
                    <button className="buy-button" onClick={handleSubmit}>Buy</button>
                    {error && <div className="error-message">{error.message}</div>}
                </div>
                <div style={{ flex: 1, padding: '20px', color: '#ccc' }}>
                    <h2>{game.name}</h2>
                    <p>{game.info}</p>
                    <p>Author name: {game.author[0].name}</p>
                    <p>Publisher name:  {game.publisher[0].name}</p>
                    <p>Tags:  {game.tag.map(tag => <span>{tag.name}</span>)}</p>
                    <p>OS: {game.os.map(os => <span>{os.name}</span>)}</p>
                </div>
            </div>
        </div>

        <div style={{marginTop: "5vh", width: "100%"}}>
            <Footer />
        </div>
    </div>
  );
}

export default GamePage;
