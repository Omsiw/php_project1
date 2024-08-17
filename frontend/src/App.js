import React, { useState } from 'react';
import Header from './Header';
import AddGame from './AddGame';
import GameCard from './GameCard';
import './App.css';
import searchIcon from './assets/icons/search-icon.png'; // Импортируем иконку поиска
import sortIcon from './assets/icons/sort-icon.png'; // Импортируем иконку сортировки

const discount = [
  {
    name: 'Game 1',
    description: 'Small description of Game 1',
    imageUrl: 'https://img3.akspic.ru/previews/8/8/0/5/6/165088/165088-retrovejv-stil_retro-retrofuturizm-synthwave-atmosfera-550x310.jpg',
    link: 'https://game1.com'
  },
  {
    name: 'Game 2',
    description: 'Small description of Game 2',
    imageUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoXl0BY5i4TIGoo_xERhp9G9oCxnxmozXrig&s',
    link: 'https://game2.com'
  }
]

const games = [
  {
    imageSrc: 'https://img3.akspic.ru/previews/8/8/0/5/6/165088/165088-retrovejv-stil_retro-retrofuturizm-synthwave-atmosfera-550x310.jpg',
    gameName: 'Game 1',
    gameCost: '$19.99'
  },
  {
    imageSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoXl0BY5i4TIGoo_xERhp9G9oCxnxmozXrig&s',
    gameName: 'Game 2',
    gameCost: '$29.99'
  },
  // Добавьте другие игры
];

function App() {  
  const [currentGameIndex, setCurrentGameIndex] = useState(0);
  const [searchQuery, setSearchQuery] = useState('');
  const [sortOrder, setSortOrder] = useState('default');

  const prevGame = () => {
    setCurrentGameIndex((currentGameIndex - 1 + games.length) % games.length);
  };

  const nextGame = () => {
    setCurrentGameIndex((currentGameIndex + 1) % games.length);
  };

  const handleGameClick = () => {
    window.location.href = games[currentGameIndex].link;
  };

  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
  };

  const handleSortChange = (e) => {
    setSortOrder(e.target.value);
  };
  return (
    <div className='body'>
      <Header/>
      
      <div className="carousel">
        <div className="carousel-item carousel-item-prev" onClick={prevGame}>
          <img
            src={discount[(currentGameIndex - 1 + discount.length) % discount.length].imageUrl}
            alt={discount[(currentGameIndex - 1 + discount.length) % discount.length].name}
            className="carousel-img darkened"
          />
        </div>
        <div className="carousel-item carousel-item-current" onClick={handleGameClick}>
          <img
            src={discount[currentGameIndex].imageUrl}
            alt={discount[currentGameIndex].name}
            className="carousel-img"
          />
          <div className="carousel-caption">
            <h2>{discount[currentGameIndex].name}</h2>
            <p>{discount[currentGameIndex].description}</p>
          </div>
        </div>
        <div className="carousel-item carousel-item-next" onClick={nextGame}>
          <img
            src={discount[(currentGameIndex + 1) % discount.length].imageUrl}
            alt={discount[(currentGameIndex + 1) % discount.length].name}
            className="carousel-img darkened"
          />
        </div>
      </div>

      <div className="search-sort-container">
        <div className="search-box">
          <input
            type="text"
            placeholder="Search"
            value={searchQuery}
            onChange={handleSearchChange}
          />
          <button type="button" className="search-button">
            <img src={searchIcon} alt="Search" />
          </button>
        </div>
        
        <div className="sort-box">
          <select value={sortOrder} onChange={handleSortChange}>
            <option value="default">Sort</option>
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
          </select>
        </div>
      </div>

      <div className="game-list">
        {games.map((game, index) => (
          <GameCard
            key={index}
            imageSrc={game.imageSrc}
            gameName={game.gameName}
            gameCost={game.gameCost}
          />
        ))}
      </div>
      <Route path="/add-game" component={AddGame} />
    </div>
  );
}

export default App;
