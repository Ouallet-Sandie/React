import { SyntheticEvent, useState } from "react";
import { Link } from "react-router-dom";

export default function Login() {
  const [username, setUsername] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  



  // /!\ NE FONCTIONNE PAS DANS :4343/login A CORRIGER
  const handleSubmit = (e: SyntheticEvent) => {
    e.preventDefault();
    fetch(
        // "http://localhost:4343/login", 
        "http://localhost:4343", 
        {
        // method: "POST",
        mode: "cors",
        // credentials: "include",

        headers: new Headers({
        authorization: "Basic" + btoa(`${username}:${password}`),
        }
        ),

    })
      .then((data) => data.json())
      .then((json) => console.log(json));
  };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <h1>Login</h1>
        <input type="text" name="username" placeholder="username" onChange={(e) => setUsername(e.target.value)} />
        <input type="password" name="password" placeholder="password" onChange={(e) => setPassword(e.target.value)} />


        <button type="submit" name="submit">Login</button>
      </form>

      <Link to="/register">Créer un compte</Link>
    </div>
  );

  
}





