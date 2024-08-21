import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './Header.css'; // Import the CSS file

const Header = (margin) => {
    const [menuVisible, setMenuVisible] = useState(false);
    var token = localStorage.getItem('authToken');
    const navigate = useNavigate();

    const toggleMenu = () => {
        setMenuVisible(!menuVisible);
    };

    const quit = () =>{
        token = false;
        localStorage.removeItem('authToken');
        localStorage.removeItem('id');
        navigate('/');
    }

    return (
        <header className="header">
            <nav className="nav">
                <a href="/" className="link">Shop</a>
                <a href="/library" className="link">Library</a>
            </nav>
            <div className="profile-container" onClick={toggleMenu}>
                { !token && (<a href="/login">login</a>)}
                { !!token && (<img 
                    src="https://via.placeholder.com/40" 
                    alt="Profile" 
                    className="profile-image" 
                />)}
                { !!token && menuVisible && (
                    <div className="my-dropdown-menu">
                        <span className="menu-item">Account name</span>
                        <span className="menu-item">Account</span>
                        <span className="menu-item">Shopping cart</span>
                        <span className="menu-item" onClick={quit}>Quit</span>
                    </div>
                )}
            </div>
        </header>
    );
}

export default Header;
