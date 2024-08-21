import React, { useState } from 'react';
import './SystemSelector.css';

const systems = [
    { id: 1, name: 'System 1' },
    { id: 2, name: 'System 2' },
    { id: 3, name: 'System 3' },
    // Add more systems as needed
];

const SystemSelector = () => {
    const [selectedSystems, setSelectedSystems] = useState([]);
    const [savedSystemId, setSavedSystemId] = useState([]);
    const [selectedSystemId, setSelectedSystemId] = useState('');

    console.log(savedSystemId);

    const handleSelectChange = (event) => {
        setSelectedSystemId(event.target.value);
    };

    const handleAddSystem = () => {
        if (selectedSystemId && !selectedSystems.find(system => system.id === parseInt(selectedSystemId))) {
            const system = systems.find(system => system.id === parseInt(selectedSystemId));
            setSavedSystemId([...savedSystemId, selectedSystemId]);
            setSelectedSystems([...selectedSystems, system]);
        }
    };

    const handleRemoveSystem = (id) => {
        setSelectedSystems(selectedSystems.filter(system => system.id !== id));
        setSavedSystemId(savedSystemId.filter(z => z !== id));
    };

    return (
        <div className="system-selector-container">
            <div className="selected-systems">
                {selectedSystems.map(system => (
                    <div key={system.id} className="system-box">
                        {system.name}
                        <button onClick={() => handleRemoveSystem(system.id)} className="remove-button">✖</button>
                    </div>
                ))}
            </div>

            <div className="controls">
                <select value={selectedSystemId} onChange={handleSelectChange} className="system-select">
                    <option value="">Choose a system</option>
                    {systems.map(system => (
                        <option key={system.id} value={system.id}>{system.name}</option>
                    ))}
                </select>
                <button onClick={handleAddSystem} className="add-button">Save System</button>
            </div>
        </div>
    );
};

export default SystemSelector;
