import React from 'react';
import { BrowserRouter, Routes, Route  } from 'react-router-dom';
import AddGame from './pages/AddGame';
import Store from './pages/Store';
import Login from './pages/Login';
import Register from './pages/Register';
import Library from './pages/Library';
import ModGame from './pages/ModGame';
import GamePage from './pages/GamePage';
import './App.css';

function App() {  
 
  return (
    <div>
        <BrowserRouter>
          <Routes>
              <Route path="*" element={<Store />}  />
              <Route path="add-game" element={<AddGame />}  />
              <Route path="login" element={<Login />}  />
              <Route path="register" element={<Register />}  />
              <Route path="library" element={<Library />}  />
              <Route path="mod-game" element={<ModGame />}  />
              <Route path="game" element={<GamePage />}  />
          </Routes>
        </BrowserRouter>
    </div>
  );
}

export default App;
