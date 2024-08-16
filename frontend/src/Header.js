import React from 'react';
import './Header.css'; // Import the CSS file

const Header = () => {
    return (
        <header className="header">
            <nav className="nav">
                <a href="#shop" className="link">Shop</a>
                <a href="#library" className="link">Library</a>
            </nav>
            <div className="profile-container">
                <img 
                    src="https://via.placeholder.com/40" 
                    alt="Profile" 
                    className="profile-image" 
                />
            </div>
        </header>
    );
}

export default Header;
