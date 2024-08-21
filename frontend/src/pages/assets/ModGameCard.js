import React from 'react';
import './ModGameCard.css'; // Добавьте стили

const ModGameCard = ({ imageSrc, gameName, gameId }) => {
  return (
    <div className="mod-game-card">
        <img src={imageSrc} alt={gameName} className="game-image" />
        <div className="mod-game-info">
            <p>{gameName}</p>
        </div>
        <div className='mod-game-buttons'>
            <button className='back-button'>Update</button>
            <button className='create-button'>Delete</button>
        </div>
    </div>
  );
};

export default ModGameCard;