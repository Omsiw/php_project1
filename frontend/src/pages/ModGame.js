import React from 'react';
import { useNavigate } from 'react-router-dom';
import Header from './assets/Header';
import Footer from './assets/Footer';
import ModGameCard from './assets/ModGameCard';
import './Library.css';

const games = [
  {
    imageSrc: 'https://img3.akspic.ru/previews/8/8/0/5/6/165088/165088-retrovejv-stil_retro-retrofuturizm-synthwave-atmosfera-550x310.jpg',
    gameName: 'Game 1',
    gameId: 1
  },
  {
    imageSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoXl0BY5i4TIGoo_xERhp9G9oCxnxmozXrig&s',
    gameName: 'Game 2',
    gameId: 2
  },
  // Добавьте другие игры
];

function ModGame() {  
    const navigate = useNavigate();
  
    var token = localStorage.getItem('authToken');

    if(!token){
        navigate('/login');
    }

    return (
        <div className='body'>
            <Header/>
        
            <div className='bar'>
            <a href='/add-game' className='create-button'>create game</a>
            </div>

            <div className="mod-lib">
                {games.map((game, index) => (
                <ModGameCard
                    key={index}
                    imageSrc={game.imageSrc}
                    gameName={game.gameName}
                    gameId={game.gameId}
                />
                ))}
            </div>

            <div style={{marginTop: "5vh"}}>
                <Footer />
            </div>
        </div>
    );
}

export default ModGame;
