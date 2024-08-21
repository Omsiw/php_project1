import React, { useEffect, useState } from 'react';
import { redirect, useNavigate } from 'react-router-dom';
import Header from './assets/Header';
import Footer from './assets/Footer';
import GameCard from './assets/GameCard';
import './Library.css';
import axios from 'axios';



function Library() {  
  const [games, setGames] = useState([]);
  const navigate = useNavigate();
  
  var token = localStorage.getItem('authToken');

  if(!token){
    navigate('/login')
  }

  useEffect(() => {
    axios.get('http://project.loc/api/gameSelect')
    .then(resp => {
        const allGame = resp.data;
        setGames(allGame);
    })
    .catch(error => {
        console.log(error);
    })
  }, [setGames]);
  return (
    <div className='body'>
        <Header/>
      
        <div className='bar'>
          <a href='/mod-game' className='create-button'>Add game</a>
        </div>

        <div className="lib">
        {games.map((game, index) => (
          <GameCard
            key={game}
            imageSrc={game.img}
            gameName={game.name}
            gameCost={null}
            gameId={null}
          />
        ))}
        </div>

        <div style={{marginTop: "5vh"}}>
            <Footer />
        </div>
    </div>
  );
}

export default Library;
