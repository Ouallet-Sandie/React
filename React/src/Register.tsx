import { Link } from 'react-router-dom';
import { SyntheticEvent, useState } from "react";



export default function Register() {
    const [username, setUsername] = useState<string>("");
    const [password, setPassword] = useState<string>("");
  
    const handleSubmit = (e: SyntheticEvent) => {
      e.preventDefault();
      fetch(
          "http://localhost:4343/register", {
          // method: "POST",
          mode: "cors",
          // credentials: "include",
  
          headers: new Headers({
          authorization: "Basic " + btoa(`${username}:${password}`),
          }
          ),
  
      })
        .then((data) => data.json())
        .then((json) => console.log(json));
    };
  
    return (
      <div>
        <form onSubmit={handleSubmit}>
          <h1>Register</h1>
          <input type="text" name="username" placeholder="username" onChange={(e) => setUsername(e.target.value)} />
          <input type="password" name="password" placeholder="password" onChange={(e) => setPassword(e.target.value)} />
  
  
          <button type="submit" name="submit">Register</button>
        </form>
  
        <Link to="/">Se connecter</Link>
      </div>
    );
  
    
  }

