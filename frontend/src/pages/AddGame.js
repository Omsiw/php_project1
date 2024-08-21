import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from './assets/Header';
import Footer from './assets/Footer';
import axios from 'axios';
import './assets/bootstrap.min.css';
import './AddGame.css';


const AddGame = () => {
    const [error, setError] = useState(null);
    const [name, setName] = useState('');
    const [img, setImg] = useState(null);
    const [cost, setCost] = useState('');
    const [info, setInfo] = useState('');
    const [osData, setOsData] = useState([]);
    const [osId, setOsId] = useState('');
    const [tagData, setTagData] = useState([]);
    const [tagId, setTagId] = useState('');
    const [authorData, setAuthorData] = useState([]);
    const [authorId, setAuthorId] = useState('');
    const [publData, setPublData] = useState([]);
    const [publId, setPublId] = useState('');
    const navigate = useNavigate();

    var token = localStorage.getItem('authToken');

    if(!token){
        navigate('/login');
    }

    const handleFileChange = (e) => {
        setImg(e.target.files[0]);
    };

    useEffect(() => {
        axios.get('http://project.loc/api/osSelect')
        .then(resp => {
            const allOs = resp.data;
            setOsData(allOs);
        })
        .catch(error => {
            setError(error);
        })
    }, [setOsData]);
    
    useEffect(() => {
        axios.get('http://project.loc/api/tagSelect')
        .then(resp => {
            const allTag = resp.data;
            setTagData(allTag);
        })
        .catch(error => {
            setError(error);
        })
    }, [setTagData]);
    
    useEffect(() => {
        axios.get('http://project.loc/api/authorSelect')
        .then(resp => {
            const allAuthor = resp.data;
            setAuthorData(allAuthor);
        })
        .catch(error => {
            setError(error);
        })
    }, [setAuthorData]);
    
    useEffect(() => {
        axios.get('http://project.loc/api/publSelect')
        .then(resp => {
            const allPubl = resp.data;
            setPublData(allPubl);
        })
        .catch(error => {
            setError(error);
        })
    }, [setPublData]);


    const createGame = async (e) =>{
        e.preventDefault();

        if (!name) {
            setError({message: "you must write a name"})
        }
        if (!info) {
            setError({message: "you must write a info"})
        }
        if (!cost) {
            setError({message: "you must write a cost"})
        }
        if (!img) {
            setError({message: "you must add a image"})
        }
        if (!osId) {
            setError({message: "you must select a os"})
        }
        if (!tagId) {
            setError({message: "you must select a tag"})
        }
        if (!authorId) {
            setError({message: "you must select a author"})
        }
        if (!publId) {
            setError({message: "you must select a publisher"})
        }



        const formData = new FormData();
        formData.append('name', name);
        formData.append('info', info);
        formData.append('cost', cost);
        formData.append('date_add', Date.now());
        formData.append('os_ids', osId);
        formData.append('tag_ids', tagId);
        formData.append('author_ids', authorId);
        if (publId != 0) {
            formData.append('publisher_ids', publId);
        }
        if (img) {
            formData.append('img', img);
        }

        try {
            const response = await axios.post('http://project.loc/api/gameCreate', formData, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data, application/json'
                }
            })
            .catch(error => {
                console.log(error);
            });
            //navigate("/");
        } catch (err) {
            if (err.response && err.response.status === 401) {
                navigate('/');
            } else {
                setError('Registration failed. Please try again.');
            }
        }
    }


    return (
        <div className='body flex-body'>
            <Header/>
            <div className="add-game-container">
                <form className='form-container' onSubmit={createGame}>
                    <div class="input-group mb-3">
                        <input className="form-control" type="file" onChange={handleFileChange} />
                        <span class="input-group-text" id="inputGroup-sizing-default">image</span>
                    </div>
                    <div class="input-group mb-3">
                        <input className="form-control" type="text" onChange={(e) => setName(e.target.value)} />
                        <span class="input-group-text" id="inputGroup-sizing-default">name</span>
                    </div>
                    <div class="input-group mb-3">
                        <textarea className="form-control" onChange={(e) => setInfo(e.target.value)} ></textarea>
                        <span class="input-group-text" id="inputGroup-sizing-default">info</span>
                    </div>
                    <div class="input-group mb-3">
                        <input className="form-control" type="text" onChange={(e) => setCost(e.target.value)} />
                        <span class="input-group-text" id="inputGroup-sizing-default">cost</span>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" onChange={(e) => setOsId(e.target.selectedIndex)}>
                            <option selected>Choose...</option>
                            {osData.map(data => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <span class="input-group-text" id="inputGroup-sizing-default">os</span>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" onChange={(e) => setTagId(e.target.selectedIndex)}>
                            <option selected>Choose...</option>
                            {tagData.map(data => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <span class="input-group-text" id="inputGroup-sizing-default">tag</span>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" onChange={(e) => setAuthorId(e.target.selectedIndex)}>
                            <option selected>Choose...</option>
                            {authorData.map(data => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <span class="input-group-text" id="inputGroup-sizing-default">author</span>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" onChange={(e) => setPublId(e.target.selectedIndex)}>
                            <option key={-1} selected>Choose...</option>
                            <option key={0}>None</option>
                            {publData.map(data => (
                                <option key={data.id} value={data.id}>{data.name}</option>
                            ))}
                        </select>
                        <span class="input-group-text" id="inputGroup-sizing-default">publisher</span>
                    </div>
                    

                    <div className="buttons-container">
                        <a href='/mod-game' className="back-button">Back</a>
                        <button type="submit" className='create-button'>Create game</button>
                    </div>
                    {error && <div className="error-message">{error.message}</div>}
                </form>
            </div>
            <div style={{ marginTop: "8vh", width: "100%"}}>
                <Footer />
            </div>
        </div>
    );
};

export default AddGame;
