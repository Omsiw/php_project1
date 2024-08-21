import React, { useEffect, useState } from 'react';
import Header from './assets/Header';
import Footer from './assets/Footer';
import GameCard from './assets/GameCard';
import './Store.css';
import searchIcon from '../assets/icons/search-icon.png'; // Импортируем иконку поиска\
import axios from 'axios';

function Store() {  
  const [currentGameIndex, setCurrentGameIndex] = useState(0);
  const [searchQuery, setSearchQuery] = useState('');
  // const [discounts, setDiscounts] = useState([]);
  const [games, setGames] = useState([]);
  const [sortOrder, setSortOrder] = useState('default');
  const queryParameters = new URLSearchParams(window.location.search)
  const page = queryParameters.get("page")

  useEffect(() => {
    axios.get(page ? 'http://project.loc/api/gameSelect?page=' + page : 'http://project.loc/api/gameSelect')
    .then(resp => {
        const allGame = resp.data;
        setGames(allGame);
    })
    .catch(error => {
        console.log(error);
    })
  }, [setGames]);

  // useEffect(() => {
  //   axios.get('http://project.loc/api/gameRandomSelect')
  //   .then(resp => {
  //       const allGame = resp.data;
  //       setDiscounts(allGame);
  //   })
  //   .catch(error => {
  //       console.log(error);
  //   })
  // }, [setDiscounts]);

  
const discounts = [
  {
    img: 'https://img3.akspic.ru/previews/8/8/0/5/6/165088/165088-retrovejv-stil_retro-retrofuturizm-synthwave-atmosfera-550x310.jpg',
    name: 'Game 1',
    info: 'game 1'
  },
  {
    img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoXl0BY5i4TIGoo_xERhp9G9oCxnxmozXrig&s',
    name: 'Game 2',
    info: 'game 2'
  },
  // Добавьте другие игры
];

  const prevGame = () => {
    setCurrentGameIndex((currentGameIndex - 1 + discounts.length) % discounts.length);
  };

  const nextGame = () => {
    setCurrentGameIndex((currentGameIndex + 1) % discounts.length);
  };

  const handleGameClick = () => {
    window.location.href = '/';
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
      
      <div className="my-carousel">
        <div className="my-carousel-item my-carousel-item-prev" onClick={prevGame}>
          <img
            src={discounts[(currentGameIndex - 1 + discounts.length) % discounts.length].img}
            alt={discounts[(currentGameIndex - 1 + discounts.length) % discounts.length].name}
            className="my-carousel-img darkened"
          />
        </div>
        <div className="my-carousel-item my-carousel-item-current" onClick={handleGameClick}>
          <img
            src={discounts[currentGameIndex].img}
            alt={discounts[currentGameIndex].name}
            className="my-carousel-img"
          />
          <div className="my-carousel-caption">
            <h2>{discounts[currentGameIndex].name}</h2>
            <p>{discounts[currentGameIndex].info}</p>
          </div>
        </div>
        <div className="my-carousel-item my-carousel-item-next" onClick={nextGame}>
          <img
            src={discounts[(currentGameIndex + 1) % discounts.length].img}
            alt={discounts[(currentGameIndex + 1) % discounts.length].name}
            className="my-carousel-img darkened"
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
            key={game}
            imageSrc={game.img}
            gameName={game.name}
            gameCost={game.cost}
            gameId={game.id}
          />
        ))}
      </div>
      <div style={{marginTop: "5vh"}}>
        <Footer />
      </div>
    </div>
  );
}

export default Store;
