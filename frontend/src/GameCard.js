import React from 'react';
import './GameCard.css'; // Добавьте стили

const GameCard = ({ imageSrc, gameName, gameCost }) => {
  return (
    <div className="game-card">
      <img src={imageSrc} alt={gameName} className="game-image" />
      <div className="game-info">
        <p>{gameName}</p>
        <p>{gameCost}</p>
        <button className="buy-button">Buy</button>
      </div>
    </div>
  );
};

export default GameCard;