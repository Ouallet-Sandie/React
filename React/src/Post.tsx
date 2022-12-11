

export default function Post() {

    return (

        <div>

            <form>

                <h1>Faire un post</h1>
                <input type="text" placeholder="title"/><br />  
                <textarea placeholder="content"></textarea><br />
                <button type="submit">Poster</button>

            </form>

            <div>
                {/* partie affichage posts */}
            </div>

        </div>
        
    )
}