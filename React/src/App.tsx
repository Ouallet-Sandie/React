// import React from 'react';
import './App.css';
import Login from './Login';
import Register from './Register';
import Post from './Post';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { useEffect } from 'react';
// import { json } from 'stream/consumers';



function App() {


  useEffect(() => {
    fetch("http://localhost:4343", {
      // method: "POST",
      mode: "cors",
      // body: JSON.stringify({info: "lkjsdlmkgjfdlsmkgjfldkj"})
    })
    .then(data => data.json())
    .then(json => console.log(json))
  }, []); 





  return (
    
    <div>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Login />} />
          <Route path='/Register' element={<Register />} />
          <Route path='/Post' element={<Post />} />
        </Routes>
      
      </BrowserRouter>
      
    </div>

  );
}



export default App;