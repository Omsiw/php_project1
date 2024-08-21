import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './GameCard.css'; // Добавьте стили
import axios from 'axios';

const GameCard = ({ imageSrc, gameName, gameCost, gameId }) => {
  const [error, setError] = useState('');
  const navigate = useNavigate();
  const handleSubmit = async (e) => {

    var token = localStorage.getItem('authToken');
    var userId = localStorage.getItem('id');

    if(!token){
        navigate('/login');
    }
    e.preventDefault();

    const response = await axios.get('http://project.loc/api/userAddGameInLib/' + userId + '/'+ gameId,{
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

  const redirect = () =>{
    navigate("/game?id="+gameId)
  }
  
  return (
    <div className="game-card" onClick={redirect}>
      <img src={imageSrc} alt={gameName} className="game-image" />
      <div className="game-info">
        <p>{gameName}</p>
        <p>{gameCost}</p>
        <button className="buy-button" onClick={handleSubmit}>Buy</button>
        {error && <div className="error-message">{error.message}</div>}
      </div>
    </div>
  );
};

export default GameCard;