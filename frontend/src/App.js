import React, { useState } from 'react';
import { Carousel } from 'react-bootstrap';
import Header from './Header';
import './App.css';

const games = [
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

function App() {  
  const [index, setIndex] = useState(0);

  const handleSelect = (selectedIndex, e) => {
    setIndex(selectedIndex);
  };

  const handleGameClick = (link) => {
    window.location.href = link;
  };

  return (
    <div>
      <Header />
      <Carousel activeIndex={index} onSelect={handleSelect} indicators={false}>
      {games.map((game, idx) => (
        <Carousel.Item key={idx} onClick={() => handleGameClick(game.link)}>
          <img
            className="d-block w-100"
            src={game.imageUrl}
            alt={game.name}
            style={{ filter: index === idx ? 'none' : 'brightness(50%)', cursor: 'pointer' }}
          />
          <Carousel.Caption>
            <h3>{game.name}</h3>
            <p>{game.description}</p>
          </Carousel.Caption>
        </Carousel.Item>
      ))}
    </Carousel>
    </div>
  );
}

export default App;
