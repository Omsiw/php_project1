import React from 'react';
import Header from './Header';
import './AddGame.css';

const AddGame = () => {
    return (
        <div className='body'>
            <Header/>
            <div className="add-game-container">
                <div className="form-container">
                    <input className="form-input" type="text" placeholder="Add Image" />
                    <input className="form-input" type="text" placeholder="Add Name" />
                    <input className="form-input" type="text" placeholder="Add Info" />
                    <input className="form-input" type="text" placeholder="Add Cost" />
                </div>
                <div className="buttons-container">
                    <button className="back-button">Back</button>
                    <button className="create-button">Create game</button>
                </div>
            </div>
        </div>
    );
};

export default AddGame;
